@extends('layouts.app')

@section('title', 'DewiCiamis - 57 Desa Wisata Kabupaten Ciamis')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/destinasi.css') }}?v={{ time() }}">
<style>
    .destination-header {
        padding-top: 88px !important;
        padding-bottom: 16px !important;
        background: #f3f8f5 !important;
    }
    .destination-header h1 {
        font-size: 27px !important;
        margin-top: 4px !important;
        margin-bottom: 6px !important;
    }
    .destination-header p {
        font-size: 13.5px !important;
        line-height: 1.5 !important;
        margin-bottom: 0 !important;
    }
    .destination-filter {
        padding-top: 14px !important;
        padding-bottom: 14px !important;
    }
    #destinationContainer .destination-card {
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 16px;
        background: #ffffff;
        display: flex;
        flex-direction: column;
    }
    #destinationContainer .destination-card-body {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        min-width: 0 !important;
        padding: 24px 26px !important;
        box-sizing: border-box !important;
        flex-grow: 1;
    }
    #destinationContainer .destination-card-body .destination-location {
        display: block;
        margin: 0 0 10px 0 !important;
        padding: 0 !important;
        font-size: 13px;
        line-height: 1.6;
        color: #6c757d;
    }
    #destinationContainer .destination-card-body h3.desa-title {
        display: block;
        margin: 0 0 10px 0 !important;
        padding: 0 !important;
        color: #174c38 !important;
        font-size: 21px !important;
        font-weight: 700 !important;
        line-height: 1.35 !important;
    }
    #destinationContainer .destination-card-body p.desa-desc {
        margin: 0 0 16px 0 !important;
        padding: 0 !important;
        color: #6c757d;
        font-size: 13.5px;
        line-height: 1.65;
    }
    #destinationContainer .destination-card-footer {
        margin-top: auto !important;
        padding-top: 10px;
    }
    .desa-dest-box {
        background: #fdfefe;
        border: 1px solid #dcece3 !important;
        border-radius: 10px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .desa-dest-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 76, 56, 0.08);
        border-color: #a3d9bc !important;
    }
    .dest-item-title {
        color: #174c38;
    }
    .dest-item-desc {
        color: #55625b !important;
    }
    .dest-facilities-wrap .badge {
        background: #f4fbf7 !important;
        border: 1px solid #cbe9d8 !important;
        color: #24573f !important;
        border-radius: 6px;
        font-size: 11.5px;
        padding: 3px 7px;
    }
</style>
@endpush

@section('content')
<!-- HEADER -->
<header class="destination-header" style="padding-top: 88px; padding-bottom: 16px; background: #f3f8f5;">
    <div class="container text-center">
        <div class="destination-header-content">
            <span class="section-label" style="font-size: 11.5px; padding: 4px 14px; margin-bottom: 6px; display: inline-block;">
                <i class="bi bi-compass"></i> DEWICIAMIS
            </span>
            <h1 class="fw-bold my-1" style="font-size: 27px; line-height: 1.25;">Jelajahi <span class="text-success">DewiCiamis</span></h1>
            <p class="text-muted mx-auto mb-0" style="max-width: 650px; font-size: 13.5px; line-height: 1.5;">
                Temukan potensi dan keindahan dari 57 Desa Wisata beserta kelompok destinasi wisata unggulan yang tersebar di Kabupaten Ciamis.
            </p>
        </div>
    </div>
</header>

<!-- FILTER -->
<section class="destination-filter py-3 bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-lg-4 col-md-6">
                <div class="input-group search-box-wrap shadow-sm">
                    <span class="input-group-text bg-white border-end-0 text-success">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="searchDesaInput" class="form-control border-start-0 ps-0" placeholder="Cari nama desa wisata atau destinasi...">
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <select id="desaFilter" class="form-select shadow-sm py-2">
                    <option value="Semua">Semua Desa Wisata di Ciamis</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6">
                <select id="statusFilter" class="form-select shadow-sm py-2">
                    <option value="Semua">Semua Status</option>
                    <option value="Berkembang">Berkembang</option>
                    <option value="Rintisan">Rintisan</option>
                </select>
            </div>

            <div class="col-lg-3 col-12 d-flex justify-content-lg-end align-items-center gap-2">
                <div class="btn-group shadow-sm view-toggle-group w-100 w-lg-auto" role="group">
                    <button type="button" id="viewModeGrid" class="btn btn-outline-success active flex-grow-1" title="Tampilan Kartu Grid">
                        <i class="bi bi-grid-fill me-1"></i> Kartu
                    </button>
                    <button type="button" id="viewModeList" class="btn btn-outline-success flex-grow-1" title="Tampilan Terkelompok">
                        <i class="bi bi-list-nested me-1"></i> Terkelompok
                    </button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-2">
            <div class="category-pills-wrap d-flex flex-wrap gap-2">
                <button type="button" class="category-pill-btn {{ empty($kategori) || $kategori == 'Semua' ? 'active' : '' }}" data-category-filter="Semua">
                    <i class="bi bi-grid-fill me-1"></i> Semua Desa Wisata
                </button>
                <button type="button" class="category-pill-btn {{ $kategori == 'Alam' ? 'active' : '' }}" data-category-filter="Alam">
                    <i class="bi bi-tree-fill me-1"></i> Wisata Alam
                </button>
                <button type="button" class="category-pill-btn {{ $kategori == 'Buatan' ? 'active' : '' }}" data-category-filter="Buatan">
                    <i class="bi bi-building me-1"></i> Wisata Buatan
                </button>
                <button type="button" class="category-pill-btn {{ $kategori == 'Sejarah & Budaya' ? 'active' : '' }}" data-category-filter="Sejarah & Budaya">
                    <i class="bi bi-bank me-1"></i> Sejarah &amp; Budaya
                </button>
            </div>

            <div class="filter-result-info">
                <span class="text-secondary small">
                    Menampilkan <strong id="resultCount" class="text-success fs-6">57</strong> Desa Wisata
                    (<span id="totalDestCount" class="fw-bold text-dark">85</span> Destinasi Terkelompok)
                </span>
            </div>
        </div>
    </div>
</section>

<!-- DAFTAR DESA WISATA CONTAINER -->
<main class="destination-list py-5">
    <div class="container">
        <div class="row g-4" id="destinationContainer"></div>

        <div id="emptyResult" class="empty-result text-center py-5" style="display: none;">
            <div class="empty-icon mb-3">
                <i class="bi bi-search display-3 text-muted"></i>
            </div>
            <h3 class="fw-bold text-dark mb-2">Desa Wisata Tidak Ditemukan</h3>
            <p class="text-muted mb-4">
                Belum ada desa wisata atau destinasi yang cocok dengan pencarian atau filter yang dipilih.
            </p>
            <a href="{{ route('destinasi.index') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                <i class="bi bi-arrow-counterclockwise me-2"></i> Tampilkan Semua Desa Wisata
            </a>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    window.appBaseUrl = "{{ asset('') }}";
</script>
<script src="{{ asset('js/destinasi.js') }}?v={{ time() }}"></script>
@endpush
