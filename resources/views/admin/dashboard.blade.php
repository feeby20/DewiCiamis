@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Ringkasan Sistem')

@section('content')
<!-- KARTU STATISTIK -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">TOTAL PESANAN</span>
                <div class="bg-primary-subtle text-primary p-2 rounded-3">
                    <i class="bi bi-cart fs-5"></i>
                </div>
            </div>
            <h2 class="fw-bold text-dark mb-1">{{ number_format($totalOrders) }}</h2>
            <small class="text-muted">Semua transaksi tercatat</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">TIKET TERJUAL</span>
                <div class="bg-success-subtle text-success p-2 rounded-3">
                    <i class="bi bi-ticket-perforated fs-5"></i>
                </div>
            </div>
            <h2 class="fw-bold text-success mb-1">{{ number_format($totalTickets) }}</h2>
            <small class="text-muted">Tiket terkonfirmasi lunas</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">TOTAL PENDAPATAN</span>
                <div class="bg-info-subtle text-info p-2 rounded-3">
                    <i class="bi bi-cash-stack fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <small class="text-muted">Dari pesanan lunas</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">BUTUH VERIFIKASI</span>
                <div class="bg-warning-subtle text-warning p-2 rounded-3">
                    <i class="bi bi-clock-history fs-5"></i>
                </div>
            </div>
            <h2 class="fw-bold text-warning mb-1">{{ $pendingVerification }}</h2>
            <a href="{{ route('admin.orders.verifikasi') }}" class="small text-decoration-none fw-semibold">
                Periksa bukti transfer &rarr;
            </a>
        </div>
    </div>
</div>

<!-- TABEL PESANAN TERBARU -->
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0 text-dark">Pesanan Terbaru</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
            Lihat Semua Pesanan
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Kode Booking</th>
                    <th>Nama Pemesan</th>
                    <th>Destinasi</th>
                    <th>Kunjungan</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestOrders as $order)
                    @php
                        $st = strtolower(trim($order->payment_status));
                        $bg = 'warning';
                        if (in_array($st, ['lunas', 'paid'])) $bg = 'success';
                        elseif ($st === 'menunggu verifikasi' || !empty($order->payment_proof)) $bg = 'info';
                        elseif (in_array($st, ['batal', 'ditolak', 'gagal'])) $bg = 'danger';
                    @endphp
                    <tr>
                        <td><strong class="font-monospace text-dark">{{ $order->booking_code }}</strong></td>
                        <td>{{ $order->full_name }}</td>
                        <td>{{ $order->destination_name }}</td>
                        <td>{{ $order->visit_date ? $order->visit_date->format('d/m/Y') : '-' }}</td>
                        <td>{{ $order->ticket_qty }}</td>
                        <td class="fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $bg }}-subtle text-{{ $bg }} px-3 py-1 rounded-pill">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada transaksi pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
