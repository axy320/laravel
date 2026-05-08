<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Buku - Data buku perpustakaan
 * Relasi: hasMany Peminjaman
 */
class Buku extends Model
{
    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'stok_buku',
        'rak_buku',
    ];

    /**
     * Relasi ke peminjaman - satu buku bisa dipinjam berkali-kali
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
