<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Perpustakaan
|--------------------------------------------------------------------------
| Semua route dilindungi middleware auth kecuali login
*/

// Auth Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes (Auth required)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perpustakaan', [DashboardController::class, 'index']);

    // CRUD Resources
    Route::resource('siswas', SiswaController::class);
    Route::resource('pengunjungs', PengunjungController::class);
    Route::resource('bukus', BukuController::class);
    Route::resource('peminjamans', PeminjamanController::class);
    Route::resource('users', UserController::class);

    // Pengembalian buku (custom route)
    Route::put('peminjamans/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjamans.kembalikan');

    // Notifikasi read route
    Route::get('/notifications/{id}/read', [DashboardController::class, 'markNotificationAsRead'])
        ->name('notifications.read');
});