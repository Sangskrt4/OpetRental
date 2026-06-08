@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Tambah Kendaraan</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('admin.kendaraan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Kendaraan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Plat</label>
                <input type="text" name="no_plat" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" min="2000" max="2026">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Warna</label>
                <input type="text" name="warna" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">CC</label>
                <input type="text" name="cc" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Transmisi</label>
                <select name="transmisi" class="form-select">
                    <option value="Manual">Manual</option>
                    <option value="Matic">Matic</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga Sewa (per hari)</label>
                <input type="number" name="harga_sewa" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Tersedia">Tersedia</option>
                <option value="Disewa">Disewa</option>
            </select>
        </div>

        <!-- TAMBAHKAN INI 👇 -->
        <div class="mb-3">
            <label class="form-label">Jenis Kendaraan</label>
            <select name="jenis" class="form-select" required>
                <option value="Motor">Motor</option>
                <option value="Mobil">Mobil</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Kendaraan</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </form>
</div>
@endsection