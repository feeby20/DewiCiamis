
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/database.php";

$sudahLogin = isset($_SESSION["user_id"]);
$namaPengguna = $_SESSION["user_nama"] ?? "Akun Saya";

$namaDestinasi = "Situ Cibubuhan";
$hargaTiket = 10000;

// Ambil harga tiket dari database
try {
    $stmt = $pdo->prepare("
        SELECT id, destination_name, ticket_price
        FROM destination_prices
        WHERE TRIM(destination_name) = :destination
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
    // Tetap gunakan harga default jika query gagal.
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemesanan Tiket Situ Cibubuhan | Desa Wisata Kabupaten Ciamis</title>

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
    data-destination="situ-cibubuhan"
    data-ticket-price="<?= htmlspecialchars((string) $hargaTiket) ?>"
>

    <!-- Header -->
    <header class="topbar">
        <div class="container topbar-inner">

            <a href="../index.php" class="brand">
                <img
                    src="../pictures/LogoDispar.png"
                    alt="Logo DISPAR"
                    class="logo"
                >
            </a>

            <a href="../detail/cibeureum.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>
    </header>

    <!-- Konten Pemesanan -->
    <main class="container booking-container">

        <div class="breadcrumb">
            <a href="../index.php">Beranda</a>
            <i class="bi bi-chevron-right"></i>
            <a href="../detail/cibeureum.php">Detail Wisata</a>
            <i class="bi bi-chevron-right"></i>
            <span>Pemesanan Tiket</span>
        </div>

        <section class="page-heading">
            <span class="eyebrow">PEMESANAN TIKET WISATA</span>
            <h1>Situ Cibubuhan</h1>
            <p>
                Lengkapi formulir berikut untuk melakukan pemesanan tiket
                wisata Situ Cibubuhan.
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
                        <h2>Formulir Pemesanan</h2>
                        <p>Isi data pengunjung dengan benar.</p>
                    </div>
                </div>

                <?php if (!$sudahLogin): ?>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Silakan login terlebih dahulu sebelum melakukan
                        pemesanan tiket.
                        <a href="../masuk.php?return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"" class="alert-link">
                            Login sekarang
                        </a>
                    </div>

                <?php elseif ($hargaTiket <= 0): ?>

                    <div class="alert alert-warning">
                        Harga tiket Situ Cibubuhan belum tersedia.
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
                                value="<?= htmlspecialchars($namaPengguna) ?>"
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
                                min="<?= date('Y-m-d') ?>"
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

                        <div class="total-box">
                            <div>
                                <span>Harga Tiket</span>
                                <strong>
                                    Rp<?= number_format($hargaTiket, 0, ',', '.') ?>
                                    <small>/ orang</small>
                                </strong>
                            </div>

                            <div class="total-divider"></div>

                            <div class="total-row">
                                <span>Total Pembayaran</span>
                                <strong id="totalPrice">
                                    Rp<?= number_format($hargaTiket, 0, ',', '.') ?>
                                </strong>
                            </div>

                            <small id="ticketPriceNote">
                                Total harga akan menyesuaikan jumlah tiket.
                            </small>
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
                            <span>Situ Cibubuhan</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-ticket-perforated"></i>
                        <div>
                            <strong>Harga Tiket</strong>
                            <span>
                                Rp<?= number_format($hargaTiket, 0, ',', '.') ?>
                                / orang
                            </span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-calendar-check"></i>
                        <div>
                            <strong>Tanggal Kunjungan</strong>
                            <span>Sesuai tanggal yang dipilih</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-credit-card"></i>
                        <div>
                            <strong>Pembayaran</strong>
                            <span>Melalui metode pembayaran yang tersedia</span>
                        </div>
                    </div>

                </div>

                <div class="notice">
                    <i class="bi bi-lightbulb"></i>
                    <div>
                        <strong>Informasi Penting</strong>
                        <p>
                            Pastikan data pemesanan sudah benar sebelum
                            melanjutkan ke tahap pembayaran.
                        </p>
                    </div>
                </div>

                <div class="disclaimer">
                    <i class="bi bi-shield-check"></i>
                    Pembayaran perlu diverifikasi oleh admin sebelum
                    e-tiket diterbitkan.
                </div>

            </aside>

        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>
                &copy; <?= date('Y') ?> Desa Wisata Kabupaten Ciamis.
                Semua Hak Dilindungi.
            </p>
        </div>
    </footer>

    <script src="../js/pemesanan.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
