<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengelola Desa Wisata - DewiCiamis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #155724 0%, #0d3817 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 440px;
            padding: 40px 32px;
        }
        .btn-green {
            background: #198754;
            color: #fff;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all .2s;
        }
        .btn-green:hover {
            background: #157347;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-2 fw-semibold">
            <i class="bi bi-shield-lock-fill me-1"></i> PORTAL PENGELOLA DESA
        </span>
        <h3 class="fw-bold text-dark mt-2">Masuk Pengelola</h3>
        <p class="text-muted small">Panel 57 Akun Desa Wisata Kabupaten Ciamis</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 py-2" role="alert">
            <small>{{ session('success') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 py-2" role="alert">
            <small>{{ $errors->first() }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('pengelola.login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-semibold text-muted">Username atau Email Desa</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                <input type="text" name="login" class="form-control border-start-0" placeholder="contoh: desa_kawali" value="{{ old('login') }}" required autofocus>
            </div>
            <div class="form-text text-muted small">Format: desa_[nama_desa], misal: <code>desa_kawali</code></div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-semibold text-muted">Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-green w-100 mb-3 shadow-sm">
            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Panel Desa
        </button>

        <div class="text-center">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda Utama
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
