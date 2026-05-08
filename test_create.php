<?php

try {
    App\Models\Siswa::create([
        'nama' => 'Test Siswa',
        'nis' => '12345678',
        'kelas' => '10',
        'jurusan' => 'RPL'
    ]);
    echo "Siswa saved!\n";
} catch (\Exception $e) {
    echo "Siswa error: " . $e->getMessage() . "\n";
}

try {
    App\Models\Kategori::create([
        'nama_kategori' => 'Fiksi',
        'keterangan' => 'Buku Fiksi'
    ]);
    echo "Kategori saved!\n";
} catch (\Exception $e) {
    echo "Kategori error: " . $e->getMessage() . "\n";
}

try {
    App\Models\Buku::create([
        'judul' => 'Buku Test',
        'penulis' => 'Test',
        'tahun_terbit' => 2026,
        'kategori_id' => App\Models\Kategori::first()->id ?? 1,
        'stok' => 10
    ]);
    echo "Buku saved!\n";
} catch (\Exception $e) {
    echo "Buku error: " . $e->getMessage() . "\n";
}

try {
    App\Models\User::create([
        'name' => 'Admin2',
        'email' => 'admin2@test.com',
        'password' => 'password',
        'role' => 'admin'
    ]);
    echo "User saved!\n";
} catch (\Exception $e) {
    echo "User error: " . $e->getMessage() . "\n";
}

try {
    App\Models\Peminjaman::create([
        'siswa_id' => App\Models\Siswa::first()->id ?? 1,
        'buku_id' => App\Models\Buku::first()->id ?? 1,
        'tanggal_pinjam' => '2026-04-13',
        'tanggal_kembali' => '2026-04-20',
        'status' => 'dipinjam'
    ]);
    echo "Peminjaman saved!\n";
} catch (\Exception $e) {
    echo "Peminjaman error: " . $e->getMessage() . "\n";
}
