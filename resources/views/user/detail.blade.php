@extends('layouts.user')

@section('content')
<style>
    .detail-bg {
        position: relative;
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        border-radius: 20px;
        overflow: hidden;
        padding: 40px;
        color: white;
        min-height: 400px;
    }
    .detail-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('{{ asset('storage/' . $kendaraan->gambar) }}') center/cover no-repeat;
        opacity: 0.15;
        filter: blur(8px);
        z-index: 0;
    }
    .detail-bg .content {
        position: relative;
        z-index: 1;
    }
    .detail-bg img {
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }
    .detail-bg img:hover {
        transform: scale(1.02);
    }
    .detail-bg h2 {
        font-weight: 900;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .detail-bg h4 {
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    .detail-bg ul li {
        margin-bottom: 8px;
        font-size: 1.1rem;
    }
    .detail-bg ul li strong {
        color: rgba(255,255,255,0.8);
    }
    .paket-card {
        border-radius: 15px;
        border: 2px solid #2563eb;
        transition: all 0.3s ease;
        background: white;
    }
    .paket-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .paket-card .form-check {
        padding: 15px 20px;
        margin: 0;
    }
    .paket-card .form-check-input:checked {
        background-color: #2563eb;
        border-color: #2563eb;
    }
    .btn-booking {
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        border: none;
        border-radius: 10px;
        padding: 15px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    .btn-booking:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
    }
</style>

<div class="row">
    <div class="col-12 mb-4">
        <div class="detail-bg">
            <div class="content">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center">
                        @if($kendaraan->gambar)
                            <img src="{{ asset('storage/' . $kendaraan->gambar) }}" class="w-100" style="max-height: 300px; object-fit: contain; border-radius: 20px;">
                        @else
                            <div style="height: 300px; background: rgba(255,255,255,0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-car" style="font-size: 80px; color: rgba(255,255,255,0.5);"></i>
                            </div>
                        @endif
                        <h2 class="fw-bold mt-3">{{ $kendaraan->nama }}</h2>
                        <h4>Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}/hari</h4>
                    </div>
                    <div class="col-md-6">
                        <h3 class="fw-bold">Spesifikasi</h3>
                        <ul class="list-unstyled">
                            <li><strong>Kapasitas Mesin:</strong> {{ $kendaraan->cc }}</li>
                            <li><strong>Tahun Produksi:</strong> {{ $kendaraan->tahun }}</li>
                            <li><strong>Tipe Transmisi:</strong> {{ $kendaraan->transmisi }}</li>
                            <li><strong>Kondisi:</strong> Terawat</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <h4 class="fw-bold text-primary mb-3">Pilih Paket Sewa</h4>
        <div class="card paket-card">
            <div class="card-body p-4">
                <form action="{{ route('user.booking.create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket1" value="1" checked>
                                <label class="form-check-label fw-bold" for="paket1">
                                    1 Hari <span class="text-muted float-end">Rp {{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket2" value="2">
                                <label class="form-check-label fw-bold" for="paket2">
                                    2 Hari <span class="text-muted float-end">Rp {{ number_format($kendaraan->harga_sewa * 2, 0, ',', '.') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket3" value="3">
                                <label class="form-check-label fw-bold" for="paket3">
                                    3 Hari <span class="text-muted float-end">Rp {{ number_format($kendaraan->harga_sewa * 3, 0, ',', '.') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">
                    <button type="submit" class="btn btn-primary btn-booking w-100 mt-3">Booking Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection