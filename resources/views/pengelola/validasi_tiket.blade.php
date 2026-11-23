@extends('layouts.pengelola')

@section('title', 'Scan & Validasi E-Ticket - ' . $desa->nama_desa)
@section('page_title', 'Validasi & Check-in Tiket Masuk')

@section('content')
<div class="row g-4">
    <!-- FORM SCAN / INPUT KODE BOOKING -->
    <div class="col-lg-6">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <h5 class="fw-bold text-dark mb-1">Cek Kode E-Ticket Wisatawan</h5>
            <p class="text-muted small mb-4">Ketik kode booking tiket atau gunakan barcode scanner saat wisatawan tiba di lokasi gerbang masuk.</p>

            <form action="{{ route('pengelola.validasi.check') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Kode Booking / Scan QR</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-qr-code"></i></span>
                        <input type="text" name="booking_code" class="form-control font-monospace text-uppercase" placeholder="Contoh: VC-20261110-3F048442" value="{{ old('booking_code') }}" required autofocus>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success py-2 rounded-pill fw-semibold">
                        <i class="bi bi-search me-1"></i> Periksa Validitas Tiket
                    </button>
                </div>
            </form>

            <!-- HASIL PEMERIKSAAN TIKET -->
            @if(session('checked_order'))
                @php $ord = session('checked_order'); @endphp
                <div class="border rounded-4 p-4 bg-light shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">Data E-Ticket Ditemukan</h6>
                        @if($ord->payment_status === 'lunas' && $ord->ticket_status === 'active')
                            <span class="badge bg-success px-3 py-2 rounded-pill">TIKET VALID & SIAP CHECK-IN</span>
                        @elseif($ord->ticket_status === 'used')
                            <span class="badge bg-danger px-3 py-2 rounded-pill">SUDAH TERPAKAI</span>
                        @else
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">STATUS: {{ strtoupper($ord->payment_status) }}</span>
                        @endif
                    </div>

                    <ul class="list-unstyled mb-3 small">
                        <li class="mb-1"><strong>Kode Booking:</strong> <code class="fs-6">{{ $ord->booking_code }}</code></li>
                        <li class="mb-1"><strong>Nama Wisatawan:</strong> {{ $ord->full_name }}</li>
                        <li class="mb-1"><strong>WhatsApp:</strong> {{ $ord->whatsapp }}</li>
                        <li class="mb-1"><strong>Destinasi:</strong> {{ $ord->destination_name }}</li>
                        <li class="mb-1"><strong>Tgl Kunjungan:</strong> {{ $ord->visit_date ? $ord->visit_date->format('d M Y') : '-' }}</li>
                        <li class="mb-1"><strong>Jumlah Tiket:</strong> <span class="badge bg-primary">{{ $ord->ticket_qty }} Orang</span></li>
                        <li class="mb-1"><strong>Total Biaya:</strong> Rp {{ number_format($ord->total_price, 0, ',', '.') }}</li>
                        <li class="mb-1"><strong>Status Pembayaran:</strong> <span class="badge {{ $ord->payment_status === 'lunas' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($ord->payment_status) }}</span></li>
                    </ul>

                    @if($ord->payment_status === 'lunas' && $ord->ticket_status === 'active')
                        <form action="{{ route('pengelola.validasi.confirm', $ord->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold" onclick="return confirm('Validasi dan izinkan masuk rombongan {{ $ord->full_name }} ({{ $ord->ticket_qty }} orang)?')">
                                <i class="bi bi-check2-circle me-1"></i> VALIDASI & IZINKAN MASUK
                            </button>
                        </form>
                    @elseif($ord->ticket_status === 'used')
                        <div class="alert alert-danger mb-0 small rounded-3">
                            <i class="bi bi-x-circle-fill me-1"></i> Tiket ini telah divalidasi pada {{ $ord->validated_at ? $ord->validated_at->format('d M Y H:i') : '-' }}. Tidak dapat digunakan kembali.
                        </div>
                    @else
                        <div class="alert alert-warning mb-0 small rounded-3">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Pembayaran tiket ini belum terkonfirmasi lunas oleh Admin Dinas.
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- RIWAYAT TIKET YANG BARU SAJA DIVALIDASI -->
    <div class="col-lg-6">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <h5 class="fw-bold text-dark mb-1">Riwayat Validasi Hari Ini</h5>
            <p class="text-muted small mb-3">Daftar wisatawan yang telah divalidasi masuk ke desa wisata.</p>

            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Waktu Scan</th>
                            <th>Kode Booking</th>
                            <th>Wisatawan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $item)
                        <tr>
                            <td>{{ $item->validated_at ? $item->validated_at->format('H:i') : '-' }} WIB</td>
                            <td><code>{{ $item->booking_code }}</code></td>
                            <td>{{ $item->full_name }}</td>
                            <td><span class="badge bg-success-subtle text-success">{{ $item->ticket_qty }} Tiket</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada tiket yang divalidasi pada sesi ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
