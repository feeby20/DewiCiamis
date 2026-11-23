
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

// Periksa status login
$sudahLogin = isset($_SESSION['user_id']);
$namaPengguna = $_SESSION['user_nama'] ?? 'Akun Saya';

// Informasi destinasi
$namaDestinasi = 'Paralayang';
$kodeDestinasi = 'paralayang';

// Ambil harga tiket dari database
$stmt = $pdo->prepare("
    SELECT ticket_price
    FROM destination_prices
    WHERE TRIM(destination_name) = :destination
    LIMIT 1
");

$stmt->execute([
    ':destination' => $namaDestinasi
]);

$hargaTiket = $stmt->fetchColumn();

if ($hargaTiket === false) {
    $hargaTiket = 0;
}

$hargaTiket = (int) $hargaTiket;
$hargaTiketFormat = 'Rp' . number_format($hargaTiket, 0, ',', '.');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemesanan Tiket Paralayang | DewiCiamis</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <!-- CSS Pemesanan -->
    <link rel="stylesheet" href="../css/pemesanan.css">

    <style>
        .brand {
            display: flex;
            align-items: center;
        }

        .brand .logo {
            width: 150px;
            height: auto;
            object-fit: contain;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 576px) {
            .brand .logo {
                width: 120px;
            }
        }
    </style>
</head>

<body
    data-destination="<?php echo htmlspecialchars($kodeDestinasi); ?>"
    data-ticket-price="<?php echo $hargaTiket; ?>"
>

    <!-- Navbar -->
    <header class="topbar">
        <div class="container topbar-inner">

            <a href="../index.php" class="brand">
                <img
                    src="../pictures/LogoDispar.png"
                    alt="Logo DewiCiamis"
                    class="logo"
                >
            </a>

            <a href="../detail/aomas.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>
    </header>

    <!-- Konten Utama -->
    <main class="container booking-container">

        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="../index.php">Beranda</a>
            <span>/</span>
            <a href="../detail/aomas.php">Paralayang</a>
            <span>/</span>
            <span>Pemesanan Tiket</span>
        </nav>

        <!-- Judul Halaman -->
        <section class="page-heading">
            <span class="eyebrow">DewiCiamis</span>

            <h1>Pemesanan Tiket Paralayang</h1>

            <p>
                Lengkapi data pemesanan tiket untuk merencanakan
                kunjungan Anda ke Paralayang.
            </p>
        </section>

        <div class="booking-grid">

            <!-- Form Pemesanan -->
            <section class="panel">

                <div class="panel-heading">
                    <div class="heading-icon">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>

                    <div>
                        <h2>Form Pemesanan</h2>
                        <p>Masukkan data pengunjung dengan benar.</p>
                    </div>
                </div>

                <?php if (!$sudahLogin): ?>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        Silakan login terlebih dahulu untuk melakukan
                        pemesanan tiket.
                        <a href="../masuk.php?return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"" class="alert-link">
                            Login sekarang
                        </a>
                    </div>

                <?php elseif ($hargaTiket <= 0): ?>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        Harga tiket Paralayang belum tersedia.
                        Silakan hubungi admin.
                    </div>

                <?php else: ?>

                    <form id="bookingForm">

                        <div class="form-group">
                            <label for="fullName">Nama Lengkap</label>

                            <input
                                type="text"
                                id="fullName"
                                name="fullName"
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="<?php echo htmlspecialchars($namaPengguna); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="whatsapp">Nomor WhatsApp</label>

                            <input
                                type="tel"
                                id="whatsapp"
                                name="whatsapp"
                                class="form-control"
                                placeholder="Contoh: 081234567890"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="visitDate">Tanggal Kunjungan</label>

                            <input
                                type="date"
                                id="visitDate"
                                name="visitDate"
                                class="form-control"
                                min="<?php echo date('Y-m-d'); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="ticketQty">Jumlah Tiket</label>

                            <div class="quantity-control">

                                <button
                                    type="button"
                                    id="decreaseQty"
                                    class="quantity-button"
                                >
                                    <i class="bi bi-dash"></i>
                                </button>

                                <input
                                    type="number"
                                    id="ticketQty"
                                    name="ticketQty"
                                    value="1"
                                    min="1"
                                    max="100"
                                    readonly
                                >

                                <button
                                    type="button"
                                    id="increaseQty"
                                    class="quantity-button"
                                >
                                    <i class="bi bi-plus"></i>
                                </button>

                            </div>
                        </div>

                        <!-- Ringkasan Harga -->
                        <div class="total-box">

                            <div>
                                <span>Harga Tiket</span>
                                <strong><?php echo $hargaTiketFormat; ?></strong>
                            </div>

                            <div>
                                <span>Jumlah Tiket</span>
                                <strong id="ticketQtyDisplay">1</strong>
                            </div>

                            <div class="total-price">
                                <span>Total Pembayaran</span>
                                <strong id="totalPrice">
                                    <?php echo $hargaTiketFormat; ?>
                                </strong>
                            </div>

                            <small id="ticketPriceNote">
                                Harga tiket per orang:
                                <?php echo $hargaTiketFormat; ?>
                            </small>

                        </div>

                        <button
                            type="submit"
                            id="submitBooking"
                            class="primary-button"
                        >
                            <i class="bi bi-calendar-check"></i>
                            Lanjutkan Pemesanan
                        </button>

                    </form>

                <?php endif; ?>

            </section>

            <!-- Informasi Destinasi -->
            <aside class="panel side-panel">

                <div class="panel-heading">
                    <div class="heading-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>
                        <h2>Informasi Pemesanan</h2>
                        <p>Perhatikan informasi berikut.</p>
                    </div>
                </div>

                <div class="info-list">

                    <div class="info-item">
                        <i class="bi bi-geo-alt"></i>

                        <div>
                            <strong>Destinasi</strong>
                            <span>Paralayang</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-ticket-perforated"></i>

                        <div>
                            <strong>Harga Tiket</strong>
                            <span><?php echo $hargaTiketFormat; ?> / orang</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-calendar-event"></i>

                        <div>
                            <strong>Tanggal Kunjungan</strong>
                            <span>Sesuai tanggal yang dipilih</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-people"></i>

                        <div>
                            <strong>Jumlah Pengunjung</strong>
                            <span>Dapat disesuaikan saat pemesanan</span>
                        </div>
                    </div>

                </div>

                <div class="notice">
                    <i class="bi bi-lightbulb"></i>

                    <div>
                        <strong>Informasi</strong>

                        <p>
                            Pastikan data pemesanan sudah benar sebelum
                            melanjutkan ke tahap pembayaran.
                        </p>
                    </div>
                </div>

            </aside>

        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            <i class="bi bi-shield-check"></i>

            <p>
                Pembayaran perlu diverifikasi oleh admin.
                E-ticket akan tersedia setelah pembayaran dinyatakan lunas.
            </p>
        </div>

    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <p>
                &copy; <?php echo date('Y'); ?>
                DewiCiamis - Desa Wisata Kabupaten Ciamis
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Pemesanan -->
    <script src="../js/pemesanan.js"></script>

</body>
</html>
