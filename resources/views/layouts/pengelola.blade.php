<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel Pengelola Desa Wisata')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --pg-primary: #155724;
            --pg-dark: #0f3d19;
            --pg-active: #1e7e34;
            --pg-bg: #f3f6f4;
            --pg-accent: #28a745;
        }
        body {
            background: var(--pg-bg);
            color: #212529;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
        }
        .pengelola-sidebar {
            width: 270px;
            height: 100vh;
            background: linear-gradient(180deg, var(--pg-primary) 0%, var(--pg-dark) 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
        }
        .pengelola-brand {
            text-align: center;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 18px;
        }
        .pengelola-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
        }
        .pengelola-menu a:hover {
            background: rgba(255,255,255,0.12);
            color: #fff;
            transform: translateX(4px);
        }
        .pengelola-menu a.active {
            background: var(--pg-active);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .pengelola-content {
            margin-left: 270px;
            padding: 30px;
            min-height: 100vh;
        }
        .pengelola-topbar {
            background: white;
            padding: 16px 24px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.04);
            margin-bottom: 25px;
        }
        .card-stat {
            border: none;
            border-radius: 16px;
            background: #fff;
            padding: 22px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.03);
            transition: transform .2s;
        }
        .card-stat:hover {
            transform: translateY(-3px);
        }
        @media(max-width: 991px) {
            .pengelola-sidebar {
                position: static;
                width: 100%;
                height: auto;
            }
            .pengelola-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="pengelola-sidebar">
    <div class="pengelola-brand">
        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill mb-2 fw-semibold">
            <i class="bi bi-geo-alt-fill"></i> PENGELOLA DESA
        </span>
        <h4 class="fw-bold mb-0 fs-5 text-white">{{ Auth::guard('pengelola')->user()->desa->nama_desa ?? 'Desa Wisata' }}</h4>
        <small class="text-white-50">Kec. {{ Auth::guard('pengelola')->user()->desa->kecamatan ?? 'Ciamis' }}</small>
    </div>

    <nav class="pengelola-menu flex-grow-1">
        <a href="{{ route('pengelola.dashboard') }}" class="{{ request()->routeIs('pengelola.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('pengelola.validasi') }}" class="{{ request()->routeIs('pengelola.validasi*') ? 'active' : '' }}">
            <i class="bi bi-qr-code-scan"></i> Scan & Validasi Tiket
        </a>
        <a href="{{ route('pengelola.profil') }}" class="{{ request()->routeIs('pengelola.profil*') ? 'active' : '' }}">
            <i class="bi bi-pencil-square"></i> Kelola Profil & Tiket
        </a>
        <a href="{{ route('pengelola.rekening') }}" class="{{ request()->routeIs('pengelola.rekening*') ? 'active' : '' }}">
            <i class="bi bi-bank"></i> Rekening Bank Desa
        </a>
        <a href="{{ route('pengelola.laporan') }}" class="{{ request()->routeIs('pengelola.laporan*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Laporan Pendapatan
        </a>
        <a href="{{ route('pengelola.pencairan') }}" class="{{ request()->routeIs('pengelola.pencairan*') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i> Pencairan Dana
        </a>
        <div class="border-top border-white-50 my-2 pt-2"></div>
        <a href="{{ route('home') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Portal Publik
        </a>
    </nav>

    <div class="pt-3 border-top border-white-50 mt-auto">
        <form action="{{ route('pengelola.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100 rounded-3 py-2 fw-semibold" onclick="return confirm('Keluar dari panel pengelola?')">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN CONTENT -->
<main class="pengelola-content">
    <div class="pengelola-topbar">
        <div>
            <h5 class="fw-bold mb-0 text-dark">@yield('page_title', 'Dashboard')</h5>
            <small class="text-muted">Desa Wisata {{ Auth::guard('pengelola')->user()->desa->nama_desa ?? '' }} - Ciamis</small>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::guard('pengelola')->user()->name }}
            </span>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show rounded-4 shadow-sm" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
