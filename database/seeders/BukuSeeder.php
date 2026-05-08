<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::insert([
            ['judul'=>'Pemrograman Laravel','penulis'=>'Ahmad Rizki','tahun_terbit'=>'2022','kategori_id'=>2,'stok'=>5],
            ['judul'=>'Dasar PHP','penulis'=>'Budi Hartono','tahun_terbit'=>'2021','kategori_id'=>2,'stok'=>3],
            ['judul'=>'Matematika XI','penulis'=>'Siti Aminah','tahun_terbit'=>'2020','kategori_id'=>1,'stok'=>4],
            ['judul'=>'Fisika XI','penulis'=>'Dedi Kurniawan','tahun_terbit'=>'2019','kategori_id'=>1,'stok'=>2],
            ['judul'=>'Laskar Pelangi','penulis'=>'Andrea Hirata','tahun_terbit'=>'2018','kategori_id'=>3,'stok'=>6],
        ]);
    }
}
