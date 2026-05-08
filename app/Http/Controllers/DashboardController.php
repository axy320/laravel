<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pengunjung;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;

/**
 * DashboardController - Halaman utama dashboard
 * Menampilkan statistik perpustakaan dalam bentuk card
 */
class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk dashboard cards
        $totalSiswa = Siswa::count();
        $totalPengunjung = Pengunjung::count();
        $totalBuku = Buku::count();
        $totalPeminjaman = Peminjaman::count();
        $bukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // Hitung yang terlambat (status dipinjam tapi sudah lewat tanggal_kembali)
        $terlambat = Peminjaman::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', Carbon::now()->startOfDay())
            ->count()
            + Peminjaman::where('status', 'terlambat')->count();

        // Total denda dari semua peminjaman
        $totalDenda = 0;
        $semuaPeminjaman = Peminjaman::all();
        foreach ($semuaPeminjaman as $p) {
            $totalDenda += $p->hitungDenda();
        }

        // Data untuk chart - peminjaman per bulan (6 bulan terakhir)
        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $chartLabels[] = $bulan->translatedFormat('M Y');
            $chartData[] = Peminjaman::whereMonth('tanggal_pinjam', $bulan->month)
                ->whereYear('tanggal_pinjam', $bulan->year)
                ->count();
        }

        // Data untuk chart - kategori buku
        $kategoriBuku = Buku::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // Peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with('siswa', 'pengunjung', 'buku')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalSiswa',
            'totalPengunjung',
            'totalBuku',
            'totalPeminjaman',
            'bukuDipinjam',
            'terlambat',
            'totalDenda',
            'chartLabels',
            'chartData',
            'kategoriBuku',
            'peminjamanTerbaru'
        ));
    }

    /**
     * Tandai notifikasi spesifik sebagai dibaca dan redirect
     */
    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        
        if ($notification) {
            $notification->markAsRead();
            
            // Redirect ke URL yang disimpan di notifikasi jika ada
            if (isset($notification->data['url'])) {
                return redirect($notification->data['url']);
            }
        }

        return back();
    }
}