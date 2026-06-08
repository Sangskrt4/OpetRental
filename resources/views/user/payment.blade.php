@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="fw-bold">Metode Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <i class="fas fa-qrcode" style="font-size: 80px; color: #2563eb;"></i>
                    <h5 class="fw-bold mt-3">QRIS</h5>
                    <p class="text-muted">Scan QR Code untuk membayar</p>
                </div>

                <div class="alert alert-info">
                    <strong>Total Tagihan:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                </div>

                <div id="qrContainer">
                    @if($booking->qr_image)
                        <div class="text-center my-4">
                            <img src="{{ $booking->qr_image }}" alt="QRIS" class="img-fluid" style="max-width: 300px;">
                        </div>
                    @else
                        <div class="text-center my-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="text-muted mt-2">Sedang membuat QRIS...</p>
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.upload') }}" class="btn btn-primary w-100">
                        <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                    </a>
                    <a href="{{ route('user.riwayat') }}" class="btn btn-secondary mt-2 w-100">
                        <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection