@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="fw-bold">Scan QRIS untuk Pembayaran</h4>
            </div>
            <div class="card-body text-center">
                @if($booking->qr_code)
                    <img src="{{ $booking->qr_code }}" alt="QRIS" class="img-fluid" style="max-width: 300px;">
                @else
                    <p class="text-muted">QRIS belum tersedia. Silakan refresh.</p>
                @endif
                <p class="mt-3 fw-bold">Total: Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>

                <div class="mt-4">
                    <form action="{{ route('user.qris.pay', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Saya sudah bayar
                        </button>
                    </form>
                    <a href="{{ route('user.riwayat') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection