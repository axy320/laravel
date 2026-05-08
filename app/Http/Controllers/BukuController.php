<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

/**
 * BukuController - CRUD Data Buku
 * Fitur: Create, Read, Update, Delete, Search, Pagination
 * Badge stok: Hijau = tersedia, Merah = habis
 */
class BukuController extends Controller
{
    /**
     * Tampilkan daftar buku dengan search & pagination
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $bukus = Buku::when($search, function ($query) use ($search) {
            return $query->where('judul_buku', 'like', "%{$search}%")
                ->orWhere('kode_buku', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->appends(['search' => $search]);

        return view('bukus.index', compact('bukus', 'search'));
    }

    /**
     * Form tambah buku baru
     */
    public function create()
    {
        $latestBuku = Buku::latest('id')->first();
        $nextKode = 'BPK1';

        if ($latestBuku) {
            $kodeTerakhir = $latestBuku->kode_buku;
            if (preg_match('/(\d+)$/', $kodeTerakhir, $matches)) {
                $numberLength = strlen($matches[1]);
                $number = intval($matches[1]) + 1;
                $prefix = preg_replace('/(\d+)$/', '', $kodeTerakhir);
                if (empty(trim($prefix))) {
                    $prefix = 'BPK';
                }
                // Jika ingin mempertahankan padding '0', aktifkan str_pad. Jika misal 'BPK13' ke 'BPK14', fungsi ini sudah sesuai.
                $nextKode = $prefix . str_pad($number, $numberLength, '0', STR_PAD_LEFT);
            } else {
                $nextKode = $kodeTerakhir . '1';
            }
        }

        return view('bukus.create', compact('nextKode'));
    }

    /**
     * Simpan data buku baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|string|unique:bukus,kode_buku|max:50',
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'required|string|max:4',
            'kategori' => 'required|string|max:100',
            'stok_buku' => 'required|integer|min:0',
            'rak_buku' => 'nullable|string|max:50',
        ]);

        $buku = Buku::create($request->all());

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\NewDataNotification([
                'id' => $buku->id,
                'title' => 'Buku Baru Ditambahkan',
                'message' => "Buku baru judul '{$buku->judul_buku}' telah ditambahkan ke katalog.",
                'url' => route('bukus.index'),
                'icon' => 'fas fa-book',
                'color' => 'var(--warning)'
            ])
        );

        return redirect()->route('bukus.index')
            ->with('success', 'Data buku berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail buku
     */
    public function show(Buku $buku)
    {
        return view('bukus.show', compact('buku'));
    }

    /**
     * Form edit buku
     */
    public function edit(Buku $buku)
    {
        return view('bukus.edit', compact('buku'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|string|max:50|unique:bukus,kode_buku,' . $buku->id,
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'required|string|max:4',
            'kategori' => 'required|string|max:100',
            'stok_buku' => 'required|integer|min:0',
            'rak_buku' => 'nullable|string|max:50',
        ]);

        $buku->update($request->all());

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\DataUpdatedNotification([
                'id' => $buku->id,
                'title' => 'Data Buku Diubah',
                'message' => "Informasi buku '{$buku->judul_buku}' telah diperbarui.",
                'url' => route('bukus.index'),
                'icon' => 'fas fa-book',
                'color' => 'var(--secondary)'
            ])
        );

        return redirect()->route('bukus.index')
            ->with('success', 'Data buku berhasil diupdate!');
    }

    /**
     * Hapus data buku
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')
            ->with('success', 'Data buku berhasil dihapus!');
    }
}
