<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran; //

class PengeluaranController extends Controller
{
    public function index()
    {
        // Biasanya kamu ingin menampilkan data di index
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        // Menggunakan model yang benar
        Pengeluaran::create($validated);

        return redirect()->route('keuangan.index')->with('success','Pengeluaran berhasil ditambahkan');
    }

    public function destroy($id)
    {
        // Menggunakan model yang benar
        Pengeluaran::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
