<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/layanan', [KatalogController::class, 'index'])->name('katalog');

Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'formMasuk'])->name('masuk');
    Route::post('/masuk', [AuthController::class, 'masuk'])->middleware('throttle:5,1')->name('masuk.proses');
    Route::get('/daftar', [AuthController::class, 'formDaftar'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar.proses');
});

Route::post('/keluar', [AuthController::class, 'keluar'])->middleware('auth')->name('keluar');

// Halaman sementara untuk menguji pembatasan akses per peran.
Route::middleware(['auth', 'peran:admin'])->prefix('admin')->group(function () {
    Route::view('/booking', 'admin.booking')->name('admin.booking');
});

Route::middleware(['auth', 'peran:owner'])->prefix('owner')->group(function () {
    Route::view('/dashboard', 'owner.dashboard')->name('owner.dashboard');
});
