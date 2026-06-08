@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4" style="font-size: 24px;">Data Penyewa</h2>

<div class="mb-3">
    <a href="{{ route('admin.penyewa.create') }}" class="btn btn-primary">+ Tambah Penyewa</a>
</div>

<div class="row" style="max-height: 600px; overflow-y: auto;">
    @foreach($penyewa as $p)
    <div class="col-md-6 mb-3">
        <div class="card p-3 shadow-sm">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #2563eb, #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-user" style="color: white; font-size: 40px;"></i>
                    </div>
                </div>
                <div class="col-md-9">
                    <h5 class="fw-bold text-primary" style="font-size: 16px;">{{ $p->nama }}</h5>
                    <p class="mb-1" style="font-size: 13px;"><strong>No. WhatsApp:</strong> {{ $p->no_hp ?? '-' }}</p>
                    <p class="mb-1" style="font-size: 13px;"><strong>Alamat:</strong> {{ $p->alamat ?? '-' }}</p>
                    <p class="mb-1" style="font-size: 13px;"><strong>No. SIM:</strong> {{ $p->no_sim ?? '-' }}</p>
                    <p class="mb-1" style="font-size: 13px;"><strong>Jaminan:</strong> <span class="text-danger fw-bold" style="font-size: 13px;">{{ $p->jaminan ?? 'STNK' }}</span></p>
                    <p class="mb-1" style="font-size: 13px;"><strong>Status:</strong> <span class="text-success fw-bold" style="font-size: 13px;">{{ $p->status_penyewa ?? 'Ready' }}</span></p>
                    <div class="mt-1">
                        <a href="{{ route('admin.penyewa.show', $p->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                        <a href="{{ route('admin.penyewa.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.penyewa.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection