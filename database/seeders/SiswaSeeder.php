<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::insert([
            ['nama'=>'Andi Pratama','nis'=>'S001','kelas'=>'XI RPL 1','jurusan'=>'RPL'],
            ['nama'=>'Budi Santoso','nis'=>'S002','kelas'=>'XI RPL 1','jurusan'=>'RPL'],
            ['nama'=>'Citra Dewi','nis'=>'S003','kelas'=>'XI TKJ 1','jurusan'=>'TKJ'],
            ['nama'=>'Dewi Lestari','nis'=>'S004','kelas'=>'XI TKJ 1','jurusan'=>'TKJ'],
            ['nama'=>'Eko Saputra','nis'=>'S005','kelas'=>'XI RPL 2','jurusan'=>'RPL'],
        ]);
    }
}
