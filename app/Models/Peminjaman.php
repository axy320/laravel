<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Model Peminjaman - Data peminjaman buku
 * Relasi: belongsTo Siswa, belongsTo Buku, belongsTo Pengunjung
 * Logic: denda otomatis Rp 1.000/hari keterlambatan
 */
class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'siswa_id',
        'pengunjung_id',
        'buku_id',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'denda',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    /**
     * Relasi ke siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Relasi ke buku
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    
    /**
     * Relasi ke pengunjung
     */
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class);
    }
    
    /**
     * Accessor untuk mendapatkan nama peminjam (Siswa atau Pengunjung)
     */
    public function getPeminjamNamaAttribute()
    {
        if ($this->siswa_id) {
            return $this->siswa ? $this->siswa->nama_siswa . ' (Siswa)' : 'N/A';
        }
        if ($this->pengunjung_id) {
            return $this->pengunjung ? $this->pengunjung->nama_pengunjung . ' (Pengunjung)' : 'N/A';
        }
        return 'N/A';
    }

    /**
     * Hitung denda keterlambatan: Rp 1.000 per hari
     * denda = (tanggal_dikembalikan - tanggal_kembali) x 1000
     */
    public function hitungDenda(): int
    {
        if ($this->status === 'dikembalikan' || $this->status === 'terlambat') {
            $tglKembali = Carbon::parse($this->tanggal_kembali)->startOfDay();
            $tglDikembalikan = Carbon::parse($this->tanggal_dikembalikan)->startOfDay();

            if ($tglDikembalikan->gt($tglKembali)) {
                return $tglKembali->diffInDays($tglDikembalikan) * 1000;
            }
        }

        // Jika masih dipinjam, hitung dari hari ini
        if ($this->status === 'dipinjam') {
            $tglKembali = Carbon::parse($this->tanggal_kembali)->startOfDay();
            $hariIni = Carbon::now()->startOfDay();

            if ($hariIni->gt($tglKembali)) {
                return $tglKembali->diffInDays($hariIni) * 1000;
            }
        }

        return 0;
    }

    /**
     * Hitung hari terlambat
     */
    public function hariTerlambat(): int
    {
        if ($this->status === 'dikembalikan' || $this->status === 'terlambat') {
            $tglKembali = Carbon::parse($this->tanggal_kembali)->startOfDay();
            $tglDikembalikan = Carbon::parse($this->tanggal_dikembalikan)->startOfDay();

            if ($tglDikembalikan->gt($tglKembali)) {
                return $tglKembali->diffInDays($tglDikembalikan);
            }
        }

        if ($this->status === 'dipinjam') {
            $tglKembali = Carbon::parse($this->tanggal_kembali)->startOfDay();
            $hariIni = Carbon::now()->startOfDay();

            if ($hariIni->gt($tglKembali)) {
                return $tglKembali->diffInDays($hariIni);
            }
        }

        return 0;
    }
}
