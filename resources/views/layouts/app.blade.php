<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DewiCiamis')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS Utama DewiCiamis -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    @stack('styles')

    <style>
        .page-container {
            padding-top: 105px !important;
            padding-bottom: 45px !important;
        }
        .page-header {
            padding-top: 105px !important;
            padding-bottom: 25px !important;
        }
        .login-modal-content {
            border: none;
            border-radius: 18px;
            overflow: hidden;
        }
        .login-modal-content .form-control {
            padding: 12px;
            border-radius: 8px;
        }
        .login-modal-content .btn-login {
            width: 100%;
            padding: 12px;
            background: #176b52;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
        }
        .login-modal-content .btn-login:hover {
            background: #11543f;
            color: #fff;
        }
        .login-modal-title {
            color: #173f35;
            font-weight: 700;
        }
        .login-modal-link {
            color: #176b52;
            text-decoration: none;
        }
        .login-modal-link:hover {
            text-decoration: underline;
        }
        .login-modal-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
        }
        .auth-modal .modal-dialog {
            max-width: 480px;
        }
        .auth-modal .modal-body {
            max-height: 85vh;
            overflow-y: auto;
        }
        .navbar .auth-nav-button {
            border: none;
            background: transparent;
            cursor: pointer;
        }
        .navbar .auth-nav-button:focus-visible {
            outline: 2px solid #176b52;
            outline-offset: 3px;
        }
        .forgot-password {
            display: block;
            margin-top: 10px;
            margin-bottom: 18px;
            text-align: right;
            font-size: 14px;
        }
        @media (max-width: 991.98px) {
            .navbar .auth-nav-button {
                padding-left: 0;
            }
        }
    </style>
</head>

<body>

<!-- =====================================================
     NAVBAR
====================================================== -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand logo" href="{{ route('home') }}">
            <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo DewiCiamis">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('destinasi.*') ? 'active' : '' }}" href="{{ route('destinasi.index') }}" id="destinasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Desa Wisata
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="destinasiDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('destinasi.index') }}">
                                <i class="bi bi-grid-fill me-2"></i>Semua Desa Wisata
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('destinasi.index', ['kategori' => 'Alam']) }}">
                                <i class="bi bi-tree-fill me-2"></i>Wisata Alam
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('destinasi.index', ['kategori' => 'Buatan']) }}">
                                <i class="bi bi-building me-2"></i>Wisata Buatan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('destinasi.index', ['kategori' => 'Sejarah & Budaya']) }}">
                                <i class="bi bi-bank me-2"></i>Sejarah &amp; Budaya
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('order.*') ? 'active' : '' }}" href="{{ route('order.index') }}">Tiket</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('support.*') ? 'active' : '' }}" href="{{ route('support.index') }}">Pusat Bantuan</a>
                </li>

                @auth('web')
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    <i class="bi bi-person-circle me-2"></i>Akun Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('order.my_tickets') }}">
                                    <i class="bi bi-ticket-perforated me-2"></i>Tiket Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin keluar dari akun?');">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-none d-lg-block">
                        <span class="nav-link text-secondary">|</span>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link auth-nav-button" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Masuk
                        </button>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Daftar
                        </button>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Alerts -->
@if(session('success') || session('error'))
<div class="container" style="padding-top: 100px; margin-bottom: 20px;">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
@endif

<!-- =====================================================
     KONTEN UTAMA
====================================================== -->
<main class="main-content">
    @yield('content')
</main>

<!-- =====================================================
     FOOTER
====================================================== -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo DewiCiamis">
                    <h3>DewiCiamis</h3>
                </div>
                <p>Website resmi sistem informasi dan reservasi tiket desa wisata di Kabupaten Ciamis, Jawa Barat.</p>
            </div>

            <div class="col-lg-2 col-md-6">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('destinasi.index') }}">Desa Wisata</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('order.index') }}">Tiket</a></li>
                    <li><a href="{{ route('support.index') }}">Pusat Bantuan</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4>Tautan</h4>
                <ul>
                    <li><a href="{{ route('admin.login') }}" target="_blank">Panel Admin Dispar</a></li>
                    <li><a href="{{ route('pengelola.login') }}" target="_blank">Portal Pengelola Desa</a></li>
                    <li><a href="{{ route('support.index') }}">FAQ & Bantuan</a></li>
                    <li><a href="{{ route('order.my_tickets') }}">Cek Status Tiket</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4>Kontak Kami</h4>
                <p><i class="bi bi-geo-alt-fill me-2"></i>Dinas Pariwisata Kab. Ciamis</p>
                <p><i class="bi bi-envelope-fill me-2"></i>info@dewiciamis.id</p>
                <div class="social-links mt-3">
                    <a href="https://www.instagram.com/disparciamis" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://youtube.com/@disparkabciamis" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <hr>

        <div class="footer-bottom">
            <p>© 2026 DewiCiamis. Powered by Laravel 10.</p>
        </div>
    </div>
</footer>

<!-- =====================================================
     MODAL AUTH (LOGIN, REGISTER, RESET PASSWORD)
====================================================== -->
@guest('web')
<!-- MODAL LOGIN -->
<div class="modal fade auth-modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-modal-content">
            <div class="modal-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo Dispar Ciamis" class="login-modal-logo mb-3">
                    <h3 id="loginModalLabel" class="login-modal-title">Masuk</h3>
                    <p class="text-muted mb-0">Selamat datang kembali! Masuk untuk melanjutkan.</p>
                </div>

                @if(session('login_error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('login_error') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-2">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Masukkan password" required>
                    </div>

                    <a href="#resetPasswordModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="login-modal-link forgot-password">Lupa Password?</a>

                    <button type="submit" class="btn btn-login">Masuk</button>
                </form>

                <p class="text-center mt-4 mb-2">
                    Belum punya akun?
                    <a href="#" class="login-modal-link" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Daftar di sini</a>
                </p>

                <div class="text-center">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DAFTAR -->
<div class="modal fade auth-modal" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-modal-content">
            <div class="modal-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo Dispar Ciamis" class="login-modal-logo mb-3">
                    <h3 id="registerModalLabel" class="login-modal-title">Daftar Akun</h3>
                    <p class="text-muted mb-0">Buat akun untuk memesan tiket wisata</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="registerNama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="registerNama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-4">
                        <label for="registerPassword" class="form-label">Password (Minimal 6 karakter)</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Minimal 6 karakter" minlength="6" required>
                    </div>

                    <button type="submit" class="btn btn-login">Daftar</button>
                </form>

                <p class="text-center mt-4 mb-2">
                    Sudah punya akun?
                    <a href="#" class="login-modal-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Masuk di sini</a>
                </p>

                <div class="text-center">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL RESET PASSWORD -->
<div class="modal fade auth-modal" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-modal-content">
            <div class="modal-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo Dispar Ciamis" class="login-modal-logo mb-3">
                    <h3 class="login-modal-title">Reset Kata Sandi</h3>
                    <p class="text-muted mb-0">Masukkan email dan kata sandi baru Anda</p>
                </div>

                <form action="{{ route('password.reset') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email Terdaftar</label>
                        <input type="email" class="form-control" name="email" placeholder="nama@email.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" minlength="6" required>
                    </div>

                    <button type="submit" class="btn btn-login">Simpan Kata Sandi Baru</button>
                </form>

                <div class="text-center mt-3">
                    <a href="#" class="login-modal-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Kembali ke login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('main.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('login_error'))
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        bootstrap.Modal.getOrCreateInstance(loginModal).show();
    }
    @endif

    @if($errors->any() && !Auth::check())
    const registerModal = document.getElementById('registerModal');
    if (registerModal) {
        bootstrap.Modal.getOrCreateInstance(registerModal).show();
    }
    @endif
});
</script>

@stack('scripts')
</body>
</html>
