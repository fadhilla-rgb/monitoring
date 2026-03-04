<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;    // Wajib ada agar Controller kenal Model Pemasukan
use App\Models\Pengeluaran;  // Wajib ada agar Controller kenal Model Pengeluaran
use Illuminate\Support\Facades\DB; // Untuk fungsi DB::raw

class DashboardkeuanganController extends Controller
{
    public function index()
    {
        // 1. Hitung total uang masuk
        $totalPemasukan = Pemasukan::sum('jumlah');

        // 2. Hitung total uang keluar
        $totalPengeluaran = Pengeluaran::sum('jumlah');

        // 3. Ambil data kategori untuk Pie Chart
        $pieChartData = Pengeluaran::select('kategori', DB::raw('sum(jumlah) as total'))
                        ->groupBy('kategori')
                        ->get();

        // 4. Kirim semua data ke halaman view 'keuangan.blade.php'
        return view('keuangan', [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'pieChartData' => $pieChartData
        ]);
    }
}