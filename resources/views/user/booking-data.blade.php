@extends('layouts.user')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        padding: 30px 20px;
        border-radius: 20px 20px 0 0;
        margin-bottom: 0;
        text-align: center;
    }
    .page-header h2 {
        color: white;
        font-weight: 900;
        font-size: 2.2rem;
        margin: 0;
    }
    .form-container {
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        border-radius: 0 0 20px 20px;
        padding: 40px;
        color: white;
        position: relative;
    }
    .form-container .form-control {
        border-radius: 10px;
        padding: 12px;
        border: none;
        background: white;
        color: #333;
    }
    .form-container .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255,255,255,0.5);
    }
    .form-container label {
        font-weight: bold;
        color: white;
        margin-bottom: 5px;
    }
    .form-container .btn-primary {
        background: white;
        color: #2563eb;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: bold;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s ease;
    }
    .form-container .btn-primary:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .jaminan-box {
        border: 2px solid rgba(255,255,255,0.5);
        border-radius: 10px;
        padding: 15px;
        background: rgba(255,255,255,0.1);
    }
    .jaminan-box .form-check {
        margin-bottom: 8px;
    }
    .jaminan-box .form-check-label {
        color: white;
        font-weight: bold;
    }
    .jaminan-box .form-check-input:checked {
        background-color: #2563eb;
        border-color: #2563eb;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="page-header position-relative">
            <h2>Isi Data Diri</h2>
        </div>

        <div class="form-container">
            <form action="{{ route('user.booking.store') }}" method="POST">
                @csrf

                <input type="hidden" name="kendaraan_id" value="{{ session('kendaraan_id') }}">
                <input type="hidden" name="paket" value="{{ session('paket') }}">
                <input type="hidden" name="total_harga" value="{{ session('total_harga') }}">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan nama lengkap" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. KTP</label>
                        <input type="text" name="no_ktp" class="form-control" placeholder="Masukan No. KTP" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>No. SIM</label>
                        <input type="text" name="no_sim" class="form-control" placeholder="Masukan No. SIM" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. Handphone</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="Masukan No. Handphone" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukan Alamat" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pemakaian</label>
                        <input type="date" name="tanggal_pemakaian" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Jaminan (pilih salah satu)</h5>
                    <div class="jaminan-box">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jaminan" id="ktp" value="KTP" checked>
                            <label class="form-check-label" for="ktp">
                                Kartu Tanda Penduduk
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jaminan" id="kk" value="KK">
                            <label class="form-check-label" for="kk">
                                Kartu Keluarga
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jaminan" id="stnk" value="STNK">
                            <label class="form-check-label" for="stnk">
                                STNK
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Lanjut</button>
            </form>
        </div>
    </div>
</div>
@endsection