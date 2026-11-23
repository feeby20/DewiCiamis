@extends('layouts.app')

@section('title', 'Tiket Saya - DewiCiamis')

@section('content')
<div class="container page-container" style="padding-top: 130px !important;">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-2">
                <i class="bi bi-ticket-detailed me-1"></i> E-TIKET AKTIF
            </span>
            <h1 class="fw-bold text-dark mb-1">Tiket Masuk Saya</h1>
            <p class="text-muted mb-0">Daftar semua tiket lunas yang siap digunakan saat kunjungan.</p>
        </div>
        <a href="{{ route('order.create') }}" class="btn btn-success px-4 py-2 rounded-pill fw-bold">
            <i class="bi bi-plus-circle me-1"></i> Pesan Tiket Baru
        </a>
    </div>

    <div class="row g-4">
        @forelse($orders as $order)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white border-top border-4 border-success">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">Lunas</span>
                        <small class="text-muted font-monospace">{{ $order->booking_code }}</small>
                    </div>

                    <h4 class="fw-bold text-dark mb-2">{{ $order->destination_name }}</h4>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar3 me-1"></i> Tanggal: <strong>{{ $order->visit_date ? $order->visit_date->format('d M Y') : '-' }}</strong><br>
                        <i class="bi bi-people me-1"></i> Jumlah: <strong>{{ $order->ticket_qty }} Pengunjung</strong>
                    </p>

                    <a href="{{ route('order.ticket', $order->booking_code) }}" class="btn btn-outline-success w-100 rounded-pill mt-auto fw-bold">
                        <i class="bi bi-qr-code me-2"></i> Buka E-Ticket
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-white p-5 rounded-4 shadow-sm">
                    <i class="bi bi-ticket-perforated display-3 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold text-dark">Belum Ada Tiket yang Lunas</h4>
                    <p class="text-muted mb-4">Jika Anda baru saja memesan, pastikan Anda telah menyelesaikan pembayaran dan mengunggah bukti bayar.</p>
                    <a href="{{ route('order.index') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                        Lihat Status Pesanan
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
