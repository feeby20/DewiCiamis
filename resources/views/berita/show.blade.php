@extends('layouts.app')

@section('title', $berita->judul . ' - Berita DewiCiamis')

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px !important;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 40) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-8">
            <article class="bg-white p-3 p-md-4 rounded-4 shadow-sm">
                <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-2 small fw-semibold">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $berita->tanggal ? $berita->tanggal->format('d F Y') : '-' }}
                </span>
                <h1 class="fw-bold mb-3" style="font-size: 1.65rem; line-height: 1.35;">{{ $berita->judul }}</h1>

                @if($berita->gambar)
                    <div class="mb-4 rounded-4 overflow-hidden">
                        <img src="{{ asset($berita->gambar) }}" class="img-fluid w-100" alt="{{ $berita->judul }}" style="max-height: 450px; object-fit: cover;">
                    </div>
                @endif

                <div class="lead text-secondary mb-4 p-3 bg-light rounded-3 border-start border-4 border-success">
                    {{ $berita->ringkasan }}
                </div>

                <div class="article-content text-dark" style="font-size: 1.05rem; line-height: 1.9;">
                    {!! nl2br(e($berita->isi)) !!}
                </div>
            </article>
        </div>

        <!-- Sidebar Berita Terkait -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                <h4 class="fw-bold mb-4">Berita Lainnya</h4>
                <div class="d-flex flex-column gap-3">
                    @forelse($beritaTerkait as $rel)
                        <div class="border-bottom pb-3">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-clock me-1"></i>{{ $rel->tanggal ? $rel->tanggal->format('d M Y') : '' }}
                            </small>
                            <h6 class="fw-bold mb-1">
                                <a href="{{ route('berita.show', $rel->id) }}" class="text-dark text-decoration-none hover-success">
                                    {{ Str::limit($rel->judul, 60) }}
                                </a>
                            </h6>
                        </div>
                    @empty
                        <p class="text-muted small">Belum ada berita lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
