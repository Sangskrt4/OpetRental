@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="fw-bold">Konfirmasi Pembayaran</h4>
            </div>
            <div class="card-body text-center">
                <div style="font-size: 80px; color: #22c55e;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="fw-bold text-success mt-2">Pembayaran Berhasil!</h4>
                <p class="text-muted">Terima kasih, pembayaran Anda akan kami cek terlebih dahulu.</p>

                <div id="statusContainer" class="mt-3">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
                    <p class="text-muted mt-2">Sedang menunggu konfirmasi admin...</p>
                </div>

                <a href="{{ route('user.riwayat') }}" class="btn btn-secondary mt-3 w-100">
                    <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const bookingId = {{ $booking->id }};
    let attempts = 0;
    const maxAttempts = 30;

    const checkInterval = setInterval(function() {
        attempts++;
        fetch('/user/check-status/' + bookingId)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'disetujui' || data.status === 'menunggu') {
                    clearInterval(checkInterval);
                    document.getElementById('statusContainer').innerHTML = `
                        <div class="alert alert-success">
                            <h5 class="fw-bold">Pembayaran Telah Dikonfirmasi!</h5>
                            <p>Admin telah menyetujui pembayaran Anda. Silakan lihat status booking di Riwayat.</p>
                        </div>
                        <a href="{{ route('user.riwayat') }}" class="btn btn-primary w-100 mt-3">
                            <i class="fas fa-arrow-right"></i> Lihat Status Booking
                        </a>
                    `;
                }
            })
            .catch(error => console.error('Error:', error));

        if (attempts >= maxAttempts) {
            clearInterval(checkInterval);
            document.getElementById('statusContainer').innerHTML = `
                <div class="alert alert-warning">
                    <p>Konfirmasi admin belum diterima. Silakan cek kembali nanti.</p>
                </div>
            `;
        }
    }, 5000);
</script>
@endsection