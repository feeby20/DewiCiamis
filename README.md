# DewiCiamis - Sistem Informasi & Reservasi Desa Wisata (Laravel 10 Edition)

Website resmi sistem informasi dan reservasi tiket masuk desa wisata Kabupaten Ciamis yang dimigrasikan dari PHP Native ke framework **Laravel 10** dengan arsitektur MVC.

---

## 🚀 Cara Menjalankan Proyek

### Cara 1: Menggunakan XAMPP Apache Langsung
Pastikan service Apache dan MySQL di XAMPP Control Panel sudah berjalan (**Start**). Buka browser di alamat:
```
http://localhost/Web2-Laravel/public
```

### Cara 2: Menggunakan Built-in Server Laravel (Artisan)
Buka terminal / Command Prompt di folder ini, lalu jalankan:
```bash
php artisan serve
```
Buka browser di:
```
http://127.0.0.1:8000
```

---

## 🔐 Kredensial Login

### 1. Akun Pengunjung / Pengguna
Akun yang ada pada database `db_dispar` (tabel `users`) dapat langsung digunakan login tanpa perlu mendaftar ulang karena enkripsi password menggunakan Bcrypt standar:
- **Email:** `raissalman414@gmail.com`
- **Email:** `fbyyuliaa@gmail.com`
- **Email:** `megachan4141@gmail.com`
- **Email:** `rickyamba123@gmail.com`
- **Email:** `raissalman67@gmail.com`
- **Email:** `rahmaendar21@gmail.com`

Pengunjung baru juga bisa mendaftar akun melalui modal **Daftar** di navbar.

### 2. Akun Administrator
- **URL Login Admin:** `http://localhost/Web2-Laravel/public/admin/login` (atau `http://127.0.0.1:8000/admin/login`)
- **Email:** `admin@disparciamis.com`
- Akun ini terhubung ke tabel `admins` pada database `db_dispar`.

---

## 🗺️ Peta Rute & Fitur (Arsitektur MVC)

| Rute URL | Controller & Method | Deskripsi Fitur |
| :--- | :--- | :--- |
| `/` | `HomeController@index` | Halaman beranda (Hero, Profil Dispar, Kategori Wisata, Destinasi Unggulan, Kabar Berita). |
| `/destinasi` | `DestinationController@index` | Katalog 57 Desa Wisata Ciamis lengkap dengan filter pencarian, filter kecamatan, filter status (Berkembang/Rintisan), serta mode tampilan kartu & list. |
| `/destinasi/{slug}` | `DestinationController@show` | Detail desa wisata, tarif tiket masuk resmi, serta ulasan dan rating pengunjung. |
| `/berita` | `NewsController@index` | Daftar publikasi kabar dan agenda wisata Kabupaten Ciamis. |
| `/berita/{id}` | `NewsController@show` | Baca artikel berita lengkap dan berita terkait. |
| `/pemesanan` | `OrderController@index` | Halaman utama tiket & riwayat transaksi tiket user yang login. |
| `/pemesanan/buat` | `OrderController@create` | Formulir reservasi tiket dengan kalkulator harga otomatis. |
| `/pembayaran` | `OrderController@payment` | Instruksi pembayaran transfer QRIS dan form unggah bukti transfer. |
| `/tiket/{booking}` | `OrderController@ticket` | Tampilan E-Ticket resmi yang siap dicetak atau disimpan sebagai PDF. |
| `/tiket-saya` | `OrderController@myTickets` | Daftar semua tiket aktif milik user yang sudah berstatus **Lunas**. |
| `/bantuan` | `SupportController@index` | Pusat bantuan FAQ akordion dan formulir pengaduan dengan kode tiket pelacakan. |
| `/akun-saya` | `ProfileController@index` | Dashboard profil pengguna, statistik pemesanan, dan form ganti kata sandi. |
| `/admin` | `Admin\DashboardController@index` | Dashboard statistik total transaksi, tiket terjual, omset penjualan, dan antrean verifikasi. |
| `/admin/verifikasi` | `Admin\OrderController@verifikasi` | Verifikasi cepat bukti pembayaran (Terima Lunas / Tolak). |
| `/admin/orders` | `Admin\OrderController@index` | Manajemen semua pesanan, filter per destinasi, dan pencarian. |
| `/admin/berita` | `Admin\NewsController@index` | CRUD manajemen berita & pengunggahan gambar artikel. |
| `/admin/bantuan` | `Admin\SupportController@index` | Manajemen pesan pengaduan pengunjung & fitur kirim balasan admin. |
| `/admin/profile` | `Admin\ProfileController@index` | Pengaturan profil dan kata sandi administrator. |

---

## 📂 Struktur Folder Proyek
```
c:\xampp\htdocs\Web2-Laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── NewsController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── ProfileController.php
│   │   │   │   └── SupportController.php
│   │   │   ├── AuthController.php
│   │   │   ├── DestinationController.php
│   │   │   ├── HomeController.php
│   │   │   ├── NewsController.php
│   │   │   ├── OrderController.php
│   │   │   ├── ProfileController.php
│   │   │   └── SupportController.php
│   ├── Models/
│   │   ├── Admin.php
│   │   ├── Berita.php
│   │   ├── DestinationPrice.php
│   │   ├── DestinationReview.php
│   │   ├── Order.php
│   │   ├── SupportFaq.php
│   │   ├── SupportMessage.php
│   │   └── User.php
├── config/
│   ├── auth.php (Konfigurasi Multi-Guard: web & admin)
│   └── database.php
├── public/
│   ├── css/ (beranda.css, destinasi.css, style.css, dll.)
│   ├── js/ (destinasi.js, pemesanan.js, dll.)
│   ├── pictures/ (Logo, foto destinasi, QRIS)
│   ├── uploads/ (bukti-pembayaran, berita)
│   └── main.js
├── resources/
│   └── views/
│       ├── admin/
│       ├── akun/
│       ├── auth/
│       ├── bantuan/
│       ├── berita/
│       ├── destinasi/
│       ├── layouts/
│       │   ├── admin.blade.php
│       │   └── app.blade.php
│       └── pemesanan/
├── routes/
│   └── web.php (75 rute terorganisir)
└── .env (Konfigurasi database db_dispar & APP_URL)
```
