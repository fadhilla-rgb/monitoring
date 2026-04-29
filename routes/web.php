<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardkeuanganController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Api\MonitoringController;
use App\Http\Controllers\Api\KolamController;
use App\Http\Controllers\Api\ThresholdController;

Route::get('/', [LoginController::class, 'view'])->name('login.view');
Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home/{kolam_id?}', [MonitoringController::class, 'index'])->name('home');

    Route::get('/keuangan', [DashboardkeuanganController::class, 'index'])->name('keuangan.index');
    
    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
    Route::post('/pemasukan', [PemasukanController::class, 'store']);
    Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy']);

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::delete('/riwayat/{id}/{tipe}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');

    Route::apiResource('kolam', KolamController::class);
    Route::put('/threshold/{kolam_id}', [ThresholdController::class, 'update']);
    Route::get('/threshold/{kolam_id}', [ThresholdController::class, 'show']);
});