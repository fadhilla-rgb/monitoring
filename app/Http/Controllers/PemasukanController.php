<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan; // 

class PemasukanController extends Controller
{
    public function index()
    {
        // Biasanya index butuh data untuk ditampilkan
        $pemasukan = Pemasukan::all();
        return view('pemasukan', compact('pemasukan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric'
        ]);

        // Menggunakan data yang sudah tervalidasi lebih aman
        Pemasukan::create($validatedData);

        return redirect()->route('keuangan.index')->with('success','Pemasukan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        
        return back()->with('success', 'Data berhasil dihapus');
    }
}