@extends('layouts.user')

@section('content')
<style>
    .invoice-wrapper {
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        border-radius: 20px;
        padding: 40px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: -20px;
    }
    .invoice-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .invoice-header h2 {
        color: white;
        font-weight: 900;
        font-size: 2.2rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    .invoice-items {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 30px;
        backdrop-filter: blur(10px);
    }
    .invoice-items .row {
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.15);
    }
    .invoice-items .row:last-child {
        border-bottom: none;
    }
    .invoice-items .label {
        color: rgba(255,255,255,0.8);
        font-weight: 500;
        font-size: 1.1rem;
    }
    .invoice-items .value {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .invoice-items .total-row {
        margin-top: 10px;
        padding-top: 20px;
        border-top: 2px solid white;
    }
    .invoice-items .total-row .label {
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
    }
    .invoice-items .total-row .value {
        font-size: 1.5rem;
        font-weight: 900;
    }
    .invoice-btn {
        margin-top: 30px;
        text-align: center;
    }
    .invoice-btn .btn-primary {
        background: white;
        color: #2563eb;
        border: none;
        border-radius: 12px;
        padding: 15px 60px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .invoice-btn .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="invoice-wrapper">
            <div class="invoice-header">
                <h2>Rincian Tagihan</h2>
            </div>

            <div class="invoice-items">
                <div class="row">
                    <div class="col-6 label">Paket Sewa ({{ $paket }} hari)</div>
                    <div class="col-6 value text-end">Rp {{ number_format($total_harga, 0, ',', '.') }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Biaya Layanan</div>
                    <div class="col-6 value text-end">Rp {{ number_format($biaya_layanan, 0, ',', '.') }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Biaya Pajak</div>
                    <div class="col-6 value text-end">Rp {{ number_format($biaya_pajak, 0, ',', '.') }}</div>
                </div>
                <div class="row total-row">
                    <div class="col-6 label">Total Tagihan</div>
                    <div class="col-6 value text-end">Rp {{ number_format($total_tagihan, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="invoice-btn">
                <form action="{{ route('user.invoice.confirm') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Lanjut</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection