@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Tambah Penyewa</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('admin.penyewa.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Handphone</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. SIM</label>
                <input type="text" name="no_sim" class="form-control">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Jaminan</label>
            <select name="jaminan" class="form-select">
                <option value="KTP">KTP</option>
                <option value="KK">Kartu Keluarga</option>
                <option value="STNK">STNK</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status_penyewa" class="form-select">
                <option value="Ready">Ready</option>
                <option value="Sedang Digunakan">Sedang Digunakan</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </form>
</div>
@endsection