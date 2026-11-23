
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/database.php";

$sudahLogin = isset($_SESSION["user_id"]);
$namaPengguna = $_SESSION["user_nama"] ?? "Akun Saya";

$namaDestinasi = "Sandingtaman";
$hargaTiket = 7500;

// Ambil harga tiket dari database
try {
    $stmt = $pdo->prepare("
        SELECT ticket_price
        FROM destination_prices
        WHERE TRIM(destination_name) = :destination OR TRIM(destination_name) = 'Curug Tujuh Cibolang'
        LIMIT 1
    ");

    $stmt->execute([
        ":destination" => $namaDestinasi
    ]);

    $dataHarga = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dataHarga) {
        $hargaTiket = (int) $dataHarga["ticket_price"];
    }
} catch (PDOException $e) {
    $hargaTiket = 7500;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemesanan Tiket Curug Tujuh | Desa Wisata Kabupaten Ciamis</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../css/pemesanan.css">

    <style>
        .brand {
            display: flex;
            align-items: center;
            text-decoration: none;
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
    data-destination="sandingtaman"
    data-ticket-price="<?= htmlspecialchars((string) $hargaTiket); ?>"
>

    <!-- Header -->
    <header class="topbar">
        <div class="container topbar-inner">

            <a href="../index.php" class="brand">
                <img
                    src="../pictures/LogoDispar.png"
                    alt="Logo DewiCiamis"
                    class="logo"
                >
            </a>

            <a href="../detail/sandingtaman.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>
    </header>

    <!-- Konten Pemesanan -->
    <main class="container booking-container">

        <div class="breadcrumb">
            <a href="../index.php">Beranda</a>
            <span>/</span>
            <a href="../detail/sandingtaman.php">Detail Destinasi</a>
            <span>/</span>
            <span>Pemesanan Tiket</span>
        </div>

        <section class="page-heading">
            <span class="eyebrow">PEMESANAN TIKET WISATA</span>

            <h1>Curug Tujuh, Buper Aki Kabayan & Situs Odehem</h1>

            <p>
                Lengkapi data pemesanan tiket untuk merencanakan kunjungan
                Anda ke Curug Tujuh, Buper Aki Kabayan & Situs Odehem.
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
                        <p>Isi data pengunjung dengan benar.</p>
                    </div>
                </div>

                <?php if (!$sudahLogin): ?>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        Silakan login terlebih dahulu untuk melakukan pemesanan tiket.
                        <a href="../masuk.php?return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"" class="alert-link">
                            Login sekarang
                        </a>
                    </div>

                <?php elseif ($hargaTiket <= 0): ?>

                    <div class="alert alert-warning">
                        Harga tiket belum tersedia. Silakan hubungi administrator.
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
                                value="<?= htmlspecialchars($namaPengguna); ?>"
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
                                placeholder="Contoh: 08xxxxxxxxxx"
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
                                min="<?= date('Y-m-d'); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="ticketQty">Jumlah Tiket</label>

                            <div class="quantity-control">
                                <button
                                    type="button"
                                    id="decreaseQty"
                                    aria-label="Kurangi jumlah tiket"
                                >
                                    <i class="bi bi-dash"></i>
                                </button>

                                <input
                                    type="number"
                                    id="ticketQty"
                                    name="ticketQty"
                                    value="1"
                                    min="1"
                                    required
                                >

                                <button
                                    type="button"
                                    id="increaseQty"
                                    aria-label="Tambah jumlah tiket"
                                >
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="total-box">
                            <div>
                                <span>Harga Tiket</span>
                                <strong id="ticketPriceNote">
                                    Rp<?= number_format($hargaTiket, 0, ',', '.'); ?> / orang
                                </strong>
                            </div>

                            <div>
                                <span>Total Pembayaran</span>
                                <strong id="totalPrice">
                                    Rp<?= number_format($hargaTiket, 0, ',', '.'); ?>
                                </strong>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="primary-button"
                            id="submitBooking"
                        >
                            Lanjutkan Pemesanan
                            <i class="bi bi-arrow-right"></i>
                        </button>

                    </form>

                <?php endif; ?>

            </section>

            <!-- Informasi Pemesanan -->
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
                            <strong>Destinasi Wisata</strong>
                            <span>Curug Tujuh, Buper Aki Kabayan & Situs Odehem</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-tag"></i>

                        <div>
                            <strong>Harga Tiket</strong>
                            <span>
                                Rp<?= number_format($hargaTiket, 0, ',', '.'); ?> / orang
                            </span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-calendar-check"></i>

                        <div>
                            <strong>Tanggal Kunjungan</strong>
                            <span>Pilih tanggal kunjungan saat melakukan pemesanan.</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-credit-card"></i>

                        <div>
                            <strong>Pembayaran</strong>
                            <span>Pembayaran dilakukan melalui halaman pembayaran.</span>
                        </div>
                    </div>

                </div>

                <div class="notice">
                    <i class="bi bi-exclamation-circle"></i>

                    <div>
                        <strong>Perhatian</strong>
                        <p>
                            Pastikan data pemesanan sudah benar sebelum
                            melanjutkan ke halaman pembayaran.
                        </p>
                    </div>
                </div>

            </aside>

        </div>

        <div class="disclaimer">
            <i class="bi bi-shield-check"></i>
            Pembayaran perlu diverifikasi oleh admin sebelum e-tiket diterbitkan.
        </div>

    </main>

    <footer class="site-footer">
        <div class="container">
            <p>
                &copy; <?= date('Y'); ?> Desa Wisata Kabupaten Ciamis.
                All Rights Reserved.
            </p>
        </div>
    </footer>

    <script src="../js/pemesanan.js"></script>

</body>
</html>
