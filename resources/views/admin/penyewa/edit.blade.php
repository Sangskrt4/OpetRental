@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Edit Penyewa</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('admin.penyewa.update', $penyewa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Handphone</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $penyewa->no_hp }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $penyewa->alamat }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">No. SIM</label>
                <input type="text" name="no_sim" class="form-control" value="{{ $penyewa->no_sim }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jaminan</label>
                <select name="jaminan" class="form-select">
                    <option value="KTP" {{ $penyewa->jaminan == 'KTP' ? 'selected' : '' }}>KTP</option>
                    <option value="KK" {{ $penyewa->jaminan == 'KK' ? 'selected' : '' }}>Kartu Keluarga</option>
                    <option value="STNK" {{ $penyewa->jaminan == 'STNK' ? 'selected' : '' }}>STNK</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status_penyewa" class="form-select">
                <option value="Ready" {{ $penyewa->status_penyewa == 'Ready' ? 'selected' : '' }}>Ready</option>
                <option value="Sedang Digunakan" {{ $penyewa->status_penyewa == 'Sedang Digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                <option value="Selesai" {{ $penyewa->status_penyewa == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
@endsection