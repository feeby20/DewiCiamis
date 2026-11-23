<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin DewiCiamis')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --admin-green: #245c42;
            --admin-dark-green: #194630;
            --admin-active: #17432e;
        }
        body {
            background: #f4f6f4;
            color: #26352d;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
        }
        .admin-sidebar {
            width: 260px;
            height: 100vh;
            background: var(--admin-green);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 15px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
        }
        .admin-brand {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }
        .admin-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: all .2s;
        }
        .admin-menu a:hover {
            background: var(--admin-dark-green);
            transform: translateX(3px);
        }
        .admin-menu a.active {
            background: var(--admin-active);
            outline: 1px solid #8bbda0;
            font-weight: 600;
        }
        .admin-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }
        .admin-topbar {
            background: white;
            padding: 16px 24px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            margin-bottom: 28px;
        }
        @media(max-width: 991px) {
            .admin-sidebar {
                position: static;
                width: 100%;
                height: auto;
            }
            .admin-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="admin-sidebar">
    <div class="admin-brand">
        <h3 class="fw-bold mb-1 fs-5">DewiCiamis</h3>
        <p class="text-white-50 small mb-0">Panel Manajemen Dispar</p>
    </div>

    <nav class="admin-menu flex-grow-1">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 fs-5"></i> Dashboard
        </a>
        <a href="{{ route('admin.desa.index') }}" class="{{ request()->routeIs('admin.desa.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt-fill fs-5"></i> Monitoring 57 Desa
        </a>
        <a href="{{ route('admin.pencairan.index') }}" class="{{ request()->routeIs('admin.pencairan.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack fs-5"></i> Pencairan Dana Desa
        </a>
        <a href="{{ route('admin.orders.verifikasi') }}" class="{{ request()->routeIs('admin.orders.verifikasi') ? 'active' : '' }}">
            <i class="bi bi-patch-check fs-5"></i> Verifikasi Bukti
        </a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
            <i class="bi bi-ticket-perforated fs-5"></i> Semua Pesanan
        </a>
        <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper fs-5"></i> Kelola Berita
        </a>
        <a href="{{ route('admin.support.index') }}" class="{{ request()->routeIs('admin.support.*') ? 'active' : '' }}">
            <i class="bi bi-chat-left-dots fs-5"></i> Pusat Bantuan
        </a>
        <a href="{{ route('admin.profile.index') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-gear fs-5"></i> Profil Akun
        </a>
        <a href="{{ route('home') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right fs-5"></i> Buka Website Utama
        </a>
    </nav>

    <div class="pt-3 border-top border-white-50 mt-auto">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 rounded-3 py-2 fw-semibold" onclick="return confirm('Keluar dari panel admin?')">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar Admin
            </button>
        </form>
    </div>
</aside>

<!-- MAIN CONTENT -->
<main class="admin-content">
    <div class="admin-topbar">
        <div>
            <h5 class="fw-bold mb-0 text-dark">@yield('page_title', 'Dashboard')</h5>
            <small class="text-muted">Dinas Pariwisata Kabupaten Ciamis</small>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                <i class="bi bi-shield-check me-1"></i> {{ Auth::guard('admin')->user()->email ?? 'Administrator' }}
            </span>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
