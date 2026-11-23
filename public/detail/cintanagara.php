
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

$sudahLogin = isset($_SESSION['user_id']);
$namaPengguna = $_SESSION['user_nama'] ?? 'Akun Saya';

$namaDestinasi = 'Wisata Alam, Agrowisata & Jalan Usaha Tani';

// ========================================
// TOKEN CSRF ULASAN
// ========================================

if (empty($_SESSION['review_csrf'])) {
    $_SESSION['review_csrf'] = bin2hex(random_bytes(32));
}

// ========================================
// PROSES KIRIM ULASAN
// ========================================

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kirim_ulasan'])) {

    if (!$sudahLogin) {
        header('Location: ../masuk.php');
        exit;
    }

    $token = $_POST['review_csrf'] ?? '';
    $rating = (int) ($_POST['rating'] ?? 0);
    $komentar = trim($_POST['comment'] ?? '');

    $panjangKomentar = function_exists('mb_strlen')
        ? mb_strlen($komentar, 'UTF-8')
        : strlen($komentar);

    if (!hash_equals($_SESSION['review_csrf'], $token)) {

        $_SESSION['review_message'] = [
            'type' => 'danger',
            'text' => 'Permintaan tidak valid. Silakan coba kembali.'
        ];

    } elseif ($rating < 1 || $rating > 5) {

        $_SESSION['review_message'] = [
            'type' => 'danger',
            'text' => 'Silakan pilih rating bintang 1 sampai 5.'
        ];

    } elseif ($komentar === '') {

        $_SESSION['review_message'] = [
            'type' => 'danger',
            'text' => 'Komentar ulasan tidak boleh kosong.'
        ];

    } elseif ($panjangKomentar > 1000) {

        $_SESSION['review_message'] = [
            'type' => 'danger',
            'text' => 'Komentar maksimal 1000 karakter.'
        ];

    } else {

        try {

            $stmtUlasan = $pdo->prepare("
                INSERT INTO destination_reviews
                (
                    user_id,
                    user_name,
                    destination_name,
                    rating,
                    comment
                )
                VALUES
                (
                    :user_id,
                    :user_name,
                    :destination_name,
                    :rating,
                    :comment
                )
            ");

            $stmtUlasan->execute([
                ':user_id' => $_SESSION['user_id'],
                ':user_name' => $namaPengguna,
                ':destination_name' => $namaDestinasi,
                ':rating' => $rating,
                ':comment' => $komentar
            ]);

            $_SESSION['review_message'] = [
                'type' => 'success',
                'text' => 'Terima kasih! Ulasan kamu berhasil dikirim.'
            ];

            $_SESSION['review_csrf'] = bin2hex(random_bytes(32));

        } catch (PDOException $e) {

            error_log('Gagal menyimpan ulasan Cintanagara: ' . $e->getMessage());

            $_SESSION['review_message'] = [
                'type' => 'danger',
                'text' => 'Ulasan gagal dikirim. Silakan coba beberapa saat lagi.'
            ];
        }
    }

    header('Location: cintanagara.php?ulasan=1#ulasan');
    exit;
}

// ========================================
// AMBIL PESAN NOTIFIKASI
// ========================================

$pesanUlasan = $_SESSION['review_message'] ?? null;
unset($_SESSION['review_message']);

// ========================================
// AMBIL DAFTAR ULASAN
// ========================================

$daftarUlasan = [];
$jumlahUlasan = 0;
$rataRating = 0;

try {

    $stmtRating = $pdo->prepare("
        SELECT
            COUNT(*) AS jumlah_ulasan,
            COALESCE(AVG(rating), 0) AS rata_rating
        FROM destination_reviews
        WHERE destination_name = :destination_name
    ");

    $stmtRating->execute([
        ':destination_name' => $namaDestinasi
    ]);

    $dataRating = $stmtRating->fetch(PDO::FETCH_ASSOC);

    if ($dataRating) {
        $jumlahUlasan = (int) $dataRating['jumlah_ulasan'];
        $rataRating = (float) $dataRating['rata_rating'];
    }

    $stmtDaftar = $pdo->prepare("
        SELECT
            user_name,
            rating,
            comment,
            created_at
        FROM destination_reviews
        WHERE destination_name = :destination_name
        ORDER BY created_at DESC
    ");

    $stmtDaftar->execute([
        ':destination_name' => $namaDestinasi
    ]);

    $daftarUlasan = $stmtDaftar->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    error_log('Gagal mengambil ulasan Cintanagara: ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wisata Alam Cintanagara | DewiCiamis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/detail.css">

    <style>
        .review-section {
            padding: 70px 0;
            background: #f8faf9;
        }

        .review-heading {
            margin-bottom: 30px;
        }

        .review-heading h2 {
            font-size: 28px;
            font-weight: 700;
            color: #174b38;
            margin-bottom: 8px;
        }

        .review-heading p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .review-summary {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #e9eeeb;
            margin-bottom: 25px;
        }

        .review-average {
            font-size: 48px;
            font-weight: 700;
            color: #174b38;
            line-height: 1;
        }

        .review-stars {
            color: #f5b301;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .review-total {
            color: #777;
            font-size: 14px;
            margin-top: 5px;
        }

        .review-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .review-item {
            background: #ffffff;
            padding: 22px;
            border-radius: 14px;
            border: 1px solid #e9eeeb;
        }

        .review-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .review-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #e5f3eb;
            color: #176b45;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .review-user-info strong {
            display: block;
            color: #26352d;
            font-size: 15px;
        }

        .review-user-info small {
            color: #999;
            font-size: 12px;
        }

        .review-item .review-stars {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .review-comment {
            color: #555;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 0;
            overflow-wrap: anywhere;
        }

        .review-form-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #e9eeeb;
            margin-top: 25px;
        }

        .review-form-card h3 {
            color: #174b38;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
            margin-bottom: 18px;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            font-size: 32px;
            color: #d6d6d6;
            cursor: pointer;
            transition: 0.2s;
        }

        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            color: #f5b301;
        }

        .review-form-card textarea {
            min-height: 120px;
            resize: vertical;
        }

        .review-submit {
            background: #176b45;
            color: #ffffff;
            border: none;
            padding: 11px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.2s;
        }

        .review-submit:hover {
            background: #105536;
            color: #ffffff;
        }

        .review-empty {
            background: #ffffff;
            text-align: center;
            padding: 35px 20px;
            border: 1px dashed #d9e2dc;
            border-radius: 14px;
            color: #777;
        }

        .review-empty i {
            display: block;
            font-size: 35px;
            color: #a5b9ac;
            margin-bottom: 10px;
        }

        .review-alert {
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .review-login {
            margin-top: 25px;
            padding: 22px;
            background: #ffffff;
            border: 1px solid #e9eeeb;
            border-radius: 14px;
        }

        @media (max-width: 576px) {
            .review-section {
                padding: 45px 0;
            }

            .review-summary {
                padding: 20px;
                gap: 15px;
            }

            .review-average {
                font-size: 40px;
            }

            .review-item,
            .review-form-card {
                padding: 18px;
            }

            .review-heading h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <div class="container">

        <a class="navbar-brand logo" href="../index.php">
            <img src="../pictures/LogoDispar.png" alt="Logo Desa Wisata Kabupaten Ciamis">
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Buka navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle active"
                        href="../destinasi.php"
                        id="destinasiDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Destinasi
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="destinasiDropdown">

                        <li>
                            <a class="dropdown-item" href="../destinasi.php">
                                <i class="bi bi-grid-fill me-2"></i>
                                Semua Wisata
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../destinasi.php?kategori=Alam">
                                <i class="bi bi-tree-fill me-2"></i>
                                Wisata Alam
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../destinasi.php?kategori=Buatan">
                                <i class="bi bi-building me-2"></i>
                                Wisata Buatan
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../destinasi.php?kategori=Sejarah%20%26%20Budaya">
                                <i class="bi bi-bank me-2"></i>
                                Sejarah &amp; Budaya
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../berita.php">Berita</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../pemesanan.php">Tiket</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../pusat-bantuan.php">Pusat Bantuan</a>
                </li>

                <?php if ($sudahLogin): ?>

                    <li class="nav-item dropdown ms-lg-2">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="akunDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person-circle me-1"></i>
                            <?= htmlspecialchars($namaPengguna, ENT_QUOTES, 'UTF-8') ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">

                            <li>
                                <a class="dropdown-item" href="../akun-saya.php">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Akun Saya
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger" href="../keluar.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Keluar
                                </a>
                            </li>

                        </ul>
                    </li>

                <?php else: ?>

                    <li class="nav-item d-none d-lg-block">
                        <span class="nav-link text-secondary">|</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../masuk.php">Masuk</a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary px-4" href="../daftar.php">Daftar</a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="detail-hero">
    <div class="container">

        <div class="breadcrumb-detail">
            <a href="../index.php">Beranda</a>
            <i class="bi bi-chevron-right"></i>
            <a href="../destinasi.php">Desa Wisata</a>
            <i class="bi bi-chevron-right"></i>
            <span>Desa Cintanagara</span>
        </div>

        <div class="detail-hero-content">

            <div class="detail-category">
                <i class="bi bi-tree-fill"></i>
                DESA WISATA KABUPATEN CIAMIS
            </div>

            <h1>Desa Wisata Cintanagara</h1>

            <div class="detail-location">
                <i class="bi bi-geo-alt-fill"></i>
                Kecamatan Jatinagara, Kabupaten Ciamis, Jawa Barat
            </div>

        </div>
    </div>
</section>

<!-- KONTEN DETAIL -->
<main class="detail-content">
    <div class="container">
        <div class="row g-5">

            <!-- ARTIKEL DESA & DESTINASI -->
            <div class="col-lg-8">

                <!-- FOTO BANNER DESA -->
                <div class="detail-image-card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                    <img
                        src="../pictures/destinasi/CintaNagara.webp"
                        alt="Desa Wisata Cintanagara"
                        class="detail-image"
                        style="width: 100%; max-height: 420px; object-fit: cover;">
                </div>

                <div class="photo-source mb-4">
                    <i class="bi bi-camera-fill"></i>
                    <span>Sumber Foto: Dokumentasi Desa Wisata Cintanagara</span>
                </div>

                <article class="detail-article mb-5">

                    <span class="article-label">PROFIL DESA WISATA</span>

                    <h2>Mengenal Desa Wisata Cintanagara</h2>

                    <p>
                        Desa Cintanagara merupakan salah satu desa wisata unggulan yang berada di Kecamatan Jatinagara, Kabupaten Ciamis, Jawa Barat. Terletak di kawasan perbukitan berhawa sejuk dengan bentangan alam yang masih sangat asri, Desa Cintanagara resmi ditetapkan sebagai Desa Wisata berdasarkan Surat Keputusan (SK) Bupati Ciamis.
                    </p>

                    <p>
                        Keunikan utama Desa Wisata Cintanagara terletak pada integrasi tiga potensi wisata sekaligus: pesona wisata alam hutan pegunungan dan bumi perkemahan yang sarat peninggalan sejarah di Dusun Batudatar, aktivitas agrowisata perkebunan hortikultura berbasis kearifan lokal masyarakat, serta hamparan persawahan terasering berundak di sepanjang jalur Jalan Usaha Tani.
                    </p>

                    <p>
                        Didukung oleh udara pegunungan yang segar, pemandangan lembah hijau yang memanjakan mata, serta keramahan warga pedesaan Sunda Galuh, Desa Cintanagara menjadi destinasi liburan yang sangat ideal bagi keluarga, pencinta alam, kelompok pelajar, hingga komunitas yang mendambakan ketenangan dan keaslian alam Priangan Timur.
                    </p>

                </article>

                <!-- ========================================================
                     KATALOG DESTINASI DI DESA CINTANAGARA (KLIK UNTUK DETAIL)
                     ======================================================== -->
                <div class="destinasi-katalog-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-1 small fw-semibold">
                                <i class="bi bi-collection-fill me-1"></i> EKSPLORASI DESTINASI
                            </span>
                            <h3 class="fw-bold text-dark mb-1">Destinasi di Desa Cintanagara</h3>
                        </div>
                        <span class="badge bg-success rounded-pill px-3 py-2">3 Destinasi Tersedia</span>
                    </div>
                    <p class="text-secondary small mb-4">
                        Klik pada foto atau tombol destinasi di bawah ini untuk menuju halaman khusus masing-masing destinasi, melihat <strong>deskripsi lengkap</strong>, <strong>galeri foto</strong>, <strong>fasilitas terperinci</strong>, dan <strong>pemesanan tiket masuk</strong>:
                    </p>

                    <div class="row g-4">

                        <!-- DESTINASI 1: WISATA ALAM & BUPER CINTA RASA -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden destinasi-card-hover bg-white border">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-5">
                                        <a href="../destinasi/wisata-alam" class="d-block overflow-hidden position-relative" style="height: 240px;">
                                            <img src="../pictures/destinasi/CintaNagara.webp" alt="Wisata Alam & Buper Cinta Rasa" class="w-100 h-100 object-fit-cover card-img-zoom">
                                            <span class="badge bg-success position-absolute top-0 start-0 m-3 shadow-sm">
                                                <i class="bi bi-tree-fill me-1"></i> Wisata Alam &amp; Sejarah
                                            </span>
                                            <span class="badge bg-dark bg-opacity-75 position-absolute bottom-0 start-0 m-3 text-white small">
                                                <i class="bi bi-cursor-fill me-1 text-warning"></i> Buka Halaman Destinasi
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h4 class="fw-bold text-dark mb-1">
                                                    <a href="../destinasi/wisata-alam" class="text-dark text-decoration-none hover-success">
                                                        Wisata Alam &amp; Buper Cinta Rasa
                                                    </a>
                                                </h4>
                                                <span class="badge bg-light text-success border border-success-subtle fw-semibold">Rp 6.500</span>
                                            </div>
                                            <small class="text-muted d-block mb-2">
                                                <i class="bi bi-geo-alt-fill text-success me-1"></i>Dusun Batudatar, Desa Cintanagara
                                            </small>
                                            <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                                Wana Wisata Buper Cinta Rasa di Dusun Batudatar berpadu dengan situs peninggalan bersejarah turbin air era kolonial Belanda. Menyajikan bumi perkemahan berhawa sejuk di bawah pepohonan rindang dan aliran mata air pegunungan yang jernih.
                                            </p>
                                            <div class="mb-3 d-flex flex-wrap gap-1">
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Camping Ground Luas</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Turbin Zaman Belanda</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Toilet &amp; Kamar Bilas</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Warung Kopi &amp; Saung</span>
                                            </div>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <a href="../destinasi/wisata-alam" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-semibold">
                                                    <i class="bi bi-eye-fill me-1"></i> Lihat Deskripsi, Galeri &amp; Fasilitas
                                                </a>
                                                <a href="../pemesanan.php?destinasi=Wisata%20Alam" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2">
                                                    <i class="bi bi-ticket-perforated me-1"></i> Pesan Tiket
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DESTINASI 2: AGROWISATA PEDESAAN -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden destinasi-card-hover bg-white border">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-5">
                                        <a href="../destinasi/agrowisata" class="d-block overflow-hidden position-relative" style="height: 240px;">
                                            <img src="../pictures/destinasi/AgroCipaku.webp" alt="Agrowisata Pedesaan Cintanagara" class="w-100 h-100 object-fit-cover card-img-zoom">
                                            <span class="badge bg-primary position-absolute top-0 start-0 m-3 shadow-sm">
                                                <i class="bi bi-flower1 me-1"></i> Agrowisata &amp; Edukasi
                                            </span>
                                            <span class="badge bg-dark bg-opacity-75 position-absolute bottom-0 start-0 m-3 text-white small">
                                                <i class="bi bi-cursor-fill me-1 text-warning"></i> Buka Halaman Destinasi
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h4 class="fw-bold text-dark mb-1">
                                                    <a href="../destinasi/agrowisata" class="text-dark text-decoration-none hover-success">
                                                        Agrowisata Pedesaan Cintanagara
                                                    </a>
                                                </h4>
                                                <span class="badge bg-light text-success border border-success-subtle fw-semibold">Rp 6.500</span>
                                            </div>
                                            <small class="text-muted d-block mb-2">
                                                <i class="bi bi-geo-alt-fill text-success me-1"></i>Area Perkebunan, Desa Cintanagara
                                            </small>
                                            <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                                Kawasan perkebunan dan pertanian hortikultura terpadu berbasis kearifan lokal masyarakat. Menawarkan pengalaman petik buah segar langsung dari pohon, edukasi pertanian ramah lingkungan, serta gazebo santai di tengah kebun asri.
                                            </p>
                                            <div class="mb-3 d-flex flex-wrap gap-1">
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Kebun Edukasi Petik Buah</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Saung Tani Tradisional</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Toko Bibit &amp; Hasil Panen</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Gazebo Istirahat</span>
                                            </div>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <a href="../destinasi/agrowisata" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-semibold">
                                                    <i class="bi bi-eye-fill me-1"></i> Lihat Deskripsi, Galeri &amp; Fasilitas
                                                </a>
                                                <a href="../pemesanan.php?destinasi=Agrowisata" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2">
                                                    <i class="bi bi-ticket-perforated me-1"></i> Pesan Tiket
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DESTINASI 3: JALAN USAHA TANI -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden destinasi-card-hover bg-white border">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-5">
                                        <a href="../destinasi/jalan-usaha-tani" class="d-block overflow-hidden position-relative" style="height: 240px;">
                                            <img src="../pictures/destinasi/KampungSawah.jpeg" alt="Jalan Usaha Tani Cintanagara" class="w-100 h-100 object-fit-cover card-img-zoom">
                                            <span class="badge bg-success position-absolute top-0 start-0 m-3 shadow-sm">
                                                <i class="bi bi-bicycle me-1"></i> Wisata Alam &amp; Olahraga
                                            </span>
                                            <span class="badge bg-dark bg-opacity-75 position-absolute bottom-0 start-0 m-3 text-white small">
                                                <i class="bi bi-cursor-fill me-1 text-warning"></i> Buka Halaman Destinasi
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h4 class="fw-bold text-dark mb-1">
                                                    <a href="../destinasi/jalan-usaha-tani" class="text-dark text-decoration-none hover-success">
                                                        Jalan Usaha Tani Cintanagara
                                                    </a>
                                                </h4>
                                                <span class="badge bg-light text-success border border-success-subtle fw-semibold">Rp 6.500</span>
                                            </div>
                                            <small class="text-muted d-block mb-2">
                                                <i class="bi bi-geo-alt-fill text-success me-1"></i>Kawasan Persawahan, Desa Cintanagara
                                            </small>
                                            <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                                Jalur lintasan pedesaan berhawa sejuk yang membentang menembus hamparan persawahan terasering hijau dan aliran parit irigasi alami. Sangat cocok untuk jogging pagi, jalan santai, maupun bersepeda menikmati matahari terbit.
                                            </p>
                                            <div class="mb-3 d-flex flex-wrap gap-1">
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Jalur Jogging &amp; Sepeda</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Gardu Pandang Terasering</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Spot Foto Pematang</span>
                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>Warung Kopi Tradisional</span>
                                            </div>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <a href="../destinasi/jalan-usaha-tani" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-semibold">
                                                    <i class="bi bi-eye-fill me-1"></i> Lihat Deskripsi, Galeri &amp; Fasilitas
                                                </a>
                                                <a href="../pemesanan.php?destinasi=Jalan%20Usaha%20Tani" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2">
                                                    <i class="bi bi-ticket-perforated me-1"></i> Pesan Tiket
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- SIDEBAR INFORMASI DESA & TIKET -->
            <div class="col-lg-4">
                <aside class="detail-sidebar sticky-top" style="top: 95px;">

                    <!-- KARTU INFORMASI DESA -->
                    <div class="info-card mb-4">
                        <h3>Informasi Desa Wisata</h3>

                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <span>Lokasi Desa</span>
                                <a
                                    href="https://www.google.com/maps/search/?api=1&query=Desa+Cintanagara+Jatinagara+Ciamis"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="location-link"
                                >
                                    <strong>Desa Cintanagara</strong>
                                    <small>
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        Lihat di Google Maps
                                    </small>
                                </a>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-map"></i>
                            <div>
                                <span>Kecamatan</span>
                                <strong>Jatinagara</strong>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-file-earmark-check-fill"></i>
                            <div>
                                <span>Legalitas SK Bupati</span>
                                <strong>446/Kpts.232-Huk/2020</strong>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-tag-fill"></i>
                            <div>
                                <span>Kategori Wisata</span>
                                <strong>Wisata Alam &amp; Budaya Terpadu</strong>
                            </div>
                        </div>
                    </div>

                    <!-- KARTU PEMESANAN TIKET CEPAT -->
                    <div class="visit-card mb-4" style="background: linear-gradient(135deg, #176b52 0%, #0e4534 100%); color: #fff; border-radius: 16px; padding: 24px;">
                        <div class="visit-icon mb-2" style="font-size: 28px; color: #8ee4b5;">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </div>

                        <h4 class="fw-bold mb-2 text-white">Reservasi E-Ticket</h4>

                        <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                            Pesan tiket masuk resmi destinasi di Desa Cintanagara secara online. Dapatkan barcode e-ticket instan dan verifikasi mudah di gerbang masuk.
                        </p>

                        <a href="../pemesanan.php?destinasi=Wisata%20Alam" class="btn btn-light w-100 rounded-pill fw-bold text-success py-2 shadow-sm">
                            <i class="bi bi-cart-plus me-1"></i> Pesan Tiket Masuk
                        </a>
                    </div>

                    <!-- KARTU PETA GOOGLE MAPS -->
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-pin-map-fill text-success me-2"></i>Panduan Rute Wisata</h6>
                        <p class="text-secondary small mb-3">
                            Akses menuju Desa Wisata Cintanagara dapat ditempuh dari pusat kota Ciamis melalui rute Kawali - Jatinagara.
                        </p>
                        <a href="https://www.google.com/maps/search/?api=1&query=Desa+Cintanagara+Jatinagara+Ciamis" target="_blank" class="btn btn-outline-secondary btn-sm w-100 rounded-pill">
                            <i class="bi bi-compass me-1"></i> Petunjuk Arah GPS
                        </a>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</main>

<!-- DESTINASI TERKAIT -->
<section class="related-destination">
    <div class="container">

        <div class="section-heading">
            <span class="section-label">JELAJAHI LAGI</span>

            <h2>Destinasi Wisata Ciamis</h2>

            <p>
                Temukan berbagai destinasi menarik lainnya
                di Kabupaten Ciamis.
            </p>
        </div>

        <div class="text-center">
            <a href="../destinasi.php" class="btn btn-primary">
                Lihat Semua Destinasi
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

<!-- ULASAN PENGUNJUNG -->
<section class="review-section" id="ulasan">
    <div class="container">

        <div class="review-heading">
            <span class="section-label">PENGALAMAN PENGUNJUNG</span>
            <h2>Ulasan Pengunjung</h2>
            <p>
                Bagikan pengalaman dan pendapat kamu setelah mengunjungi
                Desa Cintanagara.
            </p>
        </div>

        <?php if ($pesanUlasan): ?>
            <div class="alert alert-<?= htmlspecialchars($pesanUlasan['type'], ENT_QUOTES, 'UTF-8') ?> review-alert">
                <?= htmlspecialchars($pesanUlasan['text'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- RINGKASAN RATING -->
        <div class="review-summary">

            <div class="review-average">
                <?= number_format($rataRating, 1, ',', '.') ?>
            </div>

            <div>
                <div class="review-stars">
                    <?php
                    $ratingBulat = (int) round($rataRating);

                    for ($i = 1; $i <= 5; $i++):
                    ?>
                        <?php if ($i <= $ratingBulat): ?>
                            <i class="bi bi-star-fill"></i>
                        <?php else: ?>
                            <i class="bi bi-star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

                <div class="review-total">
                    <?= $jumlahUlasan ?> ulasan pengunjung
                </div>
            </div>

        </div>

        <!-- DAFTAR ULASAN -->
        <div class="review-list">

            <?php if (!empty($daftarUlasan)): ?>

                <?php foreach ($daftarUlasan as $ulasan): ?>

                    <div class="review-item">

                        <div class="review-user">

                            <div class="review-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>

                            <div class="review-user-info">
                                <strong>
                                    <?= htmlspecialchars($ulasan['user_name'], ENT_QUOTES, 'UTF-8') ?>
                                </strong>

                                <small>
                                    <?php
                                    echo !empty($ulasan['created_at'])
                                        ? date('d M Y', strtotime($ulasan['created_at']))
                                        : '';
                                    ?>
                                </small>
                            </div>

                        </div>

                        <div class="review-stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>

                                <?php if ($i <= (int) $ulasan['rating']): ?>
                                    <i class="bi bi-star-fill"></i>
                                <?php else: ?>
                                    <i class="bi bi-star"></i>
                                <?php endif; ?>

                            <?php endfor; ?>
                        </div>

                        <p class="review-comment">
                            <?= nl2br(htmlspecialchars($ulasan['comment'], ENT_QUOTES, 'UTF-8')) ?>
                        </p>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="review-empty">
                    <i class="bi bi-chat-square-text"></i>

                    <h5>Belum Ada Ulasan</h5>

                    <p class="mb-0">
                        Jadilah pengunjung pertama yang memberikan ulasan
                        untuk Desa Cintanagara.
                    </p>
                </div>

            <?php endif; ?>

        </div>

        <!-- FORM KIRIM ULASAN -->
        <?php if ($sudahLogin): ?>

            <div class="review-form-card">

                <h3>
                    <i class="bi bi-pencil-square me-2"></i>
                    Tulis Ulasan Kamu
                </h3>

                <form action="cintanagara.php#ulasan" method="POST">

                    <input
                        type="hidden"
                        name="review_csrf"
                        value="<?= htmlspecialchars($_SESSION['review_csrf'], ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Berikan Rating
                        </label>

                        <div class="rating-input">

                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" title="Sangat Baik">
                                <i class="bi bi-star-fill"></i>
                            </label>

                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="Baik">
                                <i class="bi bi-star-fill"></i>
                            </label>

                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="Cukup">
                                <i class="bi bi-star-fill"></i>
                            </label>

                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="Kurang">
                                <i class="bi bi-star-fill"></i>
                            </label>

                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="Buruk">
                                <i class="bi bi-star-fill"></i>
                            </label>

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label fw-semibold">
                            Komentar
                        </label>

                        <textarea
                            name="comment"
                            id="comment"
                            class="form-control"
                            placeholder="Ceritakan pengalaman kamu mengunjungi Desa Cintanagara..."
                            maxlength="1000"
                            required
                        ></textarea>

                        <small class="text-muted">
                            Maksimal 1000 karakter.
                        </small>
                    </div>

                    <button type="submit" name="kirim_ulasan" class="review-submit">
                        <i class="bi bi-send me-2"></i>
                        Kirim Ulasan
                    </button>

                </form>

            </div>

        <?php else: ?>

            <div class="review-login">

                <h5 class="fw-bold">
                    Ingin memberikan ulasan?
                </h5>

                <p class="text-muted mb-3">
                    Silakan masuk ke akun kamu terlebih dahulu untuk memberikan rating dan komentar.
                </p>

                <a href="../masuk.php" class="btn btn-success">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Masuk untuk Memberikan Ulasan
                </a>

            </div>

        <?php endif; ?>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">

        <div class="row g-4">

            <div class="col-lg-5">
                <a href="../index.php" class="footer-logo">
                    <img
                        src="../pictures/LogoDispar.png"
                        alt="Logo Desa Wisata Kabupaten Ciamis"
                    >
                </a>

                <p>
                    Media informasi dan pengenalan potensi Desa Wisata
                    Kabupaten Ciamis.
                </p>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4>Navigasi</h4>

                <ul>
                    <li><a href="../index.php">Beranda</a></li>
                    <li><a href="../destinasi.php">Destinasi</a></li>
                    <li><a href="../berita.php">Berita</a></li>
                    <li><a href="../pemesanan.php">Pemesanan</a></li>
                    <li><a href="../pusat-bantuan.php">Pusat Bantuan</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h4>Kontak</h4>

                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    Kabupaten Ciamis, Jawa Barat
                </p>

                <p>
                    <i class="bi bi-envelope-fill"></i>
                    info@dewiciamis.id
                </p>
            </div>

        </div>

        <hr>

        <div class="footer-bottom">
            <p>
                © 2026 Desa Wisata Kabupaten Ciamis.
                Semua Hak Dilindungi.
            </p>

            <div class="social-links">
                <a href="#" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="#" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="#" aria-label="YouTube">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </div>

    </div>
</footer>

<!-- JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>

</body>
</html>
