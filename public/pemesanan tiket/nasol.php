<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/database.php";

// Periksa status login
$sudahLogin = isset($_SESSION['user_id']);
$namaPengguna = $_SESSION['user_nama'] ?? '';

// Informasi destinasi
$namaDestinasi = "Jaha Buana";
$hargaTiket = 5000;

// Ambil harga tiket dari database
try {
    $stmt = $pdo->prepare("
        SELECT ticket_price
        FROM destination_prices
        WHERE TRIM(destination_name) = :destination
        LIMIT 1
    ");

    $stmt->execute([
        ':destination' => $namaDestinasi
    ]);

    $dataHarga = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dataHarga) {
        $hargaTiket = (int) $dataHarga['ticket_price'];
    }
} catch (PDOException $e) {
    // Gunakan harga default jika query gagal.
}

function rupiah($angka)
{
    return "Rp" . number_format((int) $angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemesanan Tiket Jaha Buana | DewiCiamis</title>

    <!-- Bootstrap CSS -->
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
    data-destination="nasol"
    data-ticket-price="<?= $hargaTiket ?>"
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

            <a href="../detail/nasol.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>
    </header>

    <!-- Konten Utama -->
    <main class="container booking-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="../index.php">Beranda</a>
            <span>/</span>
            <a href="../destinasi.php">Destinasi Wisata</a>
            <span>/</span>
            <span>Pemesanan Tiket</span>
        </div>

        <!-- Judul Halaman -->
        <section class="page-heading">
            <span class="eyebrow">PEMESANAN TIKET</span>

            <h1>Jaha Buana</h1>

            <p>
                Lengkapi data pemesanan tiket untuk menikmati wisata
                Jaha Buana.
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
                        <h2>Data Pemesanan</h2>
                        <p>Isi data pengunjung dengan benar.</p>
                    </div>
                </div>

                <?php if (!$sudahLogin): ?>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Silakan login terlebih dahulu sebelum melakukan pemesanan tiket.

                        <a href="../masuk.php?return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"" class="alert-link">
                            Login sekarang
                        </a>
                    </div>

                <?php elseif ($hargaTiket <= 0): ?>

                    <div class="alert alert-warning">
                        Harga tiket untuk destinasi ini belum tersedia.
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
                                    readonly
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

                        <!-- Total Harga -->
                        <div class="total-box">

                            <div>
                                <span>Harga Tiket</span>
                                <strong><?= rupiah($hargaTiket) ?> / orang</strong>
                            </div>

                            <div>
                                <span>Total Pembayaran</span>
                                <strong id="totalPrice">
                                    <?= rupiah($hargaTiket) ?>
                                </strong>
                            </div>

                            <small id="ticketPriceNote">
                                Harga tiket dihitung berdasarkan jumlah pengunjung.
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
                            <span>Jaha Buana</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-cash-stack"></i>

                        <div>
                            <strong>Harga Tiket</strong>
                            <span><?= rupiah($hargaTiket) ?> / orang</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-calendar-check"></i>

                        <div>
                            <strong>Tanggal Kunjungan</strong>
                            <span>Pilih tanggal kunjungan saat pemesanan.</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-people"></i>

                        <div>
                            <strong>Jumlah Pengunjung</strong>
                            <span>Jumlah tiket disesuaikan dengan pengunjung.</span>
                        </div>
                    </div>

                </div>

                <div class="notice">
                    <i class="bi bi-lightbulb"></i>

                    <div>
                        <strong>Informasi</strong>

                        <p>
                            Pastikan data pemesanan sudah benar sebelum
                            melanjutkan ke proses pembayaran.
                        </p>
                    </div>
                </div>

                <div class="disclaimer">
                    <i class="bi bi-shield-check"></i>

                    <p>
                        Pembayaran perlu diverifikasi oleh admin.
                        Simpan bukti pembayaran setelah melakukan transaksi.
                    </p>
                </div>

            </aside>

        </div>

    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <p>
                &copy; <?= date('Y') ?> DewiCiamis - Desa Wisata Kabupaten Ciamis.
                Semua Hak Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Pemesanan -->
    <script src="../js/pemesanan.js"></script>

</body>
</html>