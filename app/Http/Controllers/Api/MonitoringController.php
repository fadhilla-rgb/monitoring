<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitoring;
use App\Models\Kolam;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    // Nama fungsi diganti menjadi 'index' agar sesuai dengan Route
    public function index(Request $request, $kolam_id = null)
    {
        // Jika kolam_id tidak ada di URL, ambil kolam pertama dari database
        if (!$kolam_id) {
            $kolam = Kolam::first();
            $kolam_id = $kolam ? $kolam->id : null;
        } else {
            $kolam = Kolam::find($kolam_id);
        }

        // Cek jika kolam tidak ditemukan
        if (!$kolam) {
            return "Error: Data kolam tidak ditemukan. Silakan isi tabel kolam terlebih dahulu.";
        }

        // 1. Validasi Input Filter (Sama seperti logika Anda sebelumnya)
        $startDate = $request->query('start_date', Carbon::now()->subDays(7)->toDateString());
        $endDate = $request->query('end_date', Carbon::now()->toDateString());
        
        $allowedParams = ['ph', 'ketinggian_air', 'suhu_air', 'salinitas'];
        $selectedParams = $request->input('params') ?? $allowedParams;

        // 2. Ambil Data Real-time
        $realtime = Monitoring::where('kolam_id', $kolam_id)
            ->latest('waktu_monitoring')
            ->first();

        // 3. Ambil Data Historis untuk Line Chart
        $chartData = Monitoring::where('kolam_id', $kolam_id)
            ->whereBetween('waktu_monitoring', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('waktu_monitoring', 'asc')
            ->get();

        // 4. Kirim ke View (Ganti 'dashboard_monitoring' dengan nama file blade Anda)
        return view('home', compact('kolam', 'realtime', 'chartData', 'selectedParams', 'startDate', 'endDate'));
    }
}