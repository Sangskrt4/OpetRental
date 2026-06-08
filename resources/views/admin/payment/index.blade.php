@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Data Pembayaran</h2>
</div>

<div class="card shadow-sm border-0" style="max-height: 600px; overflow-y: auto;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4" style="width: 60px;">ID</th>
                        <th>Metode</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                    <tr>
                        <td class="ps-4"><span class="badge bg-secondary">{{ $p->id }}</span></td>
                        <td><span class="badge bg-info">{{ $p->metode }}</span></td>
                        <td class="fw-bold">{{ $p->booking->user->name ?? '-' }}</td>
                        <td>Rp {{ number_format($p->booking->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($p->bukti_pembayaran)
                                <img src="{{ asset('storage/' . $p->bukti_pembayaran) }}" class="rounded" width="60" height="60" style="object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $p->id }}">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status == 'verified')
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($p->status == 'pending')
                                <a href="{{ route('admin.payment.verify', $p->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="{{ route('admin.payment.reject', $p->id) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Bukti Pembayaran -->
                    <div class="modal fade" id="buktiModal{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $p->bukti_pembayaran) }}" class="img-fluid" style="max-height: 600px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection