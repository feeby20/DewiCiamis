@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->booking_code . ' - Admin')
@section('page_title', 'Detail Pesanan')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small mb-2 d-inline-block">KODE BOOKING</span>
                    <h3 class="fw-bold font-monospace text-success mb-0">{{ $order->booking_code }}</h3>
                </div>
                <div>
                    <span class="badge bg-success-subtle text-success fs-6 px-3 py-2 rounded-pill">
                        {{ $order->payment_status }}
                    </span>
                </div>
            </div>

            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Informasi Pemesan & Tiket</h5>
            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <small class="text-muted d-block">Nama Lengkap</small>
                    <strong class="text-dark">{{ $order->full_name }}</strong>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Nomor WhatsApp</small>
                    <strong class="text-dark">{{ $order->whatsapp }}</strong>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Destinasi Wisata</small>
                    <strong class="text-dark">{{ $order->destination_name }}</strong>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Tanggal Kunjungan</small>
                    <strong class="text-dark">{{ $order->visit_date ? $order->visit_date->format('d F Y') : '-' }}</strong>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Jumlah Tiket</small>
                    <strong class="text-dark">{{ $order->ticket_qty }} Tiket</strong>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Harga per Tiket</small>
                    <strong class="text-dark">Rp {{ number_format($order->ticket_price, 0, ',', '.') }}</strong>
                </div>
                <div class="col-12">
                    <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center border">
                        <span class="fw-bold fs-5">Total Pembayaran:</span>
                        <span class="fw-bold fs-4 text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <a href="{{ route('order.ticket', $order->booking_code) }}" target="_blank" class="btn btn-outline-success rounded-pill px-4">
                    <i class="bi bi-qr-code me-1"></i> Lihat E-Ticket Publik
                </a>
            </div>
        </div>
    </div>

    <!-- Panel Bukti & Ubah Status -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
            <h5 class="fw-bold mb-3">Ubah Status Pesanan</h5>
            <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Pilih Status Baru</label>
                    <select name="status" class="form-select">
                        <option value="Menunggu Pembayaran" {{ $order->payment_status === 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="Menunggu Verifikasi" {{ $order->payment_status === 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="Lunas" {{ $order->payment_status === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Ditolak" {{ $order->payment_status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Dibatalkan" {{ $order->payment_status === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-bold">
                    Perbarui Status
                </button>
            </form>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="fw-bold mb-3">Bukti Pembayaran</h5>
            @if($order->payment_proof)
                <div class="mb-3 text-center">
                    <a href="{{ asset($order->payment_proof) }}" target="_blank">
                        <img src="{{ asset($order->payment_proof) }}" class="img-fluid rounded-3 border shadow-sm" alt="Bukti Pembayaran">
                    </a>
                </div>
                <a href="{{ asset($order->payment_proof) }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill btn-sm">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Buka Gambar Asli
                </a>
            @else
                <p class="text-muted small text-center py-4 mb-0">Pengunjung belum mengunggah bukti pembayaran.</p>
            @endif
        </div>
    </div>
</div>
@endsection
