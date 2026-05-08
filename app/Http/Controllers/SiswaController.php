<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

/**
 * SiswaController - CRUD Data Siswa
 * Fitur: Create, Read, Update, Delete, Search, Pagination
 */
class SiswaController extends Controller
{
    /**
     * Tampilkan daftar siswa dengan search & pagination
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $siswas = Siswa::when($search, function ($query) use ($search) {
            return $query->where('nama_siswa', 'like', "%{$search}%")
                ->orWhere('nis', 'like', "%{$search}%")
                ->orWhere('kelas', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->appends(['search' => $search]);

        return view('siswas.index', compact('siswas', 'search'));
    }

    /**
     * Form tambah siswa baru
     */
    public function create()
    {
        return view('siswas.create');
    }

    /**
     * Simpan data siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis|max:20',
            'kelas' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $siswa = Siswa::create($request->all());

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\NewDataNotification([
                'id' => $siswa->id,
                'title' => 'Siswa Baru Terdaftar',
                'message' => "Siswa baru bernama '{$siswa->nama_siswa}' (NIS: {$siswa->nis}) telah didaftarkan.",
                'url' => route('siswas.show', $siswa->id),
                'icon' => 'fas fa-user-graduate',
                'color' => 'var(--primary)'
            ])
        );

        return redirect()->route('siswas.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail siswa
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('peminjamans.buku');
        return view('siswas.show', compact('siswa'));
    }

    /**
     * Form edit siswa
     */
    public function edit(Siswa $siswa)
    {
        return view('siswas.edit', compact('siswa'));
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $siswa->update($request->all());

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\DataUpdatedNotification([
                'id' => $siswa->id,
                'title' => 'Data Siswa Diubah',
                'message' => "Data siswa bernama '{$siswa->nama_siswa}' telah diperbarui.",
                'url' => route('siswas.show', $siswa->id),
                'icon' => 'fas fa-user-graduate',
                'color' => 'var(--secondary)'
            ])
        );

        return redirect()->route('siswas.index')
            ->with('success', 'Data siswa berhasil diupdate!');
    }

    /**
     * Hapus data siswa
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswas.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}