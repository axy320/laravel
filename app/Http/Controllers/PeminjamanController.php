<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\Buku;
use Carbon\Carbon;

/**
 * PeminjamanController - CRUD Peminjaman & Pengembalian Buku
 * Logic:
 * - tanggal_pinjam = hari ini (auto)
 * - tanggal_kembali = +7 hari (auto)
 * - Validasi stok sebelum pinjam
 * - Kurangi stok saat pinjam
 * - Tambah stok saat kembali
 * - Hitung denda otomatis Rp 20.000/hari
 */
class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman dengan search & pagination
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter');

        $peminjamans = Peminjaman::with('siswa', 'buku')
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($q) use ($search) {
                    $q->where('judul_buku', 'like', "%{$search}%");
                });
            })
            ->when($filter, function ($query) use ($filter) {
                return $query->where('status', $filter);
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search, 'filter' => $filter]);

        return view('peminjamans.index', compact('peminjamans', 'search', 'filter'));
    }

    /**
     * Form tambah peminjaman baru
     */
    public function create()
    {
        $siswas = Siswa::orderBy('nama_siswa')->pluck('nama_siswa')->toArray();
        $pengunjungs = \App\Models\Pengunjung::orderBy('nama_pengunjung')->pluck('nama_pengunjung')->toArray();
        $semuaPeminjam = array_unique(array_merge($siswas, $pengunjungs));
        
        $bukus = Buku::where('stok_buku', '>', 0)->orderBy('judul_buku')->get();
        return view('peminjamans.create', compact('semuaPeminjam', 'bukus'));
    }

    /**
     * Simpan peminjaman baru
     * - Auto set tanggal_pinjam = hari ini
     * - Auto set tanggal_kembali = +7 hari
     * - Validasi stok buku
     * - Kurangi stok buku
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string',
            'buku_id' => 'required|exists:bukus,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $namaPeminjam = trim($request->nama_peminjam);
        
        // Cari status Siswa atau Pengunjung
        $siswa = Siswa::where('nama_siswa', $namaPeminjam)->first();
        $pengunjung = null;
        if (!$siswa) {
            $pengunjung = \App\Models\Pengunjung::where('nama_pengunjung', $namaPeminjam)->first();
        }

        if (!$siswa && !$pengunjung) {
            return back()->with('error', 'Nama "' . $namaPeminjam . '" belum terdaftar sebagai Siswa maupun Pengunjung!')->withInput();
        }

        $buku = Buku::findOrFail($request->buku_id);

        // Validasi stok
        if ($buku->stok_buku <= 0) {
            return back()->with('error', 'Stok buku "' . $buku->judul_buku . '" habis!')->withInput();
        }

        if ($request->jumlah_pinjam > $buku->stok_buku) {
            return back()->with('error', 'Jumlah pinjam melebihi stok! Stok tersedia: ' . $buku->stok_buku)->withInput();
        }

        // Simpan peminjaman
        $peminjaman = Peminjaman::create([
            'siswa_id' => $siswa ? $siswa->id : null,
            'pengunjung_id' => $pengunjung ? $pengunjung->id : null,
            'buku_id' => $request->buku_id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_pinjam' => Carbon::parse($request->tanggal_pinjam)->toDateString(),
            'tanggal_kembali' => Carbon::parse($request->tanggal_kembali)->toDateString(),
            'status' => 'dipinjam',
            'denda' => 0,
        ]);

        // Kurangi stok buku
        $buku->decrement('stok_buku', $request->jumlah_pinjam);

        // Notifikasi ke semua users (admin)
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(), 
            new \App\Notifications\NewLoanNotification($peminjaman)
        );

        return redirect()->route('peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan! Batas kembali: ' . Carbon::parse($request->tanggal_kembali)->format('d/m/Y'));
    }

    /**
     * Tampilkan detail peminjaman
     */
    public function show(Peminjaman $peminjaman)
    {
        return view('peminjamans.show', compact('peminjaman'));
    }

    /**
     * Form edit peminjaman
     */
    public function edit(Peminjaman $peminjaman)
    {
        $siswas = Siswa::orderBy('nama_siswa')->pluck('nama_siswa')->toArray();
        $pengunjungs = \App\Models\Pengunjung::orderBy('nama_pengunjung')->pluck('nama_pengunjung')->toArray();
        $semuaPeminjam = array_unique(array_merge($siswas, $pengunjungs));
        
        $bukus = Buku::orderBy('judul_buku')->get();
        return view('peminjamans.edit', compact('peminjaman', 'semuaPeminjam', 'bukus'));
    }

    /**
     * Update peminjaman
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'nama_peminjam' => 'required|string',
            'buku_id' => 'required|exists:bukus,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
        ]);

        $namaPeminjam = trim($request->nama_peminjam);
        
        // Cari status Siswa atau Pengunjung
        $siswa = Siswa::where('nama_siswa', $namaPeminjam)->first();
        $pengunjung = null;
        if (!$siswa) {
            $pengunjung = \App\Models\Pengunjung::where('nama_pengunjung', $namaPeminjam)->first();
        }

        if (!$siswa && !$pengunjung) {
            return back()->with('error', 'Nama "' . $namaPeminjam . '" belum terdaftar sebagai Siswa maupun Pengunjung!')->withInput();
        }

        $peminjaman->update([
            'siswa_id' => $siswa ? $siswa->id : null,
            'pengunjung_id' => $pengunjung ? $pengunjung->id : null,
            'buku_id' => $request->buku_id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status
        ]);

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\DataUpdatedNotification([
                'id' => $peminjaman->id,
                'title' => 'Transaksi Diubah',
                'message' => "Detail peminjaman buku oleh '{$peminjaman->peminjam_nama}' telah direvisi.",
                'url' => route('peminjamans.show', $peminjaman->id),
                'icon' => 'fas fa-hand-holding-heart',
                'color' => 'var(--secondary)'
            ])
        );

        return redirect()->route('peminjamans.index')
            ->with('success', 'Data peminjaman berhasil diupdate!');
    }

    /**
     * Proses pengembalian buku
     * - Set tanggal_dikembalikan = hari ini
     * - Hitung denda jika terlambat
     * - Kembalikan stok buku
     */
    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Buku ini sudah dikembalikan!');
        }

        $tanggalDikembalikan = Carbon::now();
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);

        // Tentukan status dan denda
        $denda = 0;
        $status = 'dikembalikan';

        if ($tanggalDikembalikan->startOfDay()->gt($tanggalKembali->startOfDay())) {
            $status = 'terlambat';
            $hariTerlambat = $tanggalKembali->startOfDay()->diffInDays($tanggalDikembalikan->startOfDay());
            $denda = $hariTerlambat * 20000;
        }

        // Update peminjaman
        $peminjaman->update([
            'tanggal_dikembalikan' => Carbon::now()->toDateString(),
            'status' => $status,
            'denda' => $denda,
        ]);

        // Kembalikan stok buku
        $peminjaman->buku->increment('stok_buku', $peminjaman->jumlah_pinjam);

        // Notifikasi ke semua users (admin)
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(), 
            new \App\Notifications\BookReturnedNotification($peminjaman)
        );

        $message = 'Buku berhasil dikembalikan!';
        if ($denda > 0) {
            $message .= ' Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->route('peminjamans.index')->with('success', $message);
    }

    /**
     * Hapus data peminjaman
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Kembalikan stok jika masih dipinjam
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok_buku', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();
        return redirect()->route('peminjamans.index')
            ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
