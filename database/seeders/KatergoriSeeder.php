<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::insert([
            ['nama_kategori'=>'Pelajaran','keterangan'=>'Buku mata pelajaran sekolah'],
            ['nama_kategori'=>'Teknologi','keterangan'=>'Buku tentang IT dan komputer'],
            ['nama_kategori'=>'Novel','keterangan'=>'Buku cerita dan sastra'],
        ]);
    }
}
