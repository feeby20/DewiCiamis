const fs = require('fs');
const path = require('path');

// 1. Baca data dari public/js/destinasi.js
const jsContent = fs.readFileSync(path.join(__dirname, '../public/js/destinasi.js'), 'utf8');
const match = jsContent.match(/const desaWisataData = (\[[\s\S]*?\]);/);
if (!match) {
    console.error('Gagal mengekstrak desaWisataData dari destinasi.js');
    process.exit(1);
}

const desaList = eval(match[1]);
console.log(`Ditemukan ${desaList.length} data desa wisata di destinasi.js.`);

const availableImages = fs.readdirSync(path.join(__dirname, '../public/pictures/destinasi'));

// Manual mapping yang presisi untuk gambar destinasi tertentu
const specificImageMap = {
    'Kolam Renang Jembatan Swiss': 'KolanRenangJembatanSwiss.webp',
    'Jembatan Swiss': 'JembatanSwiss.jpeg',
    'Wisata Alam': 'CintaNagara.webp',
    'Agrowisata': 'AgroCipaku.webp',
    'Jalan Usaha Tani': 'KampungSawah.jpeg',
    'Situs Aria Dipa': 'AriaDipa.jpeg',
    'Taman Uncal Bubulak': 'TamanUncalBubulak.jpeg',
    'Layang Lakbok': 'LayangLakbok.jpeg',
    'Curug Tujuh': 'CurugTujuhCibolang.jpeg',
    'Buper Aki Kabayan': 'BuperAkiKabayan.jpeg',
    'Situs Cidehem': 'Cidehem.jpeg',
    'Curug Panganten': 'CurugPanganten.jpeg',
    'Buper Awilega': 'BuperAwilega.jpeg',
    'Leuwi Pamipiran': 'LeuwiPamipiran.jpeg',
    'Curug Seda': 'CurugSeda.jpeg',
    'Kolam Renang Alam JF': 'KolamRenangAlamJF.jpeg',
    'Wisata Sungai Ciharus': 'SungaiCiharus.jpeg',
    'Buper Puncak Asih': 'BuperPuncakAsih.jpeg',
    'Agrowisata Sukapulang': 'SukaPulang.jpeg',
    'Desa Adat Sejahtera Berencana': 'DesaAdatSejahtera.jpeg',
    'Makam Situs Cikapunduhan': 'VillaSrikandi.jpeg',
    'Villa Srikandi': 'VillaSrikandi.jpeg',
    'Wisata Alam Cibagi': 'Cibagi.jpeg',
    'Wisata Religi Makam Syeh Abu Syahar': 'KampungAngklung.jpeg',
    'Wisata Alam Cireong': 'Cireong.jpeg',
    'Kampung Angklung': 'KampungAngklung.jpeg',
    'Wisata Religi Makam Bupati Galuh': 'MakanBupatiGaluh.jpeg',
    'Kampung Tahu': 'KampungTahu.jpeg',
    'Agrowisata Pasir Boma': 'PasirBoma.jpeg',
    'Situs Gunung Susuru': 'GunungSusuru.jpeg',
    'Bukit Cikulak': 'BukitCikulak.jpeg',
    'Situ Rancamaya': 'SituRancamayana.jpeg',
    'Cekdam Kadupandak': 'CekdamKadupandak.jpeg',
    'Kampung Legenda': 'KampungLegenda.jpeg',
    'Jaha Buana': 'JahaBuana.jpeg',
    'Agrowisata, Buper dan Pangangonan': 'PangangonanCibadak.jpeg',
    'Agrowisata, Cagar Budaya Rumah Bintang': 'RumahBintang.jpeg',
    'Cagar Budaya Rumah Bintang': 'RumahBintang.jpeg',
    'Situs Opanjalu': 'Cipanjalu.jpeg',
    'Embung Ciwaleud': 'EnbungCiawade.jpg',
    'Seni Budaya Mekar Arum': 'EnbungCiawade.jpg',
    'Hutan Pinus Batu Cakra': 'PinusBatuCakra.jpeg',
    'Sungai Cireong': 'Cireong.jpeg',
    'Situs Gunung Padang': 'GunungPadang.jpeg',
    'Homestay': 'selamanik.jpeg',
    'Bukit Sempalan Asri': 'BukitSemparanAsli.jpeg',
    'Lobang Timah': 'LobangTimah.jpeg',
    'Samida': 'BukitSamida.webp',
    'Situs Gunung Marapi': 'BukitSamida.webp',
    'Kampung Bungur': 'KampungBangur.jpeg',
    'Puncak Upsa Rahong': 'PuncakUpsa.jpeg',
    'Situ Rancabala': 'SituRancabala.jpeg',
    'Situ Hiang': 'SiituHiang.jpeg',
    'Agro Wisata': 'AgroCipaku.webp',
    'Kampung Teratai': 'KampungTeratai.jpeg',
    'Puncak Kertajaya': 'PuncakKartajaya.jpeg',
    'Paralayang': 'ParalayangPanawangan.webp',
    'Tonjong Golok': 'TonjongGolok.jpeg',
    'Cadas Ngampar': 'CadasNgampar.webp',
    'Situ Cibubuhan': 'SituCibubuhan.webp',
    'Kampung Kuta': 'KampungKuta.jpeg',
    'Kampung Madu': 'KampungMadu.jpeg',
    'Pemandian Air Panas': 'PemandianAirPanas.webp',
    'Situ Lengkong Panjalu': 'SituLengkongPanjalu.jpeg',
    'Taman Wisata': 'BumiPekemahan.jpeg',
    'Bumi Perkemahan': 'BumiPekemahan.jpeg',
    'Curug Salosin': 'CurugSalosin.jpeg',
    'Situs Gandoang': 'Gandongan.webp',
    'Puncak Bangku': 'PuncakBangku.jpeg',
    'Puncak Pispun': 'PuncakBangku.jpeg',
    'Wisata Edukasi Anak': 'WisataEdukasiAnakCisontol.jpeg',
    'Puncak Manik': 'PuncakManik.jpeg',
    'Situs Karangkamulyan': 'Karangkamulyan.jpeg',
    'Wisata Murbey': 'WisataMurbey.jpeg',
    'Puncak Meralaya': 'PuncakMaralaya.jpeg',
    'Pasir Jati Grown Hill': 'PasirJatiGrownHill.jpeg',
    'Kampung Sawah': 'KampungSawah.jpeg',
    'Situ Wangi': 'SituWangi.jpeg',
    'Astana Gede Kawali': 'AstanaGedeKawali.jpeg',
};

function getDestinationImage(destName, fallbackImage) {
    if (specificImageMap[destName] && availableImages.includes(specificImageMap[destName])) {
        return specificImageMap[destName];
    }
    const cleanName = destName.toLowerCase().replace(/[^a-z0-9]/g, '');
    for (const f of availableImages) {
        const cleanFile = f.toLowerCase().replace(/[^a-z0-9]/g, '').replace(/(jpeg|jpg|webp|png)$/, '');
        if (cleanFile && (cleanName.includes(cleanFile) || cleanFile.includes(cleanName))) {
            return f;
        }
    }
    return fallbackImage.replace('pictures/destinasi/', '');
}

function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

function getCategoryIcon(kat) {
    const map = {
        'Alam': 'bi-tree-fill',
        'Buatan': 'bi-building',
        'Sejarah & Budaya': 'bi-bank',
        'Budaya': 'bi-music-note-beamed',
        'Air': 'bi-water',
        'Agrowisata': 'bi-flower1',
        'Religi': 'bi-moon-stars-fill',
        'Edukasi': 'bi-book-half',
        'Olahraga': 'bi-bicycle',
    };
    return map[kat] || 'bi-geo-alt-fill';
}

function getCategoryBadge(kat) {
    const map = {
        'Alam': 'success',
        'Buatan': 'primary',
        'Sejarah & Budaya': 'warning',
        'Budaya': 'warning',
        'Air': 'info',
        'Agrowisata': 'success',
        'Religi': 'secondary',
        'Edukasi': 'info',
        'Olahraga': 'primary',
    };
    return map[kat] || 'success';
}

let generatedCount = 0;

for (const d of desaList) {
    const detailFile = d.detail ? d.detail.replace(/^detail\//, '') : `${slugify(d.desa)}.php`;
    const targetPath = path.join(__dirname, '../public/detail', detailFile);

    const namaDesaClean = d.desa.trim();
    const namaDesaDisplay = namaDesaClean.toLowerCase().startsWith('desa') ? namaDesaClean : `Desa ${namaDesaClean}`;
    const kecamatan = d.kecamatan || 'Ciamis';
    const skBupati = d.sk || '446/Kpts.232-Huk/2020';
    const statusDesa = d.status || 'Rintisan';
    const kategoriDesa = d.kategori || 'Alam';
    const gambarBanner = d.gambar.replace('pictures/destinasi/', '');
    const deskripsiDesa = d.deskripsi || `Desa Wisata ${namaDesaClean} di Kecamatan ${kecamatan} menawarkan keasrian alam pedesaan, potensi budaya lokal, dan keramahan masyarakat Tatar Galuh Kabupaten Ciamis.`;

    const destinasiList = d.destinasi && d.destinasi.length > 0 ? d.destinasi : [
        {
            nama: d.destinasi_unggulan || d.desa,
            deskripsi: `Destinasi wisata unggulan di Desa Wisata ${namaDesaClean} yang menyuguhkan keindahan panorama dan suasana khas pedesaan Priangan Timur.`,
            fasilitas: ['Area Parkir', 'Spot Foto', 'Warung Kuliner', 'Toilet']
        }
    ];

    const namaDestinasiUtama = destinasiList[0].nama;
    const jumlahDest = destinasiList.length;
    const jumlahDestLabel = jumlahDest === 1 ? '1 Destinasi Tersedia' : `${jumlahDest} Destinasi Tersedia`;

    // Render kartu tiap destinasi
    let kartuDestinasiHtml = '';
    destinasiList.forEach((dest, idx) => {
        const destNama = dest.nama;
        const destSlug = slugify(destNama);
        const destFoto = getDestinationImage(destNama, d.gambar);
        const destDesc = dest.deskripsi || `Destinasi wisata ${destNama} di kawasan Desa Wisata ${namaDesaClean}.`;
        const destIcon = getCategoryIcon(kategoriDesa);
        const destBadge = getCategoryBadge(kategoriDesa);

        let fasilitasHtml = '';
        if (Array.isArray(dest.fasilitas)) {
            dest.fasilitas.forEach(f => {
                fasilitasHtml += `                                                <span class="badge bg-light text-secondary border small"><i class="bi bi-check2 text-success me-1"></i>${f}</span>\n`;
            });
        }

        kartuDestinasiHtml += `
                        <!-- DESTINASI: ${destNama} -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden destinasi-card-hover bg-white border">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-5">
                                        <a href="../destinasi/${destSlug}" class="d-block overflow-hidden position-relative" style="height: 240px;">
                                            <img src="../pictures/destinasi/${destFoto}" alt="${destNama}" class="w-100 h-100 object-fit-cover card-img-zoom">
                                            <span class="badge bg-${destBadge} position-absolute top-0 start-0 m-3 shadow-sm">
                                                <i class="bi ${destIcon} me-1"></i> ${kategoriDesa}
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
                                                    <a href="../destinasi/${destSlug}" class="text-dark text-decoration-none">
                                                        ${destNama}
                                                    </a>
                                                </h4>
                                                <span class="badge bg-light text-success border border-success-subtle fw-semibold">Rp <?= $hargaTiketFormat ?></span>
                                            </div>
                                            <small class="text-muted d-block mb-2">
                                                <i class="bi bi-geo-alt-fill text-success me-1"></i>${namaDesaDisplay}, Kecamatan ${kecamatan}
                                            </small>
                                            <p class="text-secondary small mb-3" style="line-height: 1.65;">
                                                ${destDesc}
                                            </p>
                                            <div class="mb-3 d-flex flex-wrap gap-1">
${fasilitasHtml}                                            </div>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <a href="../destinasi/${destSlug}" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-semibold">
                                                    <i class="bi bi-eye-fill me-1"></i> Lihat Deskripsi, Galeri &amp; Fasilitas
                                                </a>
                                                <a href="../pemesanan.php?destinasi=<?= urlencode('${destNama}') ?>" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2">
                                                    <i class="bi bi-ticket-perforated me-1"></i> Pesan Tiket
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
`;
    });

    const fileContent = `<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

$sudahLogin = isset($_SESSION['user_id']);
$namaPengguna = $_SESSION['user_nama'] ?? 'Akun Saya';

$namaDesa      = '${namaDesaDisplay}';
$kecamatan     = '${kecamatan}';
$skBupati      = '${skBupati}';
$statusDesa    = '${statusDesa}';
$kategoriDesa  = '${kategoriDesa}';
$namaDestinasi = '${namaDestinasiUtama.replace(/'/g, "\\'")}';
$hargaTiket    = 6500;

// Ambil harga tiket dari database jika tersedia
try {
    $stmtHarga = $pdo->prepare("
        SELECT ticket_price FROM destination_prices
        WHERE destination_name LIKE :nama OR destination_name = :dname LIMIT 1
    ");
    $stmtHarga->execute([':nama' => "%$namaDestinasi%", ':dname' => $namaDestinasi]);
    $dataHarga = $stmtHarga->fetch(PDO::FETCH_ASSOC);
    if ($dataHarga && isset($dataHarga['ticket_price'])) {
        $hargaTiket = (int) $dataHarga['ticket_price'];
    }
} catch (PDOException $e) {
    error_log('Harga tiket gagal dimuat: ' . $e->getMessage());
}

$hargaTiketFormat = number_format($hargaTiket, 0, ',', '.');

// CSRF & ulasan
if (empty($_SESSION['review_csrf'])) {
    $_SESSION['review_csrf'] = bin2hex(random_bytes(32));
}

$pesanUlasan = $_SESSION['review_message'] ?? null;
unset($_SESSION['review_message']);

// Proses kirim ulasan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kirim_ulasan'])) {
    if (!$sudahLogin) { header('Location: ../masuk.php'); exit; }
    $token    = $_POST['review_csrf'] ?? '';
    $rating   = (int) ($_POST['rating'] ?? 0);
    $komentar = trim($_POST['comment'] ?? '');
    if (!hash_equals($_SESSION['review_csrf'], $token)) {
        $_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Permintaan tidak valid. Silakan coba kembali.'];
    } elseif ($rating < 1 || $rating > 5) {
        $_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Silakan pilih rating bintang 1 sampai 5.'];
    } elseif ($komentar === '') {
        $_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Komentar ulasan tidak boleh kosong.'];
    } elseif (mb_strlen($komentar) > 1000) {
        $_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Komentar maksimal 1000 karakter.'];
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO destination_reviews (user_id, user_name, destination_name, rating, comment) VALUES (:uid, :uname, :dname, :rating, :comment)");
            $stmt->execute([':uid' => $_SESSION['user_id'], ':uname' => $namaPengguna, ':dname' => $namaDestinasi, ':rating' => $rating, ':comment' => $komentar]);
            $_SESSION['review_message'] = ['type' => 'success', 'text' => 'Terima kasih! Ulasan kamu berhasil dikirim.'];
            $_SESSION['review_csrf'] = bin2hex(random_bytes(32));
        } catch (PDOException $e) {
            $_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Ulasan gagal dikirim. Silakan coba lagi.'];
        }
    }
    header('Location: ${detailFile}?ulasan=1#ulasan'); exit;
}

// Ambil ulasan
$daftarUlasan = []; $jumlahUlasan = 0; $rataRating = 0;
try {
    $stmtR = $pdo->prepare("SELECT COUNT(*) AS jml, COALESCE(AVG(rating), 0) AS avg FROM destination_reviews WHERE destination_name LIKE :d");
    $stmtR->execute([':d' => "%$namaDestinasi%"]);
    $rowR = $stmtR->fetch(PDO::FETCH_ASSOC);
    $jumlahUlasan = (int) ($rowR['jml'] ?? 0);
    $rataRating   = round((float) ($rowR['avg'] ?? 0), 1);
    $stmtU = $pdo->prepare("SELECT * FROM destination_reviews WHERE destination_name LIKE :d ORDER BY created_at DESC LIMIT 20");
    $stmtU->execute([':d' => "%$namaDestinasi%"]);
    $daftarUlasan = $stmtU->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Gagal mengambil ulasan: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($namaDesa) ?> | DewiCiamis - Desa Wisata Kabupaten Ciamis</title>
    <meta name="description" content="Jelajahi potensi wisata <?= htmlspecialchars($namaDesa) ?>, Kecamatan <?= htmlspecialchars($kecamatan) ?>, Kabupaten Ciamis. Temukan destinasi, fasilitas, galeri foto, dan pemesanan tiket.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/detail.css">
    <style>
        .destinasi-card-hover { transition: transform 0.25s ease, box-shadow 0.25s ease; }
        .destinasi-card-hover:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.12) !important; }
        .card-img-zoom { transition: transform 0.4s ease; }
        .destinasi-card-hover:hover .card-img-zoom { transform: scale(1.06); }
        .review-section { padding: 65px 0; background: #f8faf9; }
        .review-heading h2 { font-size: 26px; font-weight: 700; color: #174b38; margin-bottom: 8px; }
        .review-summary { display: flex; align-items: center; gap: 20px; background: #fff; padding: 22px; border-radius: 15px; border: 1px solid #e9eeeb; margin-bottom: 22px; }
        .review-average { font-size: 46px; font-weight: 700; color: #174b38; line-height: 1; }
        .review-stars { color: #f5b301; font-size: 17px; letter-spacing: 2px; }
        .review-total { color: #777; font-size: 13px; margin-top: 4px; }
        .review-item { background: #fff; padding: 20px; border-radius: 14px; border: 1px solid #e9eeeb; margin-bottom: 14px; }
        .review-avatar { width: 44px; height: 44px; border-radius: 50%; background: #e5f3eb; color: #176b45; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .review-form-card { background: #fff; padding: 24px; border-radius: 15px; border: 1px solid #e9eeeb; margin-top: 22px; }
        .review-form-card h3 { color: #174b38; font-size: 19px; font-weight: 700; margin-bottom: 16px; }
        .rating-input { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; margin-bottom: 16px; }
        .rating-input input { display: none; }
        .rating-input label { font-size: 30px; color: #d6d6d6; cursor: pointer; transition: 0.2s; }
        .rating-input label:hover, .rating-input label:hover ~ label, .rating-input input:checked ~ label { color: #f5b301; }
        @media (max-width: 768px) {
            .card .row.g-0 { flex-direction: column; }
            .card .col-md-5 { min-height: 220px; }
            .card .col-md-5 a { height: 220px !important; }
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="../index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="../destinasi.php">Desa Wisata</a></li>
                <li class="nav-item"><a class="nav-link" href="../berita.php">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="../pemesanan.php">Tiket</a></li>
                <li class="nav-item"><a class="nav-link" href="../pusat-bantuan.php">Pusat Bantuan</a></li>
                <?php if ($sudahLogin): ?>
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($namaPengguna, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                        <li><a class="dropdown-item" href="../akun-saya.php"><i class="bi bi-person-circle me-2"></i>Akun Saya</a></li>
                        <li><a class="dropdown-item" href="../tiket-saya.php"><i class="bi bi-ticket-perforated me-2"></i>Tiket Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../keluar.php"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item d-none d-lg-block"><span class="nav-link text-secondary">|</span></li>
                <li class="nav-item"><a class="nav-link" href="../masuk.php">Masuk</a></li>
                <li class="nav-item ms-lg-2"><a class="btn btn-primary px-4" href="../daftar.php">Daftar</a></li>
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
            <span><?= htmlspecialchars($namaDesa) ?></span>
        </div>
        <div class="detail-hero-content">
            <div class="detail-category">
                <i class="bi bi-house-heart-fill"></i>
                DESA WISATA KABUPATEN CIAMIS &bull; <?= strtoupper(htmlspecialchars($statusDesa)) ?>
            </div>
            <h1><?= htmlspecialchars($namaDesa) ?></h1>
            <div class="detail-location">
                <i class="bi bi-geo-alt-fill"></i>
                Kecamatan <?= htmlspecialchars($kecamatan) ?>, Kabupaten Ciamis, Jawa Barat
            </div>
        </div>
    </div>
</section>

<!-- KONTEN UTAMA -->
<main class="detail-content">
    <div class="container">
        <div class="row g-5">

            <!-- ARTIKEL DESA & DESTINASI -->
            <div class="col-lg-8">

                <!-- FOTO BANNER DESA -->
                <div class="detail-image-card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                    <img src="../pictures/destinasi/${gambarBanner}" alt="<?= htmlspecialchars($namaDesa) ?>" class="detail-image" style="width: 100%; max-height: 420px; object-fit: cover;">
                </div>
                <div class="photo-source mb-4">
                    <i class="bi bi-camera-fill"></i>
                    <span>Sumber Foto: Dokumentasi <?= htmlspecialchars($namaDesa) ?></span>
                </div>

                <!-- PROFIL DESA -->
                <article class="detail-article mb-5">
                    <span class="article-label">PROFIL DESA WISATA</span>
                    <h2>Mengenal <?= htmlspecialchars($namaDesa) ?></h2>
                    <p>${deskripsiDesa}</p>
                    <p>Secara administratif, <?= htmlspecialchars($namaDesa) ?> terletak di wilayah Kecamatan <?= htmlspecialchars($kecamatan) ?>, Kabupaten Ciamis, dan telah resmi dikukuhkan sebagai Desa Wisata berdasarkan ketetapan <strong>SK Bupati Ciamis No. <?= htmlspecialchars($skBupati) ?></strong> dengan status kategori <strong><?= htmlspecialchars($statusDesa) ?></strong>.</p>
                </article>

                <!-- KATALOG DESTINASI -->
                <div class="destinasi-katalog-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <span class="badge bg-success-subtle text-success px-3 rounded-pill mb-1 small fw-semibold">
                                <i class="bi bi-collection-fill me-1"></i> EKSPLORASI DESTINASI
                            </span>
                            <h3 class="fw-bold text-dark mb-1">Destinasi di <?= htmlspecialchars($namaDesa) ?></h3>
                        </div>
                        <span class="badge bg-success rounded-pill px-3 py-2">${jumlahDestLabel}</span>
                    </div>
                    <p class="text-secondary small mb-4">
                        Klik pada foto atau tombol destinasi di bawah untuk menuju halaman khusus masing-masing destinasi, melihat <strong>deskripsi lengkap</strong>, <strong>galeri foto</strong>, <strong>fasilitas terperinci</strong>, dan <strong>pemesanan tiket</strong>:
                    </p>
                    <div class="row g-4">
${kartuDestinasiHtml}
                    </div>
                </div>

            </div>

            <!-- SIDEBAR INFORMASI DESA -->
            <div class="col-lg-4">
                <aside class="detail-sidebar sticky-top" style="top: 95px;">

                    <!-- INFO DESA -->
                    <div class="info-card mb-4">
                        <h3>Informasi Desa Wisata</h3>
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <span>Lokasi Desa</span>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($namaDesa . ' ' . $kecamatan . ' Ciamis') ?>" target="_blank" rel="noopener noreferrer" class="location-link">
                                    <strong><?= htmlspecialchars($namaDesa) ?></strong>
                                    <small><i class="bi bi-box-arrow-up-right"></i> Lihat di Google Maps</small>
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-map"></i>
                            <div>
                                <span>Kecamatan</span>
                                <strong><?= htmlspecialchars($kecamatan) ?></strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-file-earmark-check-fill"></i>
                            <div>
                                <span>SK Penetapan Bupati</span>
                                <strong><?= htmlspecialchars($skBupati) ?></strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-award-fill"></i>
                            <div>
                                <span>Status Kategori</span>
                                <span class="badge bg-success-subtle text-success fw-semibold"><?= htmlspecialchars($statusDesa) ?></span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-collection-fill"></i>
                            <div>
                                <span>Jumlah Destinasi</span>
                                <strong>${jumlahDest} Destinasi</strong>
                            </div>
                        </div>
                    </div>

                    <!-- INFO TIKET -->
                    <div class="info-card mb-4">
                        <h3>Informasi Kunjungan</h3>
                        <div class="info-item">
                            <i class="bi bi-ticket-perforated-fill text-success"></i>
                            <div>
                                <span>Harga Tiket Masuk</span>
                                <strong class="text-success fs-5">Rp <?= $hargaTiketFormat ?> / orang</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <span>Jam Operasional</span>
                                <strong>08.00 – 17.00 WIB</strong>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="../pemesanan.php?destinasi=<?= urlencode($namaDestinasi) ?>" class="btn btn-success w-100 rounded-pill fw-semibold">
                                <i class="bi bi-ticket-perforated me-2"></i>Pesan Tiket Sekarang
                            </a>
                        </div>
                    </div>

                    <!-- JELAJAHI DESA -->
                    <div class="info-card bg-success text-white">
                        <div class="text-center py-2">
                            <i class="bi bi-compass-fill" style="font-size: 2rem; opacity: 0.8;"></i>
                            <h5 class="fw-bold mt-2 mb-1">Jelajahi <?= htmlspecialchars($namaDesa) ?></h5>
                            <p class="small mb-3 opacity-75">Nikmati pesona alam dan kearifan lokal di <?= htmlspecialchars($namaDesa) ?>, Kecamatan <?= htmlspecialchars($kecamatan) ?>.</p>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($namaDesa . ' ' . $kecamatan . ' Ciamis') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-light btn-sm rounded-pill px-4 fw-semibold text-success">
                                <i class="bi bi-geo-alt-fill me-1"></i> Lihat Lokasi
                            </a>
                        </div>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</main>

<!-- ULASAN PENGUNJUNG -->
<section class="review-section" id="ulasan">
    <div class="container">
        <div class="review-heading">
            <h2><i class="bi bi-chat-square-quote-fill me-2"></i>Ulasan Pengunjung</h2>
            <p class="text-muted"><?= htmlspecialchars($namaDesa) ?>, Kecamatan <?= htmlspecialchars($kecamatan) ?></p>
        </div>

        <?php if ($pesanUlasan): ?>
        <div class="alert alert-<?= $pesanUlasan['type'] ?> review-alert">
            <?= htmlspecialchars($pesanUlasan['text']) ?>
        </div>
        <?php endif; ?>

        <?php if ($jumlahUlasan > 0): ?>
        <div class="review-summary">
            <div class="review-average"><?= number_format($rataRating, 1) ?></div>
            <div>
                <div class="review-stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star<?= $i <= round($rataRating) ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                </div>
                <div class="review-total"><?= $jumlahUlasan ?> ulasan pengunjung</div>
            </div>
        </div>
        <div>
            <?php foreach ($daftarUlasan as $ulasan): ?>
            <div class="review-item">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="review-avatar"><i class="bi bi-person-fill"></i></div>
                    <div>
                        <strong class="d-block" style="color:#26352d;"><?= htmlspecialchars($ulasan['user_name']) ?></strong>
                        <small class="text-muted"><?= htmlspecialchars(substr($ulasan['created_at'] ?? '', 0, 10)) ?></small>
                    </div>
                </div>
                <div class="review-stars mb-2" style="font-size:14px;">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star<?= $i <= (int)$ulasan['rating'] ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-muted small mb-0" style="line-height:1.7;"><?= nl2br(htmlspecialchars($ulasan['comment'])) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="review-empty mb-3" style="background:#fff; text-align:center; padding:30px; border:1px dashed #d9e2dc; border-radius:14px; color:#777;">
            <i class="bi bi-chat-square-text" style="display:block; font-size:32px; color:#a5b9ac; margin-bottom:10px;"></i>
            Belum ada ulasan untuk <?= htmlspecialchars($namaDesa) ?>. Jadilah yang pertama memberikan ulasan!
        </div>
        <?php endif; ?>

        <?php if ($sudahLogin): ?>
        <div class="review-form-card">
            <h3>Tulis Ulasan Anda</h3>
            <form method="POST" action="">
                <input type="hidden" name="kirim_ulasan" value="1">
                <input type="hidden" name="review_csrf" value="<?= htmlspecialchars($_SESSION['review_csrf']) ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Rating</label>
                    <div class="rating-input">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" name="rating" id="star<?= $i ?>" value="<?= $i ?>">
                        <label for="star<?= $i ?>" title="<?= $i ?> bintang">&#9733;</label>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label fw-semibold">Komentar</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Ceritakan pengalaman kunjungan Anda..." style="min-height:110px; resize:vertical;" maxlength="1000"></textarea>
                </div>
                <button type="submit" class="btn btn-success fw-semibold rounded-pill px-4">
                    <i class="bi bi-send-fill me-1"></i> Kirim Ulasan
                </button>
            </form>
        </div>
        <?php else: ?>
        <div class="p-4 bg-white border border-light-subtle rounded-4 mt-3 text-center">
            <p class="text-muted mb-3">Anda perlu login untuk memberikan ulasan.</p>
            <a href="../masuk.php" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk untuk Memberikan Ulasan
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="../pictures/LogoDispar.png" alt="DewiCiamis">
                <p>Platform informasi desa wisata Kabupaten Ciamis yang menampilkan potensi wisata alam, budaya, dan sejarah dari seluruh desa wisata.</p>
            </div>
            <div class="footer-links">
                <h4>Menu</h4>
                <ul>
                    <li><a href="../index.php">Beranda</a></li>
                    <li><a href="../destinasi.php">Desa Wisata</a></li>
                    <li><a href="../berita.php">Berita</a></li>
                    <li><a href="../pemesanan.php">Tiket</a></li>
                    <li><a href="../pusat-bantuan.php">Pusat Bantuan</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Akun</h4>
                <ul>
                    <li><a href="../masuk.php">Masuk</a></li>
                    <li><a href="../daftar.php">Daftar</a></li>
                    <?php if ($sudahLogin): ?>
                    <li><a href="../akun-saya.php">Profil Saya</a></li>
                    <li><a href="../keluar.php">Keluar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> DewiCiamis &mdash; Dinas Pariwisata Kabupaten Ciamis</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../main.js"></script>
</body>
</html>
`;

    fs.writeFileSync(targetPath, fileContent, 'utf8');
    generatedCount++;
    console.log(`[OK] (${generatedCount}/57) ${detailFile} -> ${namaDesaDisplay} (${kecamatan}) [${destinasiList.map(x => x.nama).join(', ')}]`);
}

console.log(`\n=== SUKSES: Selesai men-generate ${generatedCount} file detail desa wisata 100% sinkron dengan destinasi.js! ===`);
