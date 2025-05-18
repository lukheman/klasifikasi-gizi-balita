<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/laporan-gizi/{id_balita}', [LaporanController::class, 'giziBalita'])->name('laporan.gizi-balita');
Route::get('/laporan-data-balita', [LaporanController::class, 'dataBalita'])->name('laporan.data-balita');
