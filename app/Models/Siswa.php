<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Siswa - Data siswa perpustakaan
 * Relasi: hasMany Peminjaman
 */
class Siswa extends Model
{
    protected $fillable = [
        'nama_siswa',
        'nis',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'no_hp',
    ];

    /**
     * Relasi ke peminjaman - satu siswa bisa punya banyak peminjaman
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
