<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboard;
use App\Http\Controllers\Masyarakat\PengaduanController as MasyarakatPengaduan;
use App\Http\Controllers\RT\DashboardController as RTDashboard;
use App\Http\Controllers\RT\PengaduanController as RTPengaduan;
use App\Http\Controllers\RT\UserController as RTUser;
use App\Http\Controllers\RT\KategoriController as RTKategori;
use App\Http\Controllers\RT\KegiatanController as RTKegiatan;

// Root redirect
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'rt'
            ? redirect()->route('rt.dashboard')
            : redirect()->route('masyarakat.dashboard');
    }
    return redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Masyarakat routes
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/dashboard', [MasyarakatDashboard::class, 'index'])->name('dashboard');
    Route::get('/pengaduan', [MasyarakatPengaduan::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/buat', [MasyarakatPengaduan::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/buat', [MasyarakatPengaduan::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [MasyarakatPengaduan::class, 'show'])->name('pengaduan.show');
});

// RT routes
Route::middleware(['auth', 'role:rt'])->prefix('rt')->name('rt.')->group(function () {
    Route::get('/dashboard', [RTDashboard::class, 'index'])->name('dashboard');

    // Pengaduan management
    Route::get('/pengaduan', [RTPengaduan::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [RTPengaduan::class, 'show'])->name('pengaduan.show');
    Route::post('/pengaduan/{pengaduan}/verifikasi', [RTPengaduan::class, 'verifikasi'])->name('pengaduan.verifikasi');

    // User management
    Route::get('/users', [RTUser::class, 'index'])->name('users.index');
    Route::get('/users/buat', [RTUser::class, 'create'])->name('users.create');
    Route::post('/users/buat', [RTUser::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [RTUser::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [RTUser::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [RTUser::class, 'destroy'])->name('users.destroy');

    // Kategori management
    Route::get('/kategori', [RTKategori::class, 'index'])->name('kategori.index');
    Route::get('/kategori/buat', [RTKategori::class, 'create'])->name('kategori.create');
    Route::post('/kategori/buat', [RTKategori::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [RTKategori::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [RTKategori::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [RTKategori::class, 'destroy'])->name('kategori.destroy');

    // Kegiatan management
    Route::get('/kegiatan', [RTKegiatan::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/buat', [RTKegiatan::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan/buat', [RTKegiatan::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{kegiatan}/edit', [RTKegiatan::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{kegiatan}', [RTKegiatan::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{kegiatan}', [RTKegiatan::class, 'destroy'])->name('kegiatan.destroy');
});
