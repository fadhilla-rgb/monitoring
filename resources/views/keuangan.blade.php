@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#e8f4f1] min-h-screen">
    <div class="bg-[#d1e7e2] p-8 rounded-[40px] mb-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Manajemen Keuangan</h1>
        <div class="flex gap-4">
            <button onclick="openModal('modalPemasukan')" class="bg-[#6fa3ef] hover:bg-blue-500 text-white px-6 py-2 rounded-xl shadow-md transition font-semibold">+ Pemasukan</button>
            <button onclick="openModal('modalPengeluaran')" class="bg-[#6fa3ef] hover:bg-blue-500 text-white px-6 py-2 rounded-xl shadow-md transition font-semibold">- Pengeluaran</button>
            <button onclick="window.location.href='{{ route('riwayat.index') }}'" class="bg-[#6fa3ef] hover:bg-blue-500 text-white px-6 py-2 rounded-xl shadow-md transition font-semibold flex items-center">Riwayat</button>
        </div>
    </div>

    <div class="bg-[#b7d3cd] p-10 rounded-[20px] shadow-sm flex flex-col md:flex-row gap-10 items-center">
        <div class="w-full md:w-1/3 space-y-8">
            <div>
                <p class="font-bold text-gray-800 mb-2 text-lg text-center md:text-left">Total Pemasukan</p>
                <div class="bg-[#f0f9f7] p-4 rounded-2xl shadow-inner min-h-[60px] flex items-center justify-center md:justify-start">
                    <span class="text-xl font-bold text-gray-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                </div>
            </div>
            <div>
                <p class="font-bold text-gray-800 mb-2 text-lg text-center md:text-left">Total Pengeluaran</p>
                <div class="bg-[#f0f9f7] p-4 rounded-2xl shadow-inner min-h-[60px] flex items-center justify-center md:justify-start">
                    <span class="text-xl font-bold text-gray-700">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/3 flex justify-center">
            <canvas id="pieChart" style="max-width: 250px; max-height: 250px;"></canvas>
        </div>

        <div class="w-full md:w-1/3">
            <canvas id="lineChart"></canvas>
            <div class="flex justify-end mt-4">
                <span class="text-2xl text-gray-600">📅</span>
            </div>
        </div>
    </div>
</div>

<div id="modalPemasukan" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-full max-w-md mx-4">
        <h3 class="text-xl font-bold mb-4 text-blue-600">Tambah Pemasukan</h3>
        <form action="{{ route('pemasukan') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <input type="date" name="tanggal" class="w-full border rounded-lg p-2" required>
                <input type="time" name="waktu" class="w-full border rounded-lg p-2" required>
                <input type="text" name="deskripsi" placeholder="Keterangan" class="w-full border rounded-lg p-2" required>
                <input type="number" name="jumlah" placeholder="Jumlah (Rp)" class="w-full border rounded-lg p-2" required>
                <div class="flex gap-2">
                    <button type="button" onclick="closeModal('modalPemasukan')" class="flex-1 bg-gray-200 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modalPengeluaran" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-full max-w-md mx-4">
        <h3 class="text-xl font-bold mb-4 text-red-600">Tambah Pengeluaran</h3>
        <form action="{{ route('pengeluaran') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <select name="kategori" class="w-full border rounded-lg p-2" required>
                    <option value="bibit">Bibit</option>
                    <option value="pakan">Pakan</option>
                    <option value="perawatan">Perawatan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                <input type="date" name="tanggal" class="w-full border rounded-lg p-2" required>
                <input type="text" name="deskripsi" placeholder="Keterangan" class="w-full border rounded-lg p-2" required>
                <input type="number" name="jumlah" placeholder="Jumlah (Rp)" class="w-full border rounded-lg p-2" required>
                <div class="flex gap-2">
                    <button type="button" onclick="closeModal('modalPengeluaran')" class="flex-1 bg-gray-200 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="flex-1 bg-red-600 text-white py-2 rounded-lg">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Pie Chart
    const ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: {!! json_encode($pieChartData->pluck('kategori')) !!},
            datasets: [{
                data: {!! json_encode($pieChartData->pluck('total')) !!},
                backgroundColor: ['#FF9F43', '#00CFE8', '#28C76F', '#EA5455', '#7367F0']
            }]
        },
        options: { plugins: { legend: { display: false } } }
    });

    // Line Chart (Dummy Data)
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [10, 25, 15, 30, 20, 25],
                borderColor: '#1f77b4',
                tension: 0.4,
                pointRadius: 0
            }, {
                data: [5, 18, 10, 20, 12, 15],
                borderColor: '#ff7f0e',
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: { 
            plugins: { legend: { display: false } },
            scales: { y: { display: false }, x: { grid: { display: false } } }
        }
    });
</script>
@endsection
