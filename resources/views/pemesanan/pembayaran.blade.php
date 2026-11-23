@extends('layouts.app')

@section('title', 'Pembayaran Tiket #' . $order->booking_code . ' - DewiCiamis')

@php
    $st = strtolower(trim($order->payment_status));
    $isPaid = in_array($st, ['lunas', 'paid']);
    $isVerif = $st === 'menunggu verifikasi' || (!empty($order->payment_proof) && !$isPaid);
@endphp

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Tiket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white">
                <div class="text-center mb-3">
                    <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill fw-semibold mb-2 small">
                        <i class="bi bi-wallet2 me-1"></i> METODE PEMBAYARAN QRIS, TRANSFER BANK & E-WALLET
                    </span>
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Selesaikan Pembayaran Tiket</h2>
                    <div class="p-2 px-3 bg-light rounded-pill d-inline-block border mt-2">
                        <small class="text-muted">Kode Booking:</small>
                        <strong class="text-success font-monospace">{{ $order->booking_code }}</strong>
                    </div>
                </div>

                @if(session('info'))
                    <div class="alert alert-info rounded-3">{{ session('info') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
                @endif

                <!-- Rincian Pesanan -->
                <div class="border rounded-4 p-4 mb-4 bg-light">
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Nama Pemesan</span>
                        <strong class="text-dark">{{ $order->full_name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Destinasi</span>
                        <strong class="text-dark">{{ $order->destination_name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Tanggal Kunjungan</span>
                        <strong class="text-dark">{{ $order->visit_date ? $order->visit_date->format('d F Y') : '-' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Jumlah Tiket</span>
                        <strong class="text-dark">{{ $order->ticket_qty }} Tiket</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Harga Satuan</span>
                        <strong class="text-dark">Rp {{ number_format($order->ticket_price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-3 align-items-center">
                        <span class="fw-bold text-dark fs-5">Total Pembayaran</span>
                        <span class="fw-bold text-success fs-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($isPaid)
                    <div class="alert alert-success text-center py-4 rounded-4 shadow-sm">
                        <i class="bi bi-check-circle-fill display-4 text-success d-block mb-2"></i>
                        <h4 class="fw-bold">Pembayaran Lunas!</h4>
                        <p class="mb-3">Pesanan Anda telah berhasil dikonfirmasi oleh Admin Dinas Pariwisata. E-Ticket Anda aktif dan siap digunakan untuk berkunjung.</p>
                        <a href="{{ route('order.ticket', $order->booking_code) }}" class="btn btn-success btn-lg px-4 rounded-pill fw-bold">
                            <i class="bi bi-qr-code me-2"></i> Buka & Cetak E-Ticket
                        </a>
                    </div>
                @else
                    @if($isVerif)
                        <div class="alert alert-info text-center py-4 rounded-4 mb-4 shadow-sm">
                            <i class="bi bi-hourglass-split display-5 text-primary d-block mb-2"></i>
                            <h5 class="fw-bold">Bukti Transfer Sedang Diverifikasi</h5>
                            <p class="mb-0 small">Admin Dinas Pariwisata Ciamis sedang memverifikasi resi pembayaran Anda. Status pesanan akan otomatis berubah menjadi <strong>Lunas</strong> setelah divalidasi.</p>
                        </div>
                    @else
                        <!-- PILIHAN METODE PEMBAYARAN: TRANSFER BANK & E-WALLET -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="fw-bold text-dark mb-0">Pilih Metode Pembayaran</h5>
                                <small class="text-muted">QRIS disarankan untuk nominal kecil</small>
                            </div>

                            <!-- Nav Tabs -->
                            <ul class="nav nav-pills nav-fill mb-3 p-1 bg-light rounded-pill border" id="pembayaranTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill fw-semibold py-2" id="bank-tab" data-bs-toggle="pill" data-bs-target="#tab-bank" type="button" role="tab">
                                        <i class="bi bi-bank me-1"></i> Transfer Bank
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill fw-semibold py-2" id="ewallet-tab" data-bs-toggle="pill" data-bs-target="#tab-ewallet" type="button" role="tab">
                                        <i class="bi bi-phone me-1"></i> E-Wallet
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active rounded-pill fw-semibold py-2" id="qris-tab" data-bs-toggle="pill" data-bs-target="#tab-qris" type="button" role="tab">
                                        <i class="bi bi-qr-code me-1"></i> QRIS
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pembayaranTabContent">
                                <!-- TAB QRIS (Default Active) -->
                                <div class="tab-pane fade show active" id="tab-qris" role="tabpanel">
                                    <div class="text-center py-3">
                                        <div class="card border-0 shadow-sm rounded-4 p-4 mx-auto" style="max-width: 420px;">
                                            <div class="mb-3">
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                                                    <i class="bi bi-qr-code-scan me-1"></i> Scan QRIS — Tanpa Minimum Transfer
                                                </span>
                                            </div>
                                            <h5 class="fw-bold text-dark mb-2">Bayar via QRIS</h5>
                                            <p class="text-muted small mb-3">Scan kode QR di bawah menggunakan aplikasi e-wallet (DANA, GoPay, OVO, ShopeePay) atau M-Banking Anda. QRIS mendukung semua nominal termasuk di bawah Rp 10.000.</p>
                                            <div class="bg-white border rounded-4 p-3 mb-3 d-inline-block">
                                                <img src="{{ asset('pictures/qris.jpeg') }}" alt="QRIS Dinas Pariwisata Ciamis" class="img-fluid rounded-3" style="max-width: 280px; max-height: 320px;">
                                            </div>
                                            <div class="bg-light rounded-3 p-3 border">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <span class="text-muted small">Nama Merchant:</span>
                                                    <strong class="text-dark small">Dinas Pariwisata Ciamis</strong>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted small">Total Bayar:</span>
                                                    <strong class="text-success fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <small class="text-muted"><i class="bi bi-shield-check me-1 text-success"></i>Pembayaran QRIS terverifikasi & aman oleh Bank Indonesia</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB TRANSFER BANK -->
                                <div class="tab-pane fade" id="tab-bank" role="tabpanel">
                                    <div class="row g-3">
                                        <!-- Bank BJB -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm position-relative">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-primary px-2 py-1 rounded-pill mb-1">Utama (Kasda)</span>
                                                        <h6 class="fw-bold mb-0 text-dark">Bank BJB</h6>
                                                    </div>
                                                    <i class="bi bi-bank2 text-primary fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Rekening:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="rek-bjb">0012345678001</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('rek-bjb', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dinas Pariwisata Ciamis</strong></div>
                                            </div>
                                        </div>

                                        <!-- Bank BRI -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm position-relative">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-info text-dark px-2 py-1 rounded-pill mb-1">Bank BUMN</span>
                                                        <h6 class="fw-bold mb-0 text-dark">Bank BRI</h6>
                                                    </div>
                                                    <i class="bi bi-credit-card text-info fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Rekening:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="rek-bri">012301000456508</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('rek-bri', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dispar Ciamis Tiket Wisata</strong></div>
                                            </div>
                                        </div>

                                        <!-- Bank BCA -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm position-relative">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="fw-bold mb-0 text-dark">Bank BCA</h6>
                                                    <i class="bi bi-credit-card-2-front text-primary fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Rekening:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="rek-bca">8123456789</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('rek-bca', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dispar Ciamis E-Ticketing</strong></div>
                                            </div>
                                        </div>

                                        <!-- Bank Mandiri -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm position-relative">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="fw-bold mb-0 text-dark">Bank Mandiri</h6>
                                                    <i class="bi bi-cash-coin text-warning fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Rekening:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="rek-mandiri">1320012345678</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('rek-mandiri', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dinas Pariwisata Ciamis</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB E-WALLET -->
                                <div class="tab-pane fade" id="tab-ewallet" role="tabpanel">
                                    <div class="row g-3">
                                        <!-- DANA -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-primary px-2 py-1 rounded-pill mb-1">E-Wallet</span>
                                                        <h6 class="fw-bold mb-0 text-dark">DANA</h6>
                                                    </div>
                                                    <i class="bi bi-phone text-primary fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Akun DANA:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="ewallet-dana">081234567890</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('ewallet-dana', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dispar Ciamis</strong></div>
                                            </div>
                                        </div>

                                        <!-- GoPay -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-success px-2 py-1 rounded-pill mb-1">E-Wallet</span>
                                                        <h6 class="fw-bold mb-0 text-dark">GoPay</h6>
                                                    </div>
                                                    <i class="bi bi-phone-fill text-success fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Akun GoPay:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="ewallet-gopay">081234567890</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('ewallet-gopay', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dispar Ciamis</strong></div>
                                            </div>
                                        </div>

                                        <!-- OVO -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-secondary px-2 py-1 rounded-pill mb-1">E-Wallet</span>
                                                        <h6 class="fw-bold mb-0 text-dark">OVO</h6>
                                                    </div>
                                                    <i class="bi bi-wallet text-secondary fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Akun OVO:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="ewallet-ovo">081234567890</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('ewallet-ovo', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dispar Ciamis</strong></div>
                                            </div>
                                        </div>

                                        <!-- ShopeePay -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border rounded-4 p-3 bg-white shadow-sm">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-danger px-2 py-1 rounded-pill mb-1">E-Wallet</span>
                                                        <h6 class="fw-bold mb-0 text-dark">ShopeePay</h6>
                                                    </div>
                                                    <i class="bi bi-bag-check text-danger fs-4"></i>
                                                </div>
                                                <div class="small text-muted mb-1">Nomor Akun ShopeePay:</div>
                                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded-3 border mb-2">
                                                    <code class="fs-6 fw-bold text-dark" id="ewallet-spay">081234567890</code>
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" onclick="copyText('ewallet-spay', this)">
                                                        <i class="bi bi-clipboard"></i> Salin
                                                    </button>
                                                </div>
                                                <div class="small text-muted">a.n <strong>Dispar Ciamis</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning rounded-3 small mb-4">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            <strong>Petunjuk Pembayaran:</strong> Silakan bayar sebesar <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> via scan QRIS, transfer bank, atau e-wallet ke nomor akun resmi di atas. Untuk nominal di bawah Rp 10.000 disarankan menggunakan <strong>QRIS</strong> atau <strong>E-Wallet</strong>. Setelah bayar, unggah bukti pembayaran pada formulir di bawah.
                        </div>
                    @endif

                    <!-- Form Unggah Bukti -->
                    <div class="card border border-2 border-dashed p-4 rounded-4 bg-light">
                        <h5 class="fw-bold mb-2"><i class="bi bi-cloud-arrow-up-fill text-success me-2"></i>Unggah Bukti Pembayaran</h5>
                        <p class="text-muted small mb-3">Setelah melakukan pembayaran via QRIS, transfer bank, atau e-wallet, silakan lampirkan tangkapan layar (screenshot) atau foto struk/bukti pembayaran Anda.</p>

                        <form action="{{ route('order.upload_proof') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="booking_code" value="{{ $order->booking_code }}">

                            <div class="mb-3">
                                <input type="file" name="payment_proof" class="form-control form-control-lg" accept="image/jpeg,image/png,image/jpg,image/webp" required>
                                <small class="text-muted">Format: JPG, JPEG, PNG, WEBP (Maksimal 3 MB)</small>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill fw-bold">
                                <i class="bi bi-send-check me-2"></i> Kirim Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                @endif

                <div class="text-center mt-4">
                    <a href="{{ route('order.index') }}" class="text-muted text-decoration-none small">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyText(elementId, btn) {
    var text = document.getElementById(elementId).innerText.trim();
    navigator.clipboard.writeText(text).then(function() {
        var originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check2"></i> Tersalin!';
        btn.classList.remove('btn-outline-success');
        btn.classList.add('btn-success');
        setTimeout(function() {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-success');
        }, 2000);
    }).catch(function() {
        alert('Nomor tersalin: ' + text);
    });
}
</script>
@endsection
