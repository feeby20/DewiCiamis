@extends('layouts.app')

@section('title', 'E-Ticket #' . $order->booking_code . ' - DewiCiamis')

@push('styles')
<style>
    .ticket-container {
        max-width: 720px;
        margin: 40px auto;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 2px dashed #176b45;
    }
    .ticket-header {
        background: #176b45;
        color: #fff;
        padding: 30px;
        text-align: center;
        position: relative;
    }
    .ticket-body {
        padding: 35px;
    }
    .ticket-code {
        background: #f1f8f4;
        border: 1px solid #cce7d8;
        padding: 12px 20px;
        border-radius: 12px;
        font-family: monospace;
        font-size: 1.3rem;
        font-weight: bold;
        color: #176b45;
        display: inline-block;
    }
    @media print {
        header, footer, nav, .btn-print, .auth-modal {
            display: none !important;
        }
        body {
            background: #fff !important;
            padding: 0 !important;
        }
        .ticket-container {
            box-shadow: none !important;
            margin: 0 auto !important;
            border: 2px solid #000 !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px !important;">
    <div class="text-center mb-3 btn-print">
        <a href="{{ route('order.index') }}" class="btn btn-outline-secondary rounded-pill me-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-success rounded-pill px-4 fw-bold">
            <i class="bi bi-printer me-1"></i> Cetak / Simpan PDF
        </button>
    </div>

    <div class="ticket-container">
        <div class="ticket-header">
            <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo" style="height: 60px;" class="mb-2">
            <h3 class="fw-bold mb-1">E-TICKET DEWICIAMIS</h3>
            <p class="mb-0 opacity-75 small">Dinas Pariwisata Kabupaten Ciamis</p>
        </div>

        <div class="ticket-body">
            <div class="text-center mb-4">
                <span class="text-muted d-block small mb-1">KODE BOOKING</span>
                <div class="ticket-code">{{ $order->booking_code }}</div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-sm-6">
                    <small class="text-muted d-block">Destinasi Wisata</small>
                    <h5 class="fw-bold text-dark">{{ $order->destination_name }}</h5>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Nama Pemesan</small>
                    <h5 class="fw-bold text-dark">{{ $order->full_name }}</h5>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Tanggal Kunjungan</small>
                    <h5 class="fw-bold text-dark">{{ $order->visit_date ? $order->visit_date->format('d F Y') : '-' }}</h5>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Jumlah Tiket</small>
                    <h5 class="fw-bold text-success">{{ $order->ticket_qty }} Pengunjung (Lunas)</h5>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Nomor WhatsApp</small>
                    <span class="text-dark">{{ $order->whatsapp }}</span>
                </div>
                <div class="col-sm-6">
                    <small class="text-muted d-block">Total Pembayaran</small>
                    <span class="fw-bold text-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Barcode mockup / QR Code info -->
            <div class="p-3 bg-light rounded-4 text-center border">
                <i class="bi bi-upc-scan fs-1 text-secondary d-block"></i>
                <small class="text-muted">Tunjukkan e-ticket ini kepada petugas gerbang tiket di lokasi destinasi wisata.</small>
            </div>
        </div>
    </div>
</div>
@endsection
