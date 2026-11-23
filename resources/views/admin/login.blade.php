<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: #eef3f0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo" style="height: 65px;" class="mb-3">
        <h4 class="fw-bold text-dark mb-1">Login Admin Dispar</h4>
        <p class="text-muted small">Masukkan kredensial akun administrator</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger py-2 small" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ session('error') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info py-2 small">
            {{ session('info') }}
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold small">Email Administrator</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', 'admin@disparciamis.com') }}" placeholder="admin@disparciamis.com" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold small">Kata Sandi</label>
            <input type="password" name="password" class="form-control" placeholder="Kata sandi" required>
        </div>

        <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-3">
            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Admin
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-secondary small text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Website Utama
        </a>
    </div>
</div>

</body>
</html>
