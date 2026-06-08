@extends('layouts.user')

@section('content')
<div style="max-height: 600px; overflow-y: auto; overflow-x: hidden;">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold text-primary">
                Semua {{ ucfirst($kategori) }}
            </h3>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('user.kategori', $kategori) }}" method="GET">
            <div class="input-group" style="max-width: 400px;">
                <input type="text" name="search" class="form-control" placeholder="Cari {{ $kategori }}..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach($kendaraan as $k)
        <div class="col-md-4 mb-3">
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