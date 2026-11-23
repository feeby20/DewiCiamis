@extends('layouts.app')

@section('title', $destinationName . ' - Detail DewiCiamis')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<style>
    .star-rating .bi-star-fill { color: #ffc107; }
    .star-rating .bi-star { color: #dee2e6; }
</style>
@endpush

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px !important;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi.index') }}">Desa Wisata</a></li>
            <li class="breadcrumb-item"><span class="text-secondary">Desa {{ $destVillage ?? 'Ciamis' }}</span></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $destinationName }}</li>
        </ol>
    </nav>

    @if(session('success_ulasan'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success_ulasan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                <img src="{{ asset('pictures/destinasi/' . str_replace(' ', '', $destinationName) . '.jpeg') }}"
                     onerror="this.src='{{ asset($destGallery[0] ?? 'pictures/LogoDispar.png') }}'"
                     class="img-fluid w-100"
                     style="max-height: 420px; object-fit: cover;"
                     alt="{{ $destinationName }}">
                <div class="card-body p-4 p-md-4">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill small fw-semibold">
                            <i class="bi bi-tag-fill me-1"></i> {{ $destCategory ?? 'Wisata Alam' }}
                        </span>
                        <span class="badge bg-light text-secondary border px-3 py-1-5 rounded-pill small">
                            <i class="bi bi-geo-alt-fill text-success me-1"></i> Desa {{ $destVillage ?? 'Ciamis' }}, Kec. {{ $destDistrict ?? 'Ciamis' }}
                        </span>
                    </div>

                    <h1 class="fw-bold text-dark mb-2" style="font-size: 1.95rem;">{{ $destinationName }}</h1>
                    <p class="lead text-muted small mb-3" style="font-size: 1rem;">
                        Nikmati pesona keindahan dan keunikan destinasi wisata <strong>{{ $destinationName }}</strong> di Kabupaten Ciamis.
                    </p>

                    <hr class="my-4">

                    <!-- DESKRIPSI LENGKAP -->
                    <h5 class="fw-bold text-dark mb-2" style="font-size: 1.2rem;">
                        <i class="bi bi-info-circle-fill text-success me-2"></i>Tentang &amp; Daya Tarik Destinasi
                    </h5>
                    <p class="text-secondary mb-4" style="line-height: 1.8; font-size: 0.965rem;">
                        {{ $destDescription }}
                    </p>

                    <!-- FASILITAS LENGKAP -->
                    <h5 class="fw-bold text-dark mt-4 mb-3" style="font-size: 1.2rem;">
                        <i class="bi bi-stars text-warning me-2"></i>Fasilitas Lengkap Destinasi
                    </h5>
                    <div class="row g-3 mb-2">
                        @foreach($destFacilities as $fac)
                            @php
                                $fName = is_array($fac) ? ($fac['nama'] ?? '') : $fac;
                                $fDesc = is_array($fac) ? ($fac['desc'] ?? '') : '';
                                $fIcon = is_array($fac) ? ($fac['icon'] ?? 'bi-check-circle-fill') : 'bi-check-circle-fill';
                            @endphp
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 bg-light border h-100 d-flex align-items-start">
                                    <div class="me-3 fs-4 text-success">
                                        <i class="bi {{ $fIcon }}"></i>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block mb-1" style="font-size: 14px;">{{ $fName }}</strong>
                                        @if(!empty($fDesc))
                                            <small class="text-secondary d-block" style="font-size: 12px; line-height: 1.5;">{{ $fDesc }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- GALERI FOTO DESTINASI -->
            @if(!empty($destGallery))
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-images text-success me-2"></i>Galeri Foto Destinasi</h5>
                    <span class="badge bg-success-subtle text-success rounded-pill">{{ count($destGallery) }} Foto</span>
                </div>
                <div class="row g-3">
                    @foreach($destGallery as $photo)
                        <div class="col-6 col-md-3">
                            <div class="rounded-3 overflow-hidden border shadow-xs position-relative" style="height: 150px;">
                                <img src="{{ asset($photo) }}"
                                     alt="{{ $destinationName }}"
                                     class="w-100 h-100 object-fit-cover"
                                     onerror="this.src='{{ asset('pictures/LogoDispar.png') }}'">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Bagian Ulasan Pengunjung -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-4 mb-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-heart text-success me-2"></i>Ulasan Pengunjung ({{ $reviews->count() }})</h5>
                </div>

                @auth('web')
                <div class="bg-light p-3 p-md-4 rounded-3 mb-4 border">
                    <h6 class="fw-bold mb-3 text-dark">Tulis Ulasan Anda</h6>
                    <form action="{{ route('destinasi.review', ['slug' => $slug]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="destination_name" value="{{ $destinationName }}">

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Beri Rating</label>
                            <select name="rating" class="form-select form-select-sm w-auto" required>
                                <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Puas)</option>
                                <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
                                <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                                <option value="2">⭐⭐ (2 - Kurang)</option>
                                <option value="1">⭐ (1 - Sangat Kurang)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Komentar / Pengalaman</label>
                            <textarea name="komentar" class="form-control form-control-sm" rows="3" placeholder="Ceritakan pengalaman Anda berkunjung ke tempat ini..." required minlength="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm px-4 rounded-pill fw-semibold">Kirim Ulasan</button>
                    </form>
                </div>
                @else
                <div class="alert alert-info d-flex align-items-center mb-4 py-2 small" role="alert">
                    <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                    <div>
                        Ingin menulis ulasan? Silakan <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="alert-link fw-semibold">masuk ke akun Anda</a> terlebih dahulu.
                    </div>
                </div>
                @endauth

                <!-- Daftar Ulasan -->
                @forelse($reviews as $rev)
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="text-dark small"><i class="bi bi-person-circle text-secondary me-2"></i>{{ $rev->user_name }}</strong>
                            <span class="text-warning small">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $rev->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </span>
                        </div>
                        <p class="text-secondary small mb-1">{{ $rev->comment }}</p>
                        <small class="text-muted" style="font-size: 11px;">{{ $rev->created_at ? $rev->created_at->diffForHumans() : '' }}</small>
                    </div>
                @empty
                    <p class="text-muted text-center py-4 small mb-0">Belum ada ulasan untuk destinasi ini. Jadilah yang pertama memberikan ulasan!</p>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Pemesanan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top mb-4 bg-white" style="top: 95px;">
                <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-2 small fw-semibold">
                    <i class="bi bi-ticket-perforated me-1"></i> RESERVASI TIKET
                </span>
                <h5 class="fw-bold mb-3 text-dark">Tiket Masuk Resmi</h5>
                <div class="mb-3 p-3 bg-light rounded-3 border">
                    <span class="text-muted d-block small">Tarif per Orang</span>
                    <h2 class="text-success fw-bold mb-0">Rp {{ number_format($ticketPrice, 0, ',', '.') }} <small class="text-secondary fs-6 fw-normal">/ tiket</small></h2>
                </div>

                <ul class="list-unstyled text-secondary small mb-4">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>E-Ticket resmi terverifikasi Dispar</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Pembayaran mudah via QRIS &amp; Transfer Bank</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Scan kode QR langsung di gerbang masuk</li>
                    <li class="mb-2"><i class="bi bi-clock-fill text-success me-2"></i>Jam Operasional: <strong>07.30 - 17.00 WIB</strong></li>
                </ul>

                <a href="{{ route('order.create', ['destinasi' => $destinationName]) }}" class="btn btn-success btn-lg w-100 py-2-5 rounded-pill fw-bold shadow-sm" style="font-size: 0.95rem;">
                    <i class="bi bi-cart-plus me-2"></i> Pesan Tiket Sekarang
                </a>
            </div>

            <!-- Kartu Info Lokasi -->
            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white">
                <h6 class="fw-bold text-dark mb-2"><i class="bi bi-geo-alt-fill text-success me-2"></i>Lokasi Destinasi</h6>
                <p class="text-secondary small mb-3">
                    Desa {{ $destVillage ?? 'Ciamis' }}, Kecamatan {{ $destDistrict ?? 'Ciamis' }}, Kabupaten Ciamis, Jawa Barat.
                </p>
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($destinationName . ' ' . ($destVillage ?? '') . ' Ciamis') }}" target="_blank" class="btn btn-outline-secondary btn-sm w-100 rounded-pill">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
