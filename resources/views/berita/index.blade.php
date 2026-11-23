@extends('layouts.app')

@section('title', 'Berita & Informasi - DewiCiamis')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/berita.css') }}">
@endpush

@section('content')
<header class="berita-intro page-header text-center" style="padding-top: 105px !important; padding-bottom: 22px !important; background: #fff;">
    <div class="container">
        <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-2 small fw-semibold">
            <i class="bi bi-newspaper me-1"></i> INFORMASI RESMI
        </span>
        <h1 class="fw-bold text-dark mb-2" style="font-size: 1.85rem;">Kabar & Berita Wisata Ciamis</h1>
        <p class="text-muted mx-auto mb-0" style="max-width: 580px; font-size: 0.95rem;">
            Ikuti berbagai kabar terbaru, agenda festival, serta perkembangan desa wisata di wilayah Kabupaten Ciamis.
        </p>
    </div>
</header>

<div class="container py-3">
    <div class="row g-3 g-md-4">
        @forelse($beritaList as $berita)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    @if($berita->gambar)
                        <img src="{{ asset($berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 180px;">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                    <div class="card-body p-3 p-md-3 d-flex flex-column">
                        <small class="text-muted mb-1" style="font-size: 0.8rem;">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $berita->tanggal ? $berita->tanggal->format('d F Y') : '-' }}
                        </small>
                        <h5 class="fw-bold text-dark mb-2" style="font-size: 1.05rem; line-height: 1.45;">{{ $berita->judul }}</h5>
                        <p class="text-secondary mb-3 flex-grow-1" style="font-size: 0.875rem; line-height: 1.55;">
                            {{ Str::limit($berita->ringkasan, 110) }}
                        </p>
                        <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-sm btn-outline-success rounded-pill mt-auto py-2 px-3 fw-medium" style="font-size: 0.85rem;">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-4">
                <div class="py-3">
                    <i class="bi bi-newspaper display-3 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold text-dark mb-2">Belum Ada Berita</h4>
                    <p class="text-muted mb-0">Kabar dan informasi terbaru mengenai desa wisata akan segera kami perbarui di sini.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($beritaList->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        {{ $beritaList->links() }}
    </div>
    @endif
</div>
@endsection
