@extends('layouts.app')

@section('title', 'Pesan Tiket Wisata - DewiCiamis')

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Tiket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form Pemesanan</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white">
                <div class="text-center mb-3">
                    <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-1 small fw-semibold">
                        <i class="bi bi-cart-check me-1"></i> RESERVASI TIKET
                    </span>
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Formulir Pemesanan Tiket</h2>
                    <p class="text-muted small mb-0">Isi data di bawah ini untuk memesan tiket masuk desa wisata di Ciamis</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger py-2 small">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('order.store') }}" method="POST" id="bookingForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small fw-bold mb-1">Pilih Destinasi Wisata</label>
                        <select name="destinasi" id="destinationSelect" class="form-select py-2" required>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->destination_name }}"
                                        data-price="{{ $dest->ticket_price }}"
                                        {{ $selectedDestination === $dest->destination_name ? 'selected' : '' }}>
                                    {{ $dest->destination_name }} - Rp {{ number_format($dest->ticket_price, 0, ',', '.') }}/tiket
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold mb-1">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control py-2"
                                   value="{{ Auth::check() ? Auth::user()->nama : old('name') }}"
                                   placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold mb-1">Nomor WhatsApp</label>
                            <input type="tel" name="whatsapp" class="form-control py-2"
                                   value="{{ old('whatsapp') }}"
                                   placeholder="Contoh: 081234567890" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold mb-1">Tanggal Kunjungan</label>
                            <input type="date" name="date" id="visitDate" class="form-control py-2"
                                   min="{{ date('Y-m-d') }}" value="{{ old('date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold mb-1">Jumlah Tiket</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary" id="btnMinus"><i class="bi bi-dash"></i></button>
                                <input type="number" name="quantity" id="ticketQty" class="form-control text-center py-2"
                                       value="{{ old('quantity', 1) }}" min="1" max="100" required>
                                <button type="button" class="btn btn-outline-secondary" id="btnPlus"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Harga -->
                    <div class="p-3 rounded-3 bg-light mb-3 border small">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Harga Tiket:</span>
                            <span class="fw-semibold" id="pricePerTicket">Rp 6.500</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Jumlah:</span>
                            <span class="fw-semibold" id="summaryQty">1 Tiket</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">Total Pembayaran:</span>
                            <span class="fw-bold fs-5 text-success" id="totalPrice">Rp 6.500</span>
                        </div>
                    </div>

                    @auth('web')
                        <button type="submit" class="btn btn-success w-100 py-2 rounded-pill fw-bold" style="font-size: 0.95rem;">
                            <i class="bi bi-shield-lock-fill me-1"></i> Lanjutkan ke Pembayaran
                        </button>
                    @else
                        <button type="button" class="btn btn-success w-100 py-2 rounded-pill fw-bold" style="font-size: 0.95rem;" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk untuk Memesan
                        </button>
                    @endauth
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const destSelect = document.getElementById('destinationSelect');
    const qtyInput = document.getElementById('ticketQty');
    const btnMinus = document.getElementById('btnMinus');
    const btnPlus = document.getElementById('btnPlus');
    const pricePerTicket = document.getElementById('pricePerTicket');
    const summaryQty = document.getElementById('summaryQty');
    const totalPrice = document.getElementById('totalPrice');

    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function calculateTotal() {
        const selectedOpt = destSelect.options[destSelect.selectedIndex];
        const price = parseInt(selectedOpt.getAttribute('data-price') || 0, 10);
        let qty = parseInt(qtyInput.value, 10);
        if (isNaN(qty) || qty < 1) qty = 1;

        pricePerTicket.textContent = formatRupiah(price);
        summaryQty.textContent = qty + ' Tiket';
        totalPrice.textContent = formatRupiah(price * qty);
    }

    btnMinus.addEventListener('click', function () {
        let q = parseInt(qtyInput.value, 10) || 1;
        if (q > 1) {
            qtyInput.value = q - 1;
            calculateTotal();
        }
    });

    btnPlus.addEventListener('click', function () {
        let q = parseInt(qtyInput.value, 10) || 1;
        if (q < 100) {
            qtyInput.value = q + 1;
            calculateTotal();
        }
    });

    destSelect.addEventListener('change', calculateTotal);
    qtyInput.addEventListener('input', calculateTotal);

    calculateTotal();
});
</script>
@endpush
