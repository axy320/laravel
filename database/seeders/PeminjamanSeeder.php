<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        Peminjaman::insert([
            [
                'siswa_id'=>1,
                'buku_id'=>1,
                'user_id'=>2,
                'tanggal_pinjam'=>now(),
                'tanggal_kembali'=>null,
                'status'=>'dipinjam'
            ],
            [
                'siswa_id'=>2,
                'buku_id'=>2,
                'user_id'=>2,
                'tanggal_pinjam'=>now(),
                'tanggal_kembali'=>null,
                'status'=>'dipinjam'
            ],
            [
                'siswa_id'=>3,
                'buku_id'=>3,
                'user_id'=>2,
                'tanggal_pinjam'=>now(),
                'tanggal_kembali'=>now(),
                'status'=>'dikembalikan'
            ],
            [
                'siswa_id'=>4,
                'buku_id'=>4,
                'user_id'=>2,
                'tanggal_pinjam'=>now(),
                'tanggal_kembali'=>null,
                'status'=>'dipinjam'
            ],
            [
                'siswa_id'=>5,
                'buku_id'=>5,
                'user_id'=>2,
                'tanggal_pinjam'=>now(),
                'tanggal_kembali'=>null,
                'status'=>'dipinjam'
            ],
        ]);
    }
}
