<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('home')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/laporan-gizi/{id_balita}', [LaporanController::class, 'giziBalita'])->name('laporan.gizi-balita');
Route::get('/laporan-data-balita', [LaporanController::class, 'dataBalita'])->name('laporan.data-balita');
Route::get('/laporan-riwayat-pemeriksaan', [LaporanController::class, 'riwayatPemeriksaan'])->name('laporan.riwayat-pemeriksaan');
