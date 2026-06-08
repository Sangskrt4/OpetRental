@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Dashboard</h2>

<div class="row">
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm">
            <h5 class="text-primary fw-bold">Total Booking</h5>
            <h2 class="text-primary">{{ $totalBooking }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm">
            <h5 class="text-primary fw-bold">Pendapatan Hari Ini</h5>
            <h2 class="text-primary">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm">
            <h5 class="text-primary fw-bold">Unit Tersedia</h5>
            <h2 class="text-primary">{{ $unitTersedia }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm">
            <h5 class="text-primary fw-bold">Unit Disewa</h5>
            <h2 class="text-primary">{{ $unitDisewa }}</h2>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card p-4 shadow-sm">
            <h5 class="fw-bold text-primary">Pendapatan (7 hari terakhir)</h5>
            <div style="height: 200px; background: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <p class="text-muted">Rp {{ number_format($pendapatan7Hari, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection