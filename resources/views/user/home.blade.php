@extends('layouts.user')

@section('content')
<div style="max-height: 600px; overflow-y: auto; overflow-x: hidden;">
    <div class="text-center mb-3">
        <h2 class="fw-bold text-primary" style="font-size: 24px;">Selamat Datang di OPET</h2>
        <h6 class="text-secondary" style="font-size: 14px;">"Optimal Performa Ekspres Transport"</h6>
        <p class="text-muted" style="font-size: 12px;">Temukan Kendaraan Sewa Mudah dan Cepat</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('user.home') }}" method="GET">
            <div class="input-group" style="max-width: 400px; margin: 0 auto;">
                <input type="text" name="search" class="form-control" placeholder="Cari Kendaraan..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Kategori -->
    <div class="row mb-3" style="max-width: 500px; margin: 0 auto;">
        <div class="col-6 mb-2">
            <a href="{{ route('user.kategori', 'motor') }}" class="text-decoration-none">
                <div class="card p-2 text-center shadow-sm" style="border: none; border-radius: 10px;">
                    <div class="mb-1">
                        <i class="fas fa-motorcycle" style="font-size: 24px; color: #2563eb;"></i>
                    </div>
                    <h6 class="fw-bold text-primary" style="font-size: 14px; margin-bottom: 0;">Motor</h6>
                    <p class="text-muted small" style="font-size: 10px;">Lihat semua motor</p>
                </div>
            </a>
        </div>
        <div class="col-6 mb-2">
            <a href="{{ route('user.kategori', 'mobil') }}" class="text-decoration-none">
                <div class="card p-2 text-center shadow-sm" style="border: none; border-radius: 10px;">
                    <div class="mb-1">
                        <i class="fas fa-car" style="font-size: 24px; color: #2563eb;"></i>
                    </div>
                    <h6 class="fw-bold text-primary" style="font-size: 14px; margin-bottom: 0;">Mobil</h6>
                    <p class="text-muted small" style="font-size: 10px;">Lihat semua mobil</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Rekomendasi -->
    <h5 class="fw-bold text-primary mb-2" style="font-size: 16px;">Rekomendasi</h5>
    <div class="row">
        @foreach($rekomendasi as $k)
        <div class="col-md-4 mb-2">
            <div class="card p-2 shadow-sm text-center">
                @if($k->gambar)
                    <img src="{{ asset('storage/' . $k->gambar) }}" class="w-100" style="height: 140px; object-fit: cover; border-radius: 8px; margin-bottom: 6px;">
                @else
                    <div style="height: 140px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-car" style="font-size: 30px; color: #ccc;"></i>
                    </div>
                @endif
                <h6 class="fw-bold text-primary mt-1" style="font-size: 14px;">{{ $k->nama }}</h6>
                <p class="text-muted" style="font-size: 12px;">Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}/hari</p>
                <a href="{{ route('user.kendaraan.detail', $k->id) }}" class="btn btn-primary w-100" style="font-size: 12px; padding: 4px 8px;">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection