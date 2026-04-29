<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Threshold;
use Illuminate\Http\Request;

class ThresholdController extends Controller
{
    // Ambil data threshold berdasarkan ID Kolam
    public function show($kolam_id) {
        $threshold = Threshold::where('kolam_id', $kolam_id)->first();
        if (!$threshold) return response()->json(['message' => 'Threshold belum diatur'], 404);
        return response()->json($threshold);
    }

    // Update atau Atur Threshold
    public function update(Request $request, $kolam_id) {
        $validated = $request->validate([
            'ph_bawah' => 'numeric',
            'ph_atas' => 'numeric',
            'suhu_bawah' => 'numeric',
            'suhu_atas' => 'numeric',
            'salinitas_bawah' => 'numeric',
            'salinitas_atas' => 'numeric',
            'ketinggian_batas_bawah' => 'numeric',
            'ketinggian_batas_atas' => 'numeric',
        ]);

        $threshold = Threshold::updateOrCreate(
            ['kolam_id' => $kolam_id],
            $validated
        );

        return response()->json([
            'message' => 'Ambang batas (Threshold) berhasil diperbarui',
            'data' => $threshold
        ]);
    }
}
