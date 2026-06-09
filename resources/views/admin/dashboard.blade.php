@extends('layouts.admin')

@section('content')
<style>
    /* Modern Cards Styling */
    .stat-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(37, 99, 235, 0.15);
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Period Tabs Styling */
    .period-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .period-tab {
        padding: 8px 20px;
        border-radius: 20px;
        border: 1px solid #e0e0e0;
        background: white;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .period-tab:hover {
        border-color: #2563eb;
        color: #2563eb;
    }
    .period-tab.active {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
    }
    
    /* Period Content */
    .period-content {
        display: none;
        padding: 10px 0;
    }
    .period-content.active {
        display: block;
    }
    .period-display {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        background: #f8faff;
        border-radius: 12px;
        margin-bottom: 12px;
    }
    .period-display .label {
        font-size: 1.1rem;
        font-weight: 500;
        color: #2d3748;
    }
    .period-display .value {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2563eb;
    }
    .total-display {
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        color: white;
        border-radius: 12px;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .total-display .label {
        font-size: 1.1rem;
        font-weight: 500;
    }
    .total-display .value {
        font-size: 1.3rem;
        font-weight: 700;
    }
    .badge-update {
        background: #e8f0fe;
        color: #2563eb;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>

<h2 class="text-center fw-bold mb-4" style="color: #2563eb;">Dashboard</h2>

<!-- Card Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-4 text-center">
            <h5 class="text-secondary fw-bold mb-3">Total Booking</h5>
            <h2 class="stat-number">{{ $totalBooking }}</h2>
            <small class="text-muted mt-2">Semua status</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4 text-center">
            <h5 class="text-secondary fw-bold mb-3">Pendapatan Hari Ini</h5>
            <h2 class="stat-number">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
            <small class="text-muted mt-2">Status disetujui</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4 text-center">
            <h5 class="text-secondary fw-bold mb-3">Unit Tersedia</h5>
            <h2 class="stat-number">{{ $unitTersedia }}</h2>
            <small class="text-muted mt-2">Siap disewa</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4 text-center">
            <h5 class="text-secondary fw-bold mb-3">Unit Disewa</h5>
            <h2 class="stat-number">{{ $unitDisewa }}</h2>
            <small class="text-muted mt-2">Sedang berlangsung</small>
        </div>
    </div>
</div>

<!-- Total Pendapatan dengan Pilihan Periode -->
<div class="row">
    <div class="col-md-12">
        <div class="card p-4 shadow-sm" style="border-radius: 16px; border: none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-primary mb-0">
                    <i class="fas fa-chart-line me-2"></i>Total Pendapatan
                </h5>
                <span class="badge-update">Update: {{ now()->format('d M Y') }}</span>
            </div>

            <!-- Period Selection Tabs -->
            <div class="period-tabs">
                <button class="period-tab active" data-period="1hari">1 Hari</button>
                <button class="period-tab" data-period="3hari">3 Hari</button>
                <button class="period-tab" data-period="7hari">7 Hari</button>
                <button class="period-tab" data-period="1bulan">1 Bulan</button>
                <button class="period-tab" data-period="3bulan">3 Bulan</button>
                <button class="period-tab" data-period="semua">Total Semua</button>
            </div>

            <!-- Period Content -->
            <div class="period-content active" id="period-1hari">
                <div class="period-display">
                    <span class="label">📅 1 Hari (Hari Ini)</span>
                    <span class="value">Rp {{ number_format($periodeData['1 Hari (Hari Ini)'], 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="period-content" id="period-3hari">
                <div class="period-display">
                    <span class="label">📅 3 Hari Terakhir</span>
                    <span class="value">Rp {{ number_format($periodeData['3 Hari Terakhir'], 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="period-content" id="period-7hari">
                <div class="period-display">
                    <span class="label">📅 7 Hari Terakhir</span>
                    <span class="value">Rp {{ number_format($periodeData['7 Hari Terakhir'], 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="period-content" id="period-1bulan">
                <div class="period-display">
                    <span class="label">📅 1 Bulan Terakhir</span>
                    <span class="value">Rp {{ number_format($periodeData['1 Bulan Terakhir'], 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="period-content" id="period-3bulan">
                <div class="period-display">
                    <span class="label">📅 3 Bulan Terakhir</span>
                    <span class="value">Rp {{ number_format($periodeData['3 Bulan Terakhir'], 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="period-content" id="period-semua">
                <div class="total-display">
                    <span class="label">💰 Total Semua</span>
                    <span class="value">Rp {{ number_format($totalSemua, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk handle tab period
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.period-tab');
        const contents = document.querySelectorAll('.period-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Show corresponding content
                const periodId = this.dataset.period;
                document.getElementById('period-' + periodId).classList.add('active');
            });
        });
    });
</script>
@endsection