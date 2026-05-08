<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Pengunjung - Data pengunjung perpustakaan
 */
class Pengunjung extends Model
{
    protected $fillable = [
        'nama_pengunjung',
        'alamat',
        'no_hp',
        'keperluan',
        'tanggal_kunjungan',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];
}
