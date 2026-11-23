@extends('layouts.app')

@section('title', 'Pemesanan & Tiket Saya - DewiCiamis')

@push('styles')
<style>
    .order-card {
        background: #fff;
        border: 1px solid #e0e8e2;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(20, 60, 40, .045);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(20, 60, 40, .08);
    }
    .status-badge {
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
    }
    .status-lunas { background: #e0f8e9; color: #156d39; }
    .status-menunggu { background: #fff5da; color: #8f6500; }
    .status-verifikasi { background: #e3f2fd; color: #0d47a1; }
    .status-batal { background: #ffebee; color: #c62828; }
</style>
@endpush

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px !important;">
    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-1 small fw-semibold">
                <i class="bi bi-ticket-perforated me-1"></i> TIKET WISATA
            </span>
            <h2 class="fw-bold text-dark mb-1" style="font-size: 1.65rem;">Tiket & Pesanan Saya</h2>
            <p class="text-muted mb-0 small">Kelola dan periksa status pesanan tiket desa wisata Anda.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('order.create') }}" class="btn btn-success px-3 py-2 rounded-pill fw-semibold shadow-sm" style="font-size: 0.9rem;">
                <i class="bi bi-plus-circle me-1"></i> Pesan Tiket Baru
            </a>
        </div>
    </div>

    <!-- Cek Cepat Kode Booking -->
    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-3 mb-3 bg-white">
        <h6 class="fw-bold mb-2 text-dark"><i class="bi bi-search me-2 text-success"></i>Cari Status Berdasarkan Kode Booking</h6>
        <form action="{{ route('order.payment') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="booking" class="form-control rounded-pill" style="font-size: 0.9rem;" placeholder="Contoh: VC-20261110-3F048442" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold" style="font-size: 0.9rem;">
                    Cek Status Pesanan
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Pesanan Pengguna -->
    @auth('web')
        <div class="row g-3 mt-1">
            @forelse($orders as $order)
                @php
                    $st = strtolower(trim($order->payment_status));
                    $badgeClass = 'status-menunggu';
                    if (in_array($st, ['lunas', 'paid'])) {
                        $badgeClass = 'status-lunas';
                    } elseif ($st === 'menunggu verifikasi' || (!empty($order->payment_proof) && $st !== 'lunas')) {
                        $badgeClass = 'status-verifikasi';
                    } elseif (in_array($st, ['batal', 'ditolak', 'gagal'])) {
                        $badgeClass = 'status-batal';
                    }
                @endphp
                <div class="col-12">
                    <div class="order-card p-3 p-md-3">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 pb-2 border-bottom">
                            <div>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">{{ $order->destination_name }}</h5>
                                <span class="text-muted small" style="font-size: 0.8rem;">
                                    Kode Booking: <strong class="text-dark">{{ $order->booking_code }}</strong> &bull; Dipesan: {{ $order->created_at ? $order->created_at->format('d M Y H:i') : '-' }}
                                </span>
                            </div>
                            <span class="status-badge {{ $badgeClass }}" style="font-size: 12px; padding: 4px 12px;">
                                {{ ucwords($order->payment_status) }}
                            </span>
                        </div>

                        <div class="row g-2 py-2">
                            <div class="col-6 col-sm-3">
                                <small class="text-muted d-block" style="font-size: 0.775rem;">Nama Pemesan</small>
                                <span class="fw-semibold text-dark small">{{ $order->full_name }}</span>
                            </div>
                            <div class="col-6 col-sm-3">
                                <small class="text-muted d-block" style="font-size: 0.775rem;">Tanggal Kunjungan</small>
                                <span class="fw-semibold text-dark small">{{ $order->visit_date ? $order->visit_date->format('d F Y') : '-' }}</span>
                            </div>
                            <div class="col-6 col-sm-3">
                                <small class="text-muted d-block" style="font-size: 0.775rem;">Jumlah Tiket</small>
                                <span class="fw-semibold text-dark small">{{ $order->ticket_qty }} Tiket</span>
                            </div>
                            <div class="col-6 col-sm-3">
                                <small class="text-muted d-block" style="font-size: 0.775rem;">Total Pembayaran</small>
                                <span class="fw-bold text-success fs-6">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex justify-content-end gap-2">
                            @if(in_array($st, ['lunas', 'paid']))
                                <a href="{{ route('order.ticket', $order->booking_code) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1-5 fw-medium">
                                    <i class="bi bi-qr-code me-1"></i> Lihat E-Ticket
                                </a>
                            @else
                                <a href="{{ route('order.payment', ['booking' => $order->booking_code]) }}" class="btn btn-sm btn-success rounded-pill px-3 py-1-5 fw-medium">
                                    <i class="bi bi-wallet2 me-1"></i> Bayar / Upload Bukti
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 shadow-sm">
                        <i class="bi bi-ticket-perforated display-3 text-muted mb-3 d-block"></i>
                        <h4 class="fw-bold">Belum Ada Pesanan Tiket</h4>
                        <p class="text-muted mb-4">Anda belum pernah memesan tiket wisata. Silakan pilih destinasi wisata dan pesan tiket Anda sekarang!</p>
                        <a href="{{ route('order.create') }}" class="btn btn-success px-4 py-2 rounded-pill fw-bold">
                            Pesan Tiket Sekarang
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    @else
        <div class="text-center py-5 bg-white rounded-4 shadow-sm p-5 mt-4">
            <i class="bi bi-person-lock display-3 text-muted mb-3 d-block"></i>
            <h4 class="fw-bold text-dark">Masuk untuk Melihat Riwayat Pesanan</h4>
            <p class="text-muted mb-4">Silakan masuk menggunakan akun Anda untuk melihat tiket yang telah Anda pesan.</p>
            <button type="button" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">
                Masuk Sekarang
            </button>
        </div>
    @endauth
</div>
@endsection
