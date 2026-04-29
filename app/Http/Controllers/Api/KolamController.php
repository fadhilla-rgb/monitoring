<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use Illuminate\Http\Request;

class KolamController extends Controller
{
    // List semua kolam
    public function index() {
        return response()->json(Kolam::with('threshold')->get());
    }

    // Tambah kolam baru
    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'luas' => 'required|numeric',
        ]);

        $kolam = Kolam::create($validated);
        
        // Otomatis buatkan data threshold kosong untuk kolam baru ini
        $kolam->threshold()->create([]);

        return response()->json(['message' => 'Kolam berhasil dibuat', 'data' => $kolam], 201);
    }

    // Detail satu kolam
    public function show($id) {
        $kolam = Kolam::with('threshold')->find($id);
        if (!$kolam) return response()->json(['message' => 'Kolam tidak ditemukan'], 404);
        return response()->json($kolam);
    }

    // Update data kolam
    public function update(Request $request, $id) {
        $kolam = Kolam::find($id);
        if (!$kolam) return response()->json(['message' => 'Kolam tidak ditemukan'], 404);

        $kolam->update($request->all());
        return response()->json(['message' => 'Data kolam diperbarui', 'data' => $kolam]);
    }
}