@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#e8f4f1] min-h-screen">
    <div class="bg-white p-8 rounded-[30px] shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Transaksi Tambak</h1>
            <a href="{{ route('keuangan.index') }}" class="text-blue-600 font-semibold">← Kembali ke Dashboard</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-100">
                        <th class="py-4 px-2 text-gray-500 font-medium">TANGGAL</th>
                        <th class="py-4 px-2 text-gray-500 font-medium">TIPE</th>
                        <th class="py-4 px-2 text-gray-500 font-medium">KATEGORI/JAM</th>
                        <th class="py-4 px-2 text-gray-500 font-medium">DESKRIPSI</th>
                        <th class="py-4 px-2 text-gray-500 font-medium">JUMLAH</th>
                        <th class="py-4 px-2 text-gray-500 font-medium text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $data)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 px-2">{{ $data->tanggal }}</td>
                        <td class="py-4 px-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $data->tipe == 'pemasukan' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $data->tipe }}
                            </span>
                        </td>
                        <td class="py-4 px-2 text-gray-600">
                            {{ $data->tipe == 'pemasukan' ? $data->waktu : ucfirst($data->kategori) }}
                        </td>
                        <td class="py-4 px-2 font-medium">{{ $data->deskripsi }}</td>
                        <td class="py-4 px-2 font-bold {{ $data->tipe == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $data->tipe == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($data->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            <form action="{{ route('riwayat.destroy', [$data->id, $data->tipe]) }}" method="POST" onsubmit="return confirm('Hapus data ini? Dashboard akan ikut terupdate.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection