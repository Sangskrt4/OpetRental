@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="fw-bold">Upload Bukti Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Total Tagihan:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                </div>

                <form action="{{ route('user.upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Bukti</label>
                        <input type="file" name="bukti" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Saya sudah bayar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection