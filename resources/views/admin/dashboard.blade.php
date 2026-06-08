@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4" style="color: #2563eb;">Dashboard</h2>

<!-- Filter Periode -->
<div class="mb-4">
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link {{ $periode == '1hari' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['periode' => '1hari']) }}">1 Hari</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $periode == '3hari' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['periode' => '3hari']) }}">3 Hari</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $periode == '7hari' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['periode' => '7hari']) }}">7 Hari</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $periode == '1bulan' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['periode' => '1bulan']) }}">1 Bulan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $periode == '3bulan' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['periode' => '3bulan']) }}">3 Bulan</a>
        </li>
    </ul>
</div>

<!-- Card Statistik -->
<div class="row">
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm" style="border-radius: 15px;">
            <h5 class="text-primary fw-bold">Total Booking</h5>
            <h2 class="text-primary">{{ $totalBooking }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm" style="border-radius: 15px;">
            <h5 class="text-primary fw-bold">Pendapatan Hari Ini</h5>
            <h2 class="text-primary">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm" style="border-radius: 15px;">
            <h5 class="text-primary fw-bold">Unit Tersedia</h5>
            <h2 class="text-primary">{{ $unitTersedia }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm" style="border-radius: 15px;">
            <h5 class="text-primary fw-bold">Unit Disewa</h5>
            <h2 class="text-primary">{{ $unitDisewa }}</h2>
        </div>
    </div>
</div>

<!-- Grafik Pendapatan -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card p-4 shadow-sm" style="border-radius: 15px;">
            <h5 class="fw-bold text-primary">Pendapatan ({{ 
                match($periode) {
                    '1hari' => '1 Hari',
                    '3hari' => '3 Hari',
                    '7hari' => '7 Hari',
                    '1bulan' => '1 Bulan',
                    '3bulan' => '3 Bulan',
                    default => '7 Hari'
                }
            }})</h5>
            <div style="height: 300px; overflow-x: auto;">
                <canvas id="grafikPendapatan" style="min-width: 800px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikPendapatan').getContext('2d');
    const grafikPendapatan = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($grafikData['labels']),
            datasets: [{
                label: 'Pendapatan',
                data: @json($grafikData['data']),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection