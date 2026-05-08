<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Fiksi',
            'keterangan' => 'Buku fiksi dan cerita'
        ]);
        Kategori::create([
            'nama_kategori' => 'Non-Fiksi',
            'keterangan' => 'Buku non-fiksi dan edukasi'
        ]);
        Kategori::create([
            'nama_kategori' => 'Teknologi',
            'keterangan' => 'Buku tentang teknologi'
        ]);
    }
}
