<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil semua data
        $pemasukan = Pemasukan::all()->map(function ($item) {
            $item->tipe = 'pemasukan'; // Tandai sebagai pemasukan
            return $item;
        });

        $pengeluaran = Pengeluaran::all()->map(function ($item) {
            $item->tipe = 'pengeluaran'; // Tandai sebagai pengeluaran
            return $item;
        });

        // Gabungkan dan urutkan berdasarkan tanggal terbaru
        $riwayat = $pemasukan->merge($pengeluaran)->sortByDesc('tanggal');

        return view('riwayat', compact('riwayat'));
    }

    public function destroy($id, $tipe)
    {
        if ($tipe == 'pemasukan') {
            Pemasukan::findOrFail($id)->delete();
        } else {
            Pengeluaran::findOrFail($id)->delete();
        }

        return back()->with('success', 'Data riwayat berhasil dihapus dan saldo dashboard telah diperbarui.');
    }
}
