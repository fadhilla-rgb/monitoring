@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#e8f4f1] min-h-screen">
    <div class="bg-[#d1e7e2] p-8 rounded-[40px] mb-8 shadow-sm">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Monitoring System</h1>
        <div class="flex gap-4">
           
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        @php
            $parameters = [
                ['id' => 'salinitas', 'title' => 'Salinitas', 'value' => '1125', 'unit' => 'ppt'],
                ['id' => 'ph', 'title' => 'pH', 'value' => '7.5', 'unit' => 'pH'],
                ['id' => 'suhu', 'title' => 'Suhu', 'value' => '28', 'unit' => '°C'],
                ['id' => 'ketinggian', 'title' => 'Ketinggian Air', 'value' => '1.2', 'unit' => 'm']
            ];
        @endphp

        @foreach($parameters as $param)
        <div class="bg-white p-8 rounded-[30px] shadow-sm flex flex-col md:flex-row items-center gap-10 border border-gray-100">
            <div class="w-full md:w-1/3">
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ $param['title'] }}</h3>
                <div class="relative flex justify-center items-center">
                    <canvas id="pie-{{ $param['id'] }}" width="200" height="200"></canvas>
                    <div class="absolute text-center">
                        <span class="block text-2xl font-bold text-gray-800">{{ $param['value'] }}</span>
                        <span class="text-gray-400 text-xs uppercase">{{ $param['unit'] }}</span>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-2/3 relative">
                <canvas id="line-{{ $param['id'] }}" height="100"></canvas>
                <div class="flex justify-end mt-2">
                    <span class="text-xl text-gray-400">📅</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const params = ['salinitas', 'ph', 'suhu', 'ketinggian'];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];

    params.forEach(id => {
        // Doughnut/Pie Chart
        new Chart(document.getElementById(`pie-${id}`), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [30, 20, 25, 25],
                    backgroundColor: ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728'],
                    borderWidth: 0,
                    cutout: '80%'
                }]
            },
            options: { plugins: { legend: { display: false } } }
        });

        // Line Chart
        new Chart(document.getElementById(`line-${id}`), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    data: [15, 25, 18, 28, 16, 22],
                    borderColor: '#1f77b4',
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2
                }, {
                    data: [10, 15, 12, 18, 20, 18],
                    borderColor: '#ff7f0e',
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { display: false }
                }
            }
        });
    });
</script>
@endsection