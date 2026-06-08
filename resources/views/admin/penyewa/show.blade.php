@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Detail Penyewa</h2>

<div class="card p-4 shadow-sm">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold text-primary">{{ $penyewa->kendaraan->no_plat ?? 'No Plat' }}</h4>
            <span class="badge bg-warning text-dark">Status: {{ $penyewa->status }}</span>
            <div class="mt-3">
                <p><strong>Penyewa:</strong> {{ $penyewa->user->name ?? '-' }}</p>
                <p><strong>No. WA:</strong> {{ $penyewa->user->no_wa ?? '-' }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <p><strong>Kendaraan:</strong> {{ $penyewa->kendaraan->nama ?? '-' }}</p>
            <p><strong>Tanggal Booking:</strong> {{ $penyewa->tanggal_mulai }} - {{ $penyewa->tanggal_selesai }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($penyewa->total_harga, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection