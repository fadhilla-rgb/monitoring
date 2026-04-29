@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <<h2 class="h4"> Monitoring {{ $kolam?->nama ?? 'Tanpa Nama' }}</h2>
<span class="badge bg-primary">Lokasi: {{ $kolam?->lokasi ?? 'Tidak diketahui' }}</span>
    </div>

    {{-- KARTU DATA REAL-TIME --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 border-start border-primary border-4">
                <small class="text-muted fw-bold text-uppercase">Suhu Air</small>
                <h3 class="mt-2 text-primary">{{ $realtime->suhu_air ?? '0' }}°C</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 border-start border-success border-4">
                <small class="text-muted fw-bold text-uppercase">pH Air</small>
                <h3 class="mt-2 text-success">{{ $realtime->ph ?? '0' }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 border-start border-warning border-4">
                <small class="text-muted fw-bold text-uppercase">Salinitas</small>
                <h3 class="mt-2 text-warning">{{ $realtime->salinitas ?? '0' }} <small class="fs-6 text-muted">ppt</small></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 border-start border-info border-4">
                <small class="text-muted fw-bold text-uppercase">Ketinggian</small>
                <h3 class="mt-2 text-info">{{ $realtime->ketinggian_air ?? '0' }} <small class="fs-6 text-muted">cm</small></h3>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- FILTER PARAMETER & TANGGAL --}}
        <div class="col-md-12">
            <div class="card shadow-sm p-4 mb-4 border-0">
                <form action="" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control shadow-sm" value="{{ request('start_date', $startDate ?? date('Y-m-d', strtotime('-7 days'))) }}">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control shadow-sm" value="{{ request('end_date') }}"><input type="date" name="end_date" class="form-control shadow-sm" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-secondary">Parameter Ditampilkan</label>
                        <div class="d-flex gap-3 flex-wrap mt-1">
                            @foreach(['ph', 'suhu_air', 'salinitas', 'ketinggian_air'] as $p)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="params[]" value="{{ $p }}" {{ in_array($p, $selectedParams) ? 'checked' : '' }}>
                                    <label class="form-check-label small text-capitalize">{{ str_replace('_', ' ', $p) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">
                            <i class="bi bi-filter"></i> Filter Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- LINE CHART --}}
        <div class="col-md-12">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-4 text-secondary italic">📈 Line Chart Periode Hasil Data</h6>
                <div style="height: 450px;">
                    <canvas id="pondChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pondChart').getContext('2d');
    const dataMaster = @json($chartData);
    
    // Menggunakan created_at sesuai default Laravel
    const labels = dataMaster.map(d => {
        let date = new Date(d.created_at);
        return date.toLocaleDateString('id-ID') + ' ' + date.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
    });
    
    const datasets = [];
    const colors = { 
        ph: 'rgb(25, 135, 84)', // Hijau
        suhu_air: 'rgb(220, 53, 69)', // Merah
        salinitas: 'rgb(255, 193, 7)', // Kuning
        ketinggian_air: 'rgb(13, 202, 240)' // Cyan
    };

    @foreach($selectedParams as $param)
        datasets.push({
            label: '{{ strtoupper(str_replace("_", " ", $param)) }}',
            data: dataMaster.map(d => d.{{ $param }}),
            borderColor: colors.{{ $param }},
            backgroundColor: colors.{{ $param }}.replace('rgb', 'rgba').replace(')', ', 0.1)'),
            borderWidth: 3,
            fill: true,
            pointRadius: 3,
            pointHoverRadius: 6,
            tension: 0.3
        });
    @endforeach

    new Chart(ctx, {
        type: 'line',
        data: { labels: labels, datasets: datasets },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'top',
                    labels: { usePointStyle: true, padding: 20 }
                },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { 
                    beginAtZero: false,
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });
</script>
@endpush
@endsection