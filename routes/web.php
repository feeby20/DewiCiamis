<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DesaMonitoringController as AdminDesaMonitoringController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PencairanDanaController as AdminPencairanDanaController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SupportController as AdminSupportController;
use App\Http\Controllers\Pengelola\AuthController as PengelolaAuthController;
use App\Http\Controllers\Pengelola\DashboardController as PengelolaDashboardController;
use App\Http\Controllers\Pengelola\DesaController as PengelolaDesaController;
use App\Http\Controllers\Pengelola\FinanceController as PengelolaFinanceController;
use App\Http\Controllers\Pengelola\TicketValidationController as PengelolaTicketValidationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - DewiCiamis (Laravel)
|--------------------------------------------------------------------------
*/

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index.php', [HomeController::class, 'index']);

Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi.php', [DestinationController::class, 'index']);
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinasi.show');
Route::post('/destinasi/{slug}/ulasan', [DestinationController::class, 'storeReview'])->name('destinasi.review');

Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita.php', [NewsController::class, 'index']);
Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');
Route::get('/detail-berita.php', function (\Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return $id ? redirect()->route('berita.show', ['id' => $id]) : redirect()->route('berita.index');
});

Route::get('/bantuan', [SupportController::class, 'index'])->name('support.index');
Route::get('/pusat-bantuan.php', [SupportController::class, 'index']);
Route::post('/bantuan', [SupportController::class, 'store'])->name('support.store');

// Autentikasi Pengunjung
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

// Pemesanan Tiket & Pembayaran
Route::get('/pemesanan', [OrderController::class, 'index'])->name('order.index');
Route::get('/pemesanan.php', [OrderController::class, 'index']);
Route::get('/pemesanan/buat', [OrderController::class, 'create'])->name('order.create');
Route::post('/pemesanan/simpan', [OrderController::class, 'store'])->name('order.store');
Route::get('/pembayaran', [OrderController::class, 'payment'])->name('order.payment');
Route::get('/pembayaran.php', [OrderController::class, 'payment']);
Route::post('/pembayaran/unggah-bukti', [OrderController::class, 'uploadProof'])->name('order.upload_proof');
Route::get('/pemesanan/status', [OrderController::class, 'checkStatus'])->name('order.status');
Route::get('/tiket/{booking}', [OrderController::class, 'ticket'])->name('order.ticket');
Route::get('/tiket.php', function (\Illuminate\Http\Request $request) {
    $b = $request->query('booking');
    return $b ? redirect()->route('order.ticket', ['booking' => $b]) : redirect()->route('order.index');
});
Route::get('/tiket-saya', [OrderController::class, 'myTickets'])->name('order.my_tickets');
Route::get('/tiket-saya.php', [OrderController::class, 'myTickets']);

// Akun Pengguna
Route::middleware('auth:web')->group(function () {
    Route::get('/akun-saya', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/akun-saya.php', [ProfileController::class, 'index']);
    Route::post('/akun-saya', [ProfileController::class, 'update'])->name('profile.update');
});

// Kompatibilitas endpoint legacy (AJAX JS dan link lama)
Route::match(['get', 'post'], '/simpan.php', [OrderController::class, 'store']);
Route::get('/masuk.php', [AuthController::class, 'showLogin']);
Route::post('/masuk.php', [AuthController::class, 'login']);
Route::get('/daftar.php', [AuthController::class, 'showLogin']);
Route::post('/daftar.php', [AuthController::class, 'register']);
Route::any('/keluar.php', [AuthController::class, 'logout']);
Route::match(['get', 'post'], '/unggah-bukti.php', [OrderController::class, 'uploadProof']);
Route::match(['get', 'post'], '/proses-pemesanan.php', [OrderController::class, 'checkStatus']);

// ==========================================
// PANEL ADMIN
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::get('/login.php', [AdminAuthController::class, 'showLogin']);
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::any('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/logout.php', [AdminAuthController::class, 'logout']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::get('/dashboard.php', [AdminDashboardController::class, 'index']);

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders.php', [AdminOrderController::class, 'index']);
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::get('/detail.php', function (\Illuminate\Http\Request $request) {
            $id = $request->query('id');
            return $id ? redirect()->route('admin.orders.show', ['id' => $id]) : redirect()->route('admin.orders.index');
        });
        Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
        Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/verifikasi', [AdminOrderController::class, 'verifikasi'])->name('orders.verifikasi');
        Route::get('/verifikasi.php', [AdminOrderController::class, 'verifikasi']);

        // Berita Admin
        Route::get('/berita', [AdminNewsController::class, 'index'])->name('berita.index');
        Route::get('/berita.php', [AdminNewsController::class, 'index']);
        Route::get('/berita/tambah', [AdminNewsController::class, 'create'])->name('berita.create');
        Route::get('/tambah-berita.php', [AdminNewsController::class, 'create']);
        Route::post('/berita', [AdminNewsController::class, 'store'])->name('berita.store');
        Route::get('/berita/{id}/edit', [AdminNewsController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{id}', [AdminNewsController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [AdminNewsController::class, 'destroy'])->name('berita.destroy');

        // Pusat Bantuan Admin
        Route::get('/bantuan', [AdminSupportController::class, 'index'])->name('support.index');
        Route::get('/pusat-bantuan.php', [AdminSupportController::class, 'index']);
        Route::post('/bantuan/{id}/reply', [AdminSupportController::class, 'reply'])->name('support.reply');
        Route::delete('/bantuan/{id}', [AdminSupportController::class, 'destroy'])->name('support.destroy');

        // Monitoring 57 Desa Wisata
        Route::get('/desa', [AdminDesaMonitoringController::class, 'index'])->name('desa.index');
        Route::get('/desa/{id}', [AdminDesaMonitoringController::class, 'show'])->name('desa.show');

        // Rekap & Konfirmasi Pencairan Dana Desa
        Route::get('/pencairan', [AdminPencairanDanaController::class, 'index'])->name('pencairan.index');
        Route::post('/pencairan/{id}/konfirmasi', [AdminPencairanDanaController::class, 'konfirmasi'])->name('pencairan.konfirmasi');

        // Profil Admin
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile.php', [AdminProfileController::class, 'index']);
        Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });
});

// ==========================================
// PANEL PENGELOLA DESA WISATA (57 AKUN DESA)
// ==========================================
Route::prefix('pengelola')->name('pengelola.')->group(function () {
    Route::get('/login', [PengelolaAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [PengelolaAuthController::class, 'login'])->name('login.post');
    Route::any('/logout', [PengelolaAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:pengelola')->group(function () {
        Route::get('/', [PengelolaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [PengelolaDashboardController::class, 'index']);

        // Kelola Profil Desa, Jam Buka, Harga Tiket
        Route::get('/profil', [PengelolaDesaController::class, 'profil'])->name('profil');
        Route::post('/profil', [PengelolaDesaController::class, 'updateProfil'])->name('profil.update');

        // Rekening Kas Bank Desa
        Route::get('/rekening', [PengelolaDesaController::class, 'rekening'])->name('rekening');
        Route::post('/rekening', [PengelolaDesaController::class, 'updateRekening'])->name('rekening.update');

        // Scan & Validasi E-Ticket Masuk
        Route::get('/validasi', [PengelolaTicketValidationController::class, 'index'])->name('validasi');
        Route::post('/validasi/cek', [PengelolaTicketValidationController::class, 'checkTicket'])->name('validasi.check');
        Route::post('/validasi/{id}/konfirmasi', [PengelolaTicketValidationController::class, 'validateTicket'])->name('validasi.confirm');

        // Laporan Pendapatan Tiket
        Route::get('/laporan', [PengelolaFinanceController::class, 'laporan'])->name('laporan');

        // Permohonan Pencairan Dana Tiket ke Dispar
        Route::get('/pencairan', [PengelolaFinanceController::class, 'pencairan'])->name('pencairan');
        Route::post('/pencairan/ajukan', [PengelolaFinanceController::class, 'requestPencairan'])->name('pencairan.request');
    });
});
