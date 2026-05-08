<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;

/**
 * PengunjungController - CRUD Data Pengunjung
 * Fitur: Create, Read, Update, Delete, Search, Pagination
 */
class PengunjungController extends Controller
{
    /**
     * Tampilkan daftar pengunjung dengan search & pagination
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pengunjungs = Pengunjung::when($search, function ($query) use ($search) {
            return $query->where('nama_pengunjung', 'like', "%{$search}%")
                ->orWhere('keperluan', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->appends(['search' => $search]);

        return view('pengunjungs.index', compact('pengunjungs', 'search'));
    }

    /**
     * Form tambah pengunjung baru
     */
    public function create()
    {
        return view('pengunjungs.create');
    }

    /**
     * Simpan data pengunjung baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengunjung' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'keperluan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
        ]);

        $pengunjung = Pengunjung::create($request->all());

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\NewDataNotification([
                'id' => $pengunjung->id,
                'title' => 'Pengunjung Baru',
                'message' => "Pengunjung baru bernama '{$pengunjung->nama_pengunjung}' telah mencatatkan kunjungan.",
                'url' => route('pengunjungs.index'),
                'icon' => 'fas fa-users',
                'color' => 'var(--info)'
            ])
        );

        return redirect()->route('pengunjungs.index')
            ->with('success', 'Data pengunjung berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail pengunjung
     */
    public function show(Pengunjung $pengunjung)
    {
        return view('pengunjungs.show', compact('pengunjung'));
    }

    /**
     * Form edit pengunjung
     */
    public function edit(Pengunjung $pengunjung)
    {
        return view('pengunjungs.edit', compact('pengunjung'));
    }

    /**
     * Update data pengunjung
     */
    public function update(Request $request, Pengunjung $pengunjung)
    {
        $request->validate([
            'nama_pengunjung' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'keperluan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
        ]);

        $pengunjung->update($request->all());

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\DataUpdatedNotification([
                'id' => $pengunjung->id,
                'title' => 'Data Pengunjung Diubah',
                'message' => "Data kunjungan '{$pengunjung->nama_pengunjung}' telah diubah.",
                'url' => route('pengunjungs.index'),
                'icon' => 'fas fa-users',
                'color' => 'var(--secondary)'
            ])
        );

        return redirect()->route('pengunjungs.index')
            ->with('success', 'Data pengunjung berhasil diupdate!');
    }

    /**
     * Hapus data pengunjung
     */
    public function destroy(Pengunjung $pengunjung)
    {
        $pengunjung->delete();
        return redirect()->route('pengunjungs.index')
            ->with('success', 'Data pengunjung berhasil dihapus!');
    }
}
