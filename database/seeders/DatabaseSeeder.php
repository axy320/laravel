<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

/**
 * Seeder untuk membuat akun admin default
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        // Di Laravel terbaru, attribute 'password' di-cast menjadi 'hashed' secara otomatis di User model.
        // Jadi kita cukup mengirimkan plain text, model akan menghashnya otomatis.
        User::firstOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name' => 'Admin Perpustakaan',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        // Buat akun petugas default
        User::firstOrCreate(
            ['email' => 'petugas@perpustakaan.com'],
            [
                'name' => 'Petugas Perpustakaan',
                'password' => 'password',
                'role' => 'petugas',
            ]
        );
    }
}
