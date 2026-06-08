@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Detail Booking</h2>

<div class="card p-4 shadow-sm">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold text-primary">{{ $booking->kendaraan->no_plat ?? 'No Plat' }}</h4>
            <span class="badge bg-warning text-dark">Status: {{ $booking->status }}</span>
            <div class="mt-3">
                <p><strong>Penyewa:</strong> {{ $booking->user->name ?? '-' }}</p>
                <p><strong>No. WA:</strong> {{ $booking->user->no_wa ?? '-' }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <p><strong>Kendaraan:</strong> {{ $booking->kendaraan->nama ?? '-' }}</p>
            <p><strong>Tanggal Booking:</strong> {{ $booking->tanggal_mulai }} - {{ $booking->tanggal_selesai }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="fw-bold">Aksi Booking</h5>
        <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" name="status" value="disetujui" class="btn btn-success w-100">Setujui</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" name="status" value="ditolak" class="btn btn-danger w-100">Tolak</button>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">Catatan (jika menolak)</label>
                <textarea name="catatan_penolakan" class="form-control" rows="3" placeholder="Masukan alasan penolakan"></textarea>
            </div>
        </form>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection