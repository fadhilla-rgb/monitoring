<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'view'])->name('login.view');
Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

use App\Http\Controllers\DashboardkeuanganController;

// Berikan nama 'keuangan.index' agar mudah dipanggil di sidebar
Route::get('/keuangan', [DashboardkeuanganController::class, 'index'])->name('keuangan.index');

use App\Http\Controllers\PemasukanController;
Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
Route::post('/pemasukan', [PemasukanController::class, 'store']);
Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy']);

use App\Http\Controllers\PengeluaranController;
Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);


use App\Http\Controllers\RiwayatController;

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::delete('/riwayat/{id}/{tipe}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

});
