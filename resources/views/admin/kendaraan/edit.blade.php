@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Edit Kendaraan</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Kendaraan</label>
                <input type="text" name="nama" class="form-control" value="{{ $kendaraan->nama }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Plat</label>
                <input type="text" name="no_plat" class="form-control" value="{{ $kendaraan->no_plat }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" value="{{ $kendaraan->tahun }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Warna</label>
                <input type="text" name="warna" class="form-control" value="{{ $kendaraan->warna }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">CC</label>
                <input type="text" name="cc" class="form-control" value="{{ $kendaraan->cc }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Transmisi</label>
                <select name="transmisi" class="form-select">
                    <option value="Manual" {{ $kendaraan->transmisi == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Matic" {{ $kendaraan->transmisi == 'Matic' ? 'selected' : '' }}>Matic</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga Sewa (per hari)</label>
                <input type="number" name="harga_sewa" class="form-control" value="{{ $kendaraan->harga_sewa }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Tersedia" {{ $kendaraan->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Disewa" {{ $kendaraan->status == 'Disewa' ? 'selected' : '' }}>Disewa</option>
            </select>
        </div>

        <!-- TAMBAHKAN INI 👇 -->
        <div class="mb-3">
            <label class="form-label">Jenis Kendaraan</label>
            <select name="jenis" class="form-select" required>
                <option value="Motor" {{ $kendaraan->jenis == 'Motor' ? 'selected' : '' }}>Motor</option>
                <option value="Mobil" {{ $kendaraan->jenis == 'Mobil' ? 'selected' : '' }}>Mobil</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Kendaraan</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            @if($kendaraan->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $kendaraan->gambar) }}" width="150" alt="Foto Kendaraan">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
@endsection