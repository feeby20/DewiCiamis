@extends('layouts.app')

@section('title', 'DewiCiamis - Desa Wisata Kabupaten Ciamis')

@section('content')
<!-- =====================================================
     HERO SECTION
====================================================== -->
<section class="hero" id="beranda">
    <div class="hero-overlay"></div>

    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="hero-badge">
                    <i class="bi bi-geo-alt-fill"></i> Kabupaten Ciamis
                </span>

                <h1>
                    Eksplor Wisata
                    <span>DewiCiamis</span>
                </h1>

                <p>
                    Temukan keindahan alam, budaya, sejarah, dan berbagai potensi wisata yang dimiliki desa-desa di Kabupaten Ciamis.
                </p>

                <div class="hero-buttons mt-4">
                    <a href="{{ route('destinasi.index') }}" class="btn btn-primary rounded-pill px-4 py-3 fw-semibold shadow-sm">
                        <i class="bi bi-compass me-2"></i>Jelajahi Desa Wisata
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-down">
        <span>Scroll untuk menjelajah</span>
        <i class="bi bi-chevron-down"></i>
    </div>
</section>

<!-- =====================================================
     PENGANTAR
====================================================== -->
<section class="intro-section" id="tentang-singkat">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="intro-image">
                    <img src="{{ asset('pictures/Dispar.png') }}" alt="Desa Wisata Kabupaten Ciamis">
                    <div class="intro-image-card">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <strong>57 Desa Wisata</strong>
                            <small>Kabupaten Ciamis</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <span class="section-label">DEWICIAMIS</span>
                <h2>
                    Kenali Pesona Desa
                    <span>Ciamis</span>
                </h2>

                <p>
                    Kabupaten Ciamis memiliki berbagai desa dengan potensi wisata yang menarik untuk dikunjungi. Mulai dari wisata alam, budaya, sejarah, hingga wisata buatan.
                </p>

                <p>
                    Website ini hadir untuk membantu masyarakat dan wisatawan mengenal lebih dekat berbagai destinasi wisata yang ada di desa-desa Kabupaten Ciamis serta memudahkan pemesanan tiket masuk secara daring.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     KATEGORI
====================================================== -->
<section class="category-section">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-label">JENIS WISATA</span>
            <h2>
                Jelajahi Berdasarkan
                <span>Kategori</span>
            </h2>
            <p>Temukan berbagai jenis wisata yang tersedia di Kabupaten Ciamis.</p>
        </div>

        <div class="row g-4 mt-3">
            <div class="col-md-4">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="bi bi-tree-fill"></i>
                    </div>
                    <h3>Wisata Alam</h3>
                    <p>Nikmati keindahan alam Ciamis seperti curug, bukit, sungai, hutan, situ, dan berbagai panorama alam lainnya.</p>
                    <a href="{{ route('destinasi.index', ['kategori' => 'Alam']) }}">
                        Jelajahi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="bi bi-buildings-fill"></i>
                    </div>
                    <h3>Wisata Buatan</h3>
                    <p>Berbagai tempat wisata yang dikembangkan masyarakat desa untuk memberikan pengalaman wisata yang menarik dan edukatif.</p>
                    <a href="{{ route('destinasi.index', ['kategori' => 'Buatan']) }}">
                        Jelajahi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="bi bi-bank2"></i>
                    </div>
                    <h3>Sejarah &amp; Budaya</h3>
                    <p>Kenali situs bersejarah, budaya, tradisi, kampung adat, dan peninggalan sejarah yang ada di Ciamis.</p>
                    <a href="{{ route('destinasi.index', ['kategori' => 'Sejarah & Budaya']) }}">
                        Jelajahi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     DESA WISATA UNGGULAN
====================================================== -->
<section class="featured-section">
    <div class="container">
        <div class="section-heading d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <span class="section-label">DESA WISATA</span>
                <h2>Desa Wisata <span>Unggulan</span></h2>
            </div>
            <a href="{{ route('destinasi.index') }}" class="btn btn-outline-primary mt-2 mt-sm-0">
                Lihat Semua Desa Wisata <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="{{ asset('pictures/destinasi/AstanaGedeKawali.jpeg') }}" alt="Desa Wisata Kawali">
                        <span class="destination-category">Sejarah &amp; Budaya</span>
                    </div>
                    <div class="destination-content">
                        <span class="location"><i class="bi bi-geo-alt-fill"></i> Kecamatan Kawali</span>
                        <h3>Desa Wisata Kawali</h3>
                        <p>Kawasan cagar budaya peninggalan Kerajaan Galuh dengan potensi destinasi utama <strong>Astana Gede Kawali</strong>.</p>
                        <a href="{{ route('destinasi.show', ['slug' => 'astana-gede-kawali']) }}">
                            Lihat Profil Desa <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="{{ asset('pictures/destinasi/SituLengkongPanjalu.jpeg') }}" alt="Desa Wisata Panjalu">
                        <span class="destination-category">Wisata Alam</span>
                    </div>
                    <div class="destination-content">
                        <span class="location"><i class="bi bi-geo-alt-fill"></i> Kecamatan Panjalu</span>
                        <h3>Desa Wisata Panjalu</h3>
                        <p>Danau legendaris dan cagar alam pulau Nusa Larang dengan potensi destinasi utama <strong>Situ Lengkong Panjalu</strong>.</p>
                        <a href="{{ route('destinasi.show', ['slug' => 'situ-lengkong-panjalu']) }}">
                            Lihat Profil Desa <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="{{ asset('pictures/destinasi/CadasNgampar.webp') }}" alt="Desa Wisata Gunungsari">
                        <span class="destination-category">Wisata Alam</span>
                    </div>
                    <div class="destination-content">
                        <span class="location"><i class="bi bi-geo-alt-fill"></i> Kecamatan Sadananya</span>
                        <h3>Desa Wisata Gunungsari</h3>
                        <p>Wisata alam pegunungan dengan panorama sungai berbatu jernih dengan potensi utama <strong>Cadas Ngampar</strong>.</p>
                        <a href="{{ route('destinasi.show', ['slug' => 'cadas-ngampar']) }}">
                            Lihat Profil Desa <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     BERITA TERBARU (JIKA ADA)
====================================================== -->
@if($beritaTerbaru->count() > 0)
<section class="news-section py-5 bg-light">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <span class="section-label">KABAR TERKINI</span>
            <h2>Berita & <span>Informasi</span></h2>
            <p>Dapatkan berita terbaru seputar kegiatan dan perkembangan pariwisata di Ciamis.</p>
        </div>

        <div class="row g-4">
            @foreach($beritaTerbaru as $b)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    @if($b->gambar)
                        <img src="{{ asset($b->gambar) }}" class="card-img-top" alt="{{ $b->judul }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-newspaper fs-1"></i>
                        </div>
                    @endif
                    <div class="card-body p-4">
                        <small class="text-muted d-block mb-2"><i class="bi bi-calendar3 me-1"></i>{{ $b->tanggal ? $b->tanggal->format('d M Y') : '-' }}</small>
                        <h5 class="card-title fw-bold text-dark mb-2">{{ Str::limit($b->judul, 60) }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($b->ringkasan, 100) }}</p>
                        <a href="{{ route('berita.show', $b->id) }}" class="text-success fw-bold text-decoration-none">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- =====================================================
     CTA SECTION
====================================================== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <div>
                <span class="section-label">TEMUKAN DESTINASIMU</span>
                <h2>Siap Menjelajahi <span>Ciamis?</span></h2>
                <p>Temukan berbagai destinasi menarik dari 57 desa wisata di Kabupaten Ciamis.</p>
            </div>
            <a href="{{ route('destinasi.index') }}" class="btn btn-light btn-lg">
                Mulai Menjelajah <i class="bi bi-compass"></i>
            </a>
        </div>
    </div>
</section>
@endsection
