<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/',        [AuthController::class, 'showLogin'])->name('login');
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produk',     fn() => 'Produk - Segera Hadir')->name('produk');
    Route::get('/pesanan',    fn() => 'Pesanan - Segera Hadir')->name('pesanan');
    Route::get('/pelanggan',  fn() => 'Pelanggan - Segera Hadir')->name('pelanggan');
    Route::get('/pembayaran', fn() => 'Pembayaran - Segera Hadir')->name('pembayaran');
    Route::get('/pengiriman', fn() => 'Pengiriman - Segera Hadir')->name('pengiriman');
    Route::get('/laporan',    fn() => 'Laporan - Segera Hadir')->name('laporan');
    Route::get('/promo',      fn() => 'Promo - Segera Hadir')->name('promo');
    Route::get('/chat',       fn() => 'Chat - Segera Hadir')->name('chat');
    Route::get('/pengaturan', fn() => 'Pengaturan - Segera Hadir')->name('pengaturan');
});

Route::prefix('user')->name('user.')->middleware('auth.user')->group(function () {
    Route::get('/beranda', fn() => 'Beranda User - Segera Hadir')->name('beranda');
});