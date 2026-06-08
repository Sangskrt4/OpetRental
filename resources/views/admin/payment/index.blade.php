@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Data Pembayaran</h2>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Metode</th>
                <th>User</th>
                <th>Total</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->metode }}</td>
                <td>{{ $p->booking->user->name ?? '-' }}</td>
                <td>Rp {{ number_format($p->booking->total_harga, 0, ',', '.') }}</td>
                <td>
                    @if($p->bukti_pembayaran)
                        <img src="{{ asset('storage/' . $p->bukti_pembayaran) }}" width="80" height="80" style="object-fit: cover;">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($p->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($p->status == 'verified')
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    @if($p->status == 'pending')
                        <a href="{{ route('admin.payment.verify', $p->id) }}" class="btn btn-sm btn-success">Verifikasi</a>
                        <a href="{{ route('admin.payment.reject', $p->id) }}" class="btn btn-sm btn-danger">Tolak</a>
                    @else
                        <span class="text-muted">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection