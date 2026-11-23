```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

// Mengambil harga tiket Kampung Sawah
$stmt = $pdo->prepare("
    SELECT id, destination_name, ticket_price
    FROM destination_prices
    WHERE TRIM(destination_name) = :destination
    LIMIT 1
");

$stmt->execute([
    ':destination' => 'Kampung Sawah'
]);

$dataHarga = $stmt->fetch(PDO::FETCH_ASSOC);

// Menentukan harga tiket
$hargaTiket = 0;

if ($dataHarga) {
    $hargaTiket = (int) $dataHarga['ticket_price'];
}

$hargaTiketFormat = number_format(
    $hargaTiket,
    0,
    ',',
    '.'
);

// Memeriksa status login
$sudahLogin = isset($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemesanan Tiket Kampung Sawah | DewiCiamis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/pemesanan.css">

    <style>
        .brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .brand .logo {
            display: block;
            width: 150px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .database-info {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            background: #f1f8f3;
            color: #176b45;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .brand .logo {
                width: 120px;
            }

            .topbar-inner {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body
    data-destination="talagasari"
    data-ticket-price="<?= htmlspecialchars((string) $hargaTiket, ENT_QUOTES, 'UTF-8') ?>">

    <!-- HEADER -->
    <header class="topbar">

        <div class="container topbar-inner">

            <a href="../index.php" class="brand">

                <img
                    src="../pictures/LogoDispar.png"
                    alt="Logo Dinas Pariwisata"
                    class="logo">

            </a>

            <a href="../detail/talagasari.php" class="back-link">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Kampung Sawah

            </a>

        </div>

    </header>


    <!-- KONTEN PEMESANAN -->
    <main class="container booking-container">

        <div class="breadcrumb">

            <a href="../index.php">Beranda</a>

            <i class="bi bi-chevron-right"></i>

            <a href="../destinasi.php">Destinasi</a>

            <i class="bi bi-chevron-right"></i>

            <a href="../detail/talagasari.php">Kampung Sawah</a>

            <i class="bi bi-chevron-right"></i>

            <span>Pemesanan Tiket</span>

        </div>


        <!-- JUDUL -->
        <section class="page-heading">

            <span class="eyebrow">PEMESANAN ONLINE</span>

            <h1>Pesan Tiket Kampung Sawah</h1>

            <p>
                Isi data pemesanan dan pilih tanggal kunjunganmu.
            </p>

        </section>


        <div class="booking-grid">


            <!-- FORM PEMESANAN -->
            <section class="panel">

                <div class="panel-heading">

                    <div class="heading-icon">

                        <i class="bi bi-ticket-perforated"></i>

                    </div>

                    <div>

                        <h2>Data Pemesanan</h2>

                        <p>
                            Pastikan data yang kamu masukkan benar.
                        </p>

                    </div>

                </div>


                <?php if (!$sudahLogin): ?>

                    <div class="alert alert-warning">

                        <i class="bi bi-info-circle me-1"></i>

                        Silakan masuk ke akun DewiCiamis terlebih dahulu
                        untuk melakukan pemesanan tiket.

                        <div class="mt-3">

                            <a href="../masuk.php?return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"" class="btn btn-primary">

                                Masuk Sekarang

                            </a>

                        </div>

                    </div>


                <?php elseif (!$dataHarga || $hargaTiket <= 0): ?>

                    <div class="alert alert-warning">

                        <i class="bi bi-exclamation-triangle me-1"></i>

                        Harga tiket Kampung Sawah belum tersedia.

                        Silakan hubungi pengelola destinasi.

                    </div>


                <?php else: ?>


                    <!-- FORM -->
                    <form id="bookingForm">

                        <div class="form-group">

                            <label for="fullName">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="fullName"
                                name="fullName"
                                placeholder="Masukkan nama lengkap"
                                autocomplete="name"
                                maxlength="100"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="whatsapp">
                                Nomor WhatsApp
                            </label>

                            <input
                                type="tel"
                                id="whatsapp"
                                name="whatsapp"
                                placeholder="Contoh: 081234567890"
                                autocomplete="tel"
                                pattern="[0-9+\-\s]{9,30}"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="visitDate">
                                Tanggal Kunjungan
                            </label>

                            <input
                                type="date"
                                id="visitDate"
                                name="visitDate"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="ticketQty">
                                Jumlah Tiket
                            </label>

                            <div class="quantity-control">

                                <button
                                    type="button"
                                    id="decreaseQty"
                                    aria-label="Kurangi tiket">

                                    −

                                </button>

                                <input
                                    type="number"
                                    id="ticketQty"
                                    name="ticketQty"
                                    value="1"
                                    min="1"
                                    max="100"
                                    required>

                                <button
                                    type="button"
                                    id="increaseQty"
                                    aria-label="Tambah tiket">

                                    +

                                </button>

                            </div>

                        </div>


                        <!-- TOTAL PEMBAYARAN -->
                        <div class="total-box">

                            <span>Total Pembayaran</span>

                            <strong id="totalPrice">
                                Rp<?= htmlspecialchars($hargaTiketFormat, ENT_QUOTES, 'UTF-8') ?>
                            </strong>

                            <small id="ticketPriceNote">

                                Harga tiket Rp<?= htmlspecialchars($hargaTiketFormat, ENT_QUOTES, 'UTF-8') ?>
                                per orang.

                            </small>

                        </div>


                        <!-- TOMBOL PEMBAYARAN -->
                        <button
                            type="submit"
                            class="primary-button"
                            id="submitBooking">

                            Lanjutkan ke Pembayaran

                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </form>


                <?php endif; ?>

            </section>



            <!-- INFORMASI PEMESANAN -->
            <aside class="panel side-panel">

                <div class="heading-icon">

                    <i class="bi bi-info-circle"></i>

                </div>

                <h2>Informasi Pemesanan</h2>

                <p>
                    Periksa kembali detail kunjungan sebelum
                    melanjutkan ke pembayaran.
                </p>


                <ul class="info-list">

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Masukkan data pengunjung
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Pilih tanggal kunjungan
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Periksa jumlah tiket dan total pembayaran
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan kode booking setelah pesanan berhasil
                    </li>

                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        Unggah bukti pembayaran untuk diverifikasi admin
                    </li>

                </ul>


                <div class="notice">

                    <i class="bi bi-exclamation-circle"></i>

                    <span>
                        Pastikan tarif dan QRIS yang digunakan
                        sesuai dengan informasi resmi pengelola
                        Kampung Sawah.
                    </span>

                </div>

            </aside>

        </div>


        <!-- KETERANGAN -->
        <p class="disclaimer">

            Pesanan akan diproses melalui sistem DewiCiamis.

            Pembayaran harus diverifikasi oleh admin sebelum
            e-tiket tersedia.

        </p>

    </main>



    <!-- FOOTER -->
    <footer class="site-footer">

        <div class="container">

            © <?= date('Y') ?> DewiCiamis

        </div>

    </footer>



    <!-- DATA UNTUK JAVASCRIPT -->
    <script>
        window.ticketPrice = <?= json_encode($hargaTiket) ?>;

        window.isLoggedIn = <?= json_encode($sudahLogin) ?>;
    </script>


    <!-- JAVASCRIPT PEMESANAN -->
    <script src="../js/pemesanan.js"></script>

</body>

</html>
```