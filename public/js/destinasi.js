/* =========================================================
   DATA DESA WISATA & KELOMPOK DESTINASI KABUPATEN CIAMIS
   Berdasarkan Surat Keputusan (SK) Data Desa Wisata 2020 - 2023
   Setiap desa wisata memiliki kelompok potensi destinasi wisata
   dengan deskripsi spesifik dan fasilitas lengkap per destinasi.
========================================================= */

const desaWisataData = [
  {
    "id": 1,
    "desa": "Kawali",
    "kecamatan": "Kawali",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/AstanaGedeKawali.jpeg",
    "detail": "detail/kawali.php",
    "destinasi": [
      {
        "nama": "Astana Gede Kawali",
        "deskripsi": "Kawasan cagar budaya peninggalan Kerajaan Sunda Galuh yang sarat prasasti kuno, batu tapak, makam bersejarah, dan rimbunnya hutan lindung sakral.",
        "fasilitas": [
          "Area Parkir",
          "Toilet & Tempat Wudhu",
          "Pemandu Wisata",
          "Spot Foto Sejarah",
          "Pusat Informasi & Gazebo"
        ]
      }
    ],
    "deskripsi": "Kawasan cagar budaya peninggalan Kerajaan Sunda Galuh yang sarat nilai sejarah dan prasasti kuno."
  },
  {
    "id": 2,
    "desa": "Winduraja",
    "kecamatan": "Kawali",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Berkembang",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/WinduRaja.jpeg",
    "detail": "detail/situwangi.php",
    "destinasi": [
      {
        "nama": "Situ Wangi",
        "deskripsi": "Danau alami nan asri dengan udara sejuk pegunungan, jalur jogging keliling danau, serta wahana perahu air keluarga.",
        "fasilitas": [
          "Wahana Perahu Bebek",
          "Dermaga Spot Foto",
          "Area Parkir",
          "Warung Kuliner",
          "Toilet & Mushola"
        ]
      }
    ],
    "deskripsi": "Danau alami dengan panorama asri, udara sejuk, dan fasilitas wisata air yang ramah keluarga."
  },
  {
    "id": 3,
    "desa": "Talagasari",
    "kecamatan": "Kawali",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/KampungSawah.jpeg",
    "detail": "detail/talagasari.php",
    "destinasi": [
      {
        "nama": "Kampung Sawah",
        "deskripsi": "Destinasi wisata buatan dengan panorama bentangan persawahan hijau, jembatan kayu estetik, gazebo santai, dan kuliner khas sunda.",
        "fasilitas": [
          "Gazebo Tengah Sawah",
          "Jembatan Bambu Selfie",
          "Resto Masakan Sunda",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Destinasi wisata buatan dengan panorama persawahan asri, gazebo tradisional, dan spot foto pedesaan."
  },
  {
    "id": 4,
    "desa": "Sidamulih",
    "kecamatan": "Pamarican",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PasirJatiGrownHill.jpeg",
    "detail": "detail/sidamulih.php",
    "destinasi": [
      {
        "nama": "Pasir Jati Grown Hill",
        "deskripsi": "Puncak perbukitan hijau dengan gardu pandang 360 derajat ke lembah Pamarican, sangat cocok untuk berswafoto dan menikmati sunset.",
        "fasilitas": [
          "Gardu Pandang",
          "Spot Foto Sayap & Ayunan",
          "Warung Kopi",
          "Toilet",
          "Parkir Kendaraan"
        ]
      }
    ],
    "deskripsi": "Kawasan perbukitan dengan pemandangan terbuka dan spot swafoto berlatar panorama alam pedesaan."
  },
  {
    "id": 5,
    "desa": "Mekarsari",
    "kecamatan": "Tambaksari",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PuncakMaralaya.jpeg",
    "detail": "detail/mekarsari.php",
    "destinasi": [
      {
        "nama": "Puncak Meralaya",
        "deskripsi": "Wisata alam perbukitan dengan pesona lembah hijau berpadu terasering persawahan dan panorama sunrise spektakuler.",
        "fasilitas": [
          "Area Camping Ground",
          "Gazebo Pandang",
          "Spot Foto Alam",
          "Toilet",
          "Warung Makanan"
        ]
      }
    ],
    "deskripsi": "Wisata alam perbukitan dengan pemandangan lanskap lembah, persawahan terasering, dan udara segar."
  },
  {
    "id": 6,
    "desa": "Ciakar",
    "kecamatan": "Cipaku",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/murbey.jpeg",
    "detail": "detail/ciklar.php",
    "destinasi": [
      {
        "nama": "Wisata Murbey",
        "deskripsi": "Kawasan agrowisata edukasi budidaya pohon murbei terpadu, peternakan ulat sutera, petik buah murbei segar, dan olahan sirup herbal.",
        "fasilitas": [
          "Kebun Petik Murbei",
          "Pusat Edukasi Sutera",
          "Toko Oleh-oleh Olahan",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Kawasan agrowisata budidaya pohon murbei terpadu dengan edukasi ulat sutera dan olahan buah murbei."
  },
  {
    "id": 7,
    "desa": "Cintanagara",
    "kecamatan": "Jatinagara",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/CintaNagara.webp",
    "detail": "detail/cintanagara.php",
    "destinasi": [
      {
        "nama": "Wisata Alam",
        "deskripsi": "Menyuguhkan keindahan alam pedesaan berhawa sejuk dengan panorama perbukitan hijau dan gemericik air alami.",
        "fasilitas": [
          "Jalur Trekking",
          "Spot Foto Alam",
          "Area Parkir",
          "Toilet",
          "Warung"
        ]
      },
      {
        "nama": "Agrowisata",
        "deskripsi": "Lahan perkebunan holtikultura dan buah-buahan lokal yang asri, menawarkan pengalaman memetik hasil kebun langsung bersama petani.",
        "fasilitas": [
          "Kebun Buah Edukasi",
          "Gazebo Istirahat",
          "Toilet",
          "Pusat Bibit Tanaman"
        ]
      },
      {
        "nama": "Jalan Usaha Tani",
        "deskripsi": "Jalur lintasan asri menembus hamparan sawah dan kebun yang cocok untuk bersepeda pagi dan jalan santai pedesaan.",
        "fasilitas": [
          "Jalur Sepeda & Jogging",
          "Spot Foto Sunrise",
          "Bangku Istirahat",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Menghadirkan perpaduan pesona wisata alam pedesaan, perkebunan agrowisata, dan panorama jalan usaha tani."
  },
  {
    "id": 8,
    "desa": "Karangkamulyan",
    "kecamatan": "Cijeungjing",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/Karangkamulyan.jpeg",
    "detail": "detail/karangkamulyan.php",
    "destinasi": [
      {
        "nama": "Situs Karangkamulyan",
        "deskripsi": "Situs arkeologi cagar budaya Kerajaan Galuh legendaris Ciung Wanara di tengah hutan lindung alami dengan aneka peninggalan batu megalitikum.",
        "fasilitas": [
          "Pemandu Sejarah",
          "Museum Cagar Budaya",
          "Area Parkir Luas",
          "Warung & Souvenir",
          "Toilet & Mushola"
        ]
      }
    ],
    "deskripsi": "Kawasan cagar budaya arkeologi Kerajaan Galuh legendaris Ciung Wanara di tengah hutan lindung asri."
  },
  {
    "id": 9,
    "desa": "Bangunharja",
    "kecamatan": "Cisaga",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Berkembang",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PuncakManik.jpeg",
    "detail": "detail/bangunharja.php",
    "destinasi": [
      {
        "nama": "Puncak Manik",
        "deskripsi": "Destinasi perbukitan tinggi di Cisaga dengan panorama lembah sungai Citanduy, gardu pandang alam, dan udara bersih nan menyegarkan.",
        "fasilitas": [
          "Gardu Pandang Manik",
          "Spot Foto Instagramable",
          "Camping Area",
          "Toilet",
          "Warung Kopi"
        ]
      }
    ],
    "deskripsi": "Kawasan perbukitan tinggi yang menjadi tempat favorit bersantai menikmati sunrise dan lembah Cisaga."
  },
  {
    "id": 10,
    "desa": "Cisontrol",
    "kecamatan": "Rancah",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Berkembang",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/WisataEdukasiAnakCisontol.jpeg",
    "detail": "detail/cisontrol.php",
    "destinasi": [
      {
        "nama": "Wisata Edukasi Anak",
        "deskripsi": "Taman bermain edukatif ruang terbuka yang dilengkapi wahana interaktif ramah anak, kolam air, dan area pengenalan satwa ternak.",
        "fasilitas": [
          "Wahana Bermain Anak",
          "Kolam Air Anak",
          "Gazebo Keluarga",
          "Kantin Ramah Anak",
          "Toilet Bersih"
        ]
      }
    ],
    "deskripsi": "Taman rekreasi dan edukasi terpadu untuk anak-anak sekolah dengan konsep belajar sambil bermain di alam terbuka."
  },
  {
    "id": 11,
    "desa": "Situmandala",
    "kecamatan": "Rancah",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PuncakBangku.jpeg",
    "detail": "detail/situmandala.php",
    "destinasi": [
      {
        "nama": "Puncak Bangku",
        "deskripsi": "Dikenal sebagai 'Negeri di Atas Awan' Ciamis, menawarkan pemandangan lautan kabut pagi tebal membentang di atas lembah Rancah.",
        "fasilitas": [
          "Gardu Pandang Awan",
          "Spot Foto Estetik",
          "Kedai Kopi & Teh",
          "Area Parkir",
          "Toilet"
        ]
      },
      {
        "nama": "Puncak Pispun",
        "deskripsi": "Kawasan perbukitan tenang dengan panorama perladangan hijau dan spot foto panorama pedesaan terbuka.",
        "fasilitas": [
          "Area Santai",
          "Spot Foto Lanskap",
          "Toilet",
          "Tempat Duduk Gazebo"
        ]
      }
    ],
    "deskripsi": "Terkenal dengan fenomena lautan kabut 'Negeri di Atas Awan' di Puncak Bangku serta panorama Puncak Pispun."
  },
  {
    "id": 12,
    "desa": "Wanasigra",
    "kecamatan": "Sindangkasih",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/Gandongan.webp",
    "detail": "detail/wanasigra.php",
    "destinasi": [
      {
        "nama": "Situs Gandoang",
        "deskripsi": "Situs cagar budaya keramat peninggalan leluhur dengan tradisi upacara Merlawu, batu pangcalikan, dan sumber mata air jernih.",
        "fasilitas": [
          "Area Upacara Adat",
          "Bale Tradisional",
          "Pemandu Budaya",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Cagar budaya situs keramat Gandoang yang sarat tradisi budaya leluhur Merlawu dan kearifan lokal Sunda."
  },
  {
    "id": 13,
    "desa": "Sukahurip",
    "kecamatan": "Cihaurbeuti",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/CurugSalosin.jpeg",
    "detail": "detail/sukahurip.php",
    "destinasi": [
      {
        "nama": "Curug Salosin",
        "deskripsi": "Air terjun alami bertingkat di lereng Gunung Sawal dengan kolam alami berair jernih pegunungan yang sangat menyegarkan.",
        "fasilitas": [
          "Jalur Trekking Alam",
          "Kolam Pemandian Alami",
          "Saung Istirahat",
          "Warung",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Keindahan air terjun bertingkat Curug Salosin di kawasan lereng Gunung Sawal dengan suasana asri menyegarkan."
  },
  {
    "id": 14,
    "desa": "Sumberjaya",
    "kecamatan": "Cihaurbeuti",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/BumiPekemahan.jpeg",
    "detail": "detail/sumberjaya.php",
    "destinasi": [
      {
        "nama": "Taman Wisata",
        "deskripsi": "Taman rekreasi hijau keluarga dengan kolam santai, rimbun pepohonan buah, dan spot foto warna-warni.",
        "fasilitas": [
          "Taman Bunga & Spot Foto",
          "Gazebo Keluarga",
          "Area Parkir",
          "Toilet",
          "Kantin"
        ]
      },
      {
        "nama": "Bumi Perkemahan",
        "deskripsi": "Area perkemahan luas di bawah naungan pohon pinus dengan fasilitas outbound dan api unggun yang aman.",
        "fasilitas": [
          "Lapangan Camping Luas",
          "Sumber Air Bersih",
          "Toilet & Mushola",
          "Penyewaan Tenda"
        ]
      }
    ],
    "deskripsi": "Fasilitas taman rekreasi keluarga yang dilengkapi area bumi perkemahan alam terbuka nan rindang dan luas."
  },
  {
    "id": 15,
    "desa": "Ciomas",
    "kecamatan": "Panjalu",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/ParalayangBukitPangangonan.jpeg",
    "detail": "detail/aomas.php",
    "destinasi": [
      {
        "nama": "Paralayang",
        "deskripsi": "Spot landasan terbang paralayang dan gantole di Panawangan dengan pemandangan bentang alam perbukitan Ciamis utara yang spektakuler.",
        "fasilitas": [
          "Take-Off Deck",
          "Instruktur Tandem Berlisensi",
          "Spot Selfie Sunset",
          "Kantin",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Lokasi wisata olahraga terbang paralayang dari ketinggian bukit dengan latar panorama lembah Ciamis."
  },
  {
    "id": 16,
    "desa": "Panjalu",
    "kecamatan": "Panjalu",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Berkembang",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/SituLengkongPanjalu.jpeg",
    "detail": "detail/panjalu.php",
    "destinasi": [
      {
        "nama": "Situ Lengkong Panjalu",
        "deskripsi": "Danau wisata alam dan religi seluas 57 hektar dengan pulau Nusa Gede di tengahnya yang menyimpan makam Prabu Hariang Kancana.",
        "fasilitas": [
          "Perahu Wisata Keliling Nusa",
          "Ziarah Religi Nusa Gede",
          "Pasar Oleh-oleh & Souvenir",
          "Parkir Bus & Mobil",
          "Restoran Lesehan"
        ]
      }
    ],
    "deskripsi": "Danau legendaris Situ Lengkong dengan pulau Nusa Larang di tengahnya yang menjadi pusat wisata religi dan alam."
  },
  {
    "id": 17,
    "desa": "Cikupa",
    "kecamatan": "Banjaranyar",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/PemandianAirPanas.webp",
    "detail": "detail/cikupa.php",
    "destinasi": [
      {
        "nama": "Pemandian Air Panas",
        "deskripsi": "Sumber mata air panas alami dengan kandungan mineral belerang berkhasiat terapi kesehatan diapit suasana pegunungan asri.",
        "fasilitas": [
          "Kolam Rendam Air Panas",
          "Kamar Mandi Terapi Privat",
          "Kamar Ganti & Bilas",
          "Kantin Makanan",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Kawasan pemandian air panas alami berkhasiat terapi kesehatan dengan nuansa alam pedesaan yang sejuk."
  },
  {
    "id": 18,
    "desa": "Banjaranyar",
    "kecamatan": "Banjaranyar",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Berkembang",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/KampungMadu.jpeg",
    "detail": "detail/banjayanyar.php",
    "destinasi": [
      {
        "nama": "Kampung Madu",
        "deskripsi": "Sentra budidaya lebah madu klanceng dan trigona alami, edukasi mencicip madu langsung dari sarang, serta kebun bunga nektar.",
        "fasilitas": [
          "Pusat Edukasi Peternakan Lebah",
          "Tasting Madu Murni",
          "Gerai Produk Madu Asli",
          "Spot Selfie Kebun Bunga",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Sentra edukasi budidaya lebah madu klanceng (trigona) terpadu dengan petik madu langsung dari sarang lebah."
  },
  {
    "id": 19,
    "desa": "Karangpaningal",
    "kecamatan": "Tambaksari",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/KampungKuta.jpeg",
    "detail": "detail/karangpaningal.php",
    "destinasi": [
      {
        "nama": "Kampung Kuta",
        "deskripsi": "Desa adat tradisional Sunda dengan rumah panggung beratap ijuk rumbia, hutan larangan sakral, dan aturan adat hidup selaras alam.",
        "fasilitas": [
          "Homestay Rumah Adat",
          "Pemandu Adat Kuta",
          "Kerajinan Bambu Tradisional",
          "Bale Sawala Pertemuan",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Kampung adat tradisional Sunda dengan rumah panggung beratap ijuk dan kearifan menjaga hutan keramat."
  },
  {
    "id": 20,
    "desa": "Baregbeg",
    "kecamatan": "Lakbok",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/LayangLakbok.jpeg",
    "detail": "detail/baregbeg.php",
    "destinasi": [
      {
        "nama": "Layang Lakbok",
        "deskripsi": "Kawasan wisata alam persawahan terpadu Lakbok yang terkenal dengan festival layang-layang tradisional dan agro-kuliner sawah.",
        "fasilitas": [
          "Area Terbuka Layang-layang",
          "Jembatan Sawah",
          "Gazebo Lesehan",
          "Kantin Kuliner Khas",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Wisata alam persawahan terhampar luas Lakbok yang terkenal sebagai arena festival layang-layang tradisional."
  },
  {
    "id": 21,
    "desa": "Cibeureum",
    "kecamatan": "Sukamantri",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/SituCibubuhan.webp",
    "detail": "detail/cibereum.php",
    "destinasi": [
      {
        "nama": "Situ Cibubuhan",
        "deskripsi": "Situ alami pegunungan di Sukamantri dengan hawa sejuk, spot memancing tenang, dan latar lanskap perbukitan hijau perawan.",
        "fasilitas": [
          "Spot Mancing Ikan",
          "Jalur Mengitari Situ",
          "Saung Santai",
          "Toilet",
          "Warung Kopi"
        ]
      }
    ],
    "deskripsi": "Danau alami Situ Cibubuhan yang tenang di dataran tinggi berudara sejuk dengan pemandangan pinus asri."
  },
  {
    "id": 22,
    "desa": "Gunungsari",
    "kecamatan": "Sadananya",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/CadasNgampar.webp",
    "detail": "detail/gunungsari.php",
    "destinasi": [
      {
        "nama": "Cadas Ngampar",
        "deskripsi": "Destinasi wisata alam sungai jernih berhulu Gunung Sawal dengan bebatuan cadas eksotis yang bertingkat dan air dingin menyegarkan.",
        "fasilitas": [
          "Wahana River Tubing",
          "Pemandian Sungai Alami",
          "Saung Bambu Pinggir Sungai",
          "Kamar Bilas & Toilet",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Wisata rekreasi sungai Cadas Ngampar dengan aliran air pegunungan jernih dan formasi batuan datar alami."
  },
  {
    "id": 23,
    "desa": "Kawasen",
    "kecamatan": "Banjarsari",
    "sk": "446/Kpts.232-Huk/2020",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/TonjongGolok.jpeg",
    "detail": "detail/kawasen.php",
    "destinasi": [
      {
        "nama": "Tonjong Golok",
        "deskripsi": "Objek wisata aliran sungai jernih bertebing batu eksotis yang menawan di Banjarsari, cocok untuk berenang dan bermain air.",
        "fasilitas": [
          "Area Berenang Alami",
          "Penyewaan Ban Pelampung",
          "Warung Makanan",
          "Toilet",
          "Parkir Kendaraan"
        ]
      }
    ],
    "deskripsi": "Spot keindahan aliran sungai alami dengan bebatuan eksotis dan kolam alami yang jernih dan menyegarkan."
  },
  {
    "id": 24,
    "desa": "Sagalaherang",
    "kecamatan": "Panawangan",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/ParalayangPanawangan.webp",
    "detail": "detail/sagalaherang.php",
    "destinasi": [
      {
        "nama": "Paralayang",
        "deskripsi": "Spot landasan terbang paralayang dan gantole di Panawangan dengan pemandangan bentang alam perbukitan Ciamis utara yang spektakuler.",
        "fasilitas": [
          "Take-Off Deck",
          "Instruktur Tandem Berlisensi",
          "Spot Selfie Sunset",
          "Kantin",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Wisata olahraga paralayang di ketinggian bukit Panawangan dengan sensasi terbang melintasi lanskap hijau."
  },
  {
    "id": 25,
    "desa": "Kertajaya",
    "kecamatan": "Panawangan",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PuncakKartajaya.jpeg",
    "detail": "detail/kertajaya.php",
    "destinasi": [
      {
        "nama": "Puncak Kertajaya",
        "deskripsi": "Puncak perbukitan tinggi yang menyajikan pemandangan lanskap pegunungan terbuka, sejuk untuk melepas penat dan bersantai keluarga.",
        "fasilitas": [
          "Menara Pandang",
          "Spot Foto Kayu",
          "Warung Minuman & Makanan",
          "Toilet",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Puncak bukit pandang dengan panorama bentangan alam pegunungan yang memukau dan udara segar menyejukkan."
  },
  {
    "id": 26,
    "desa": "Raksabaya",
    "kecamatan": "Cimaragas",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/KampungTeratai.jpeg",
    "detail": "detail/raksabaya.php",
    "destinasi": [
      {
        "nama": "Kampung Teratai",
        "deskripsi": "Kawasan ekowisata danau rawa dengan hamparan bunga teratai mekar nan indah, jembatan kayu terapung, dan kebun bunga.",
        "fasilitas": [
          "Jembatan Apung Danau Teratai",
          "Spot Foto Perahu Bunga",
          "Gazebo Tepi Kolam",
          "Warung Kuliner",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Kawasan wisata danau teratai mekar alami dengan jembatan kayu estetik dan spot bersantai di tepi perairan."
  },
  {
    "id": 27,
    "desa": "Pusakasari",
    "kecamatan": "Cipaku",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/AgroCipaku.webp",
    "detail": "detail/pukasari.php",
    "destinasi": [
      {
        "nama": "Agro Wisata",
        "deskripsi": "Kawasan agrowisata perkebunan holtikultura, sayuran organik, dan buah-buahan lokal dengan paket edukasi pertanian modern.",
        "fasilitas": [
          "Kebun Edukasi Pertanian",
          "Pusat Penjualan Buah Segar",
          "Saung Tani",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Kawasan terpadu agrowisata budidaya perkebunan buah dan tanaman pedesaan berhawa sejuk."
  },
  {
    "id": 28,
    "desa": "Sadewata",
    "kecamatan": "Lumbung",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/SiituHiang.jpeg",
    "detail": "detail/sadeweata.php",
    "destinasi": [
      {
        "nama": "Situ Hiang",
        "deskripsi": "Danau purba tersembunyi yang tenang di Lumbung dengan pepohonan rindang dan udara segar alami khas pedesaan.",
        "fasilitas": [
          "Jalur Menikmati Danau",
          "Spot Pemancingan",
          "Saung Tradisional",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Danau alami Situ Hiang yang tenang dikelilingi pepohonan asri dan sarat sejarah cerita rakyat setempat."
  },
  {
    "id": 29,
    "desa": "Cimari",
    "kecamatan": "Cikoneng",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/SituRancabala.jpeg",
    "detail": "detail/cimari.php",
    "destinasi": [
      {
        "nama": "Situ Rancabala",
        "deskripsi": "Destinasi danau buatan dan alami dengan pemandangan air yang teduh, cocok untuk bersantai sore dan memancing bersama keluarga.",
        "fasilitas": [
          "Dermaga Mini",
          "Area Memancing Santai",
          "Warung Makanan Ringan",
          "Toilet",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Danau resapan alami Situ Rancabala di lereng Gunung Sawal dengan panorama perairan dan pepohonan hijau."
  },
  {
    "id": 30,
    "desa": "Sukajaya",
    "kecamatan": "Rajadesa",
    "sk": "143/Kpts.303-Huk/2021",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PuncakUpsa.jpeg",
    "detail": "detail/sukajaya.php",
    "destinasi": [
      {
        "nama": "Puncak Upsa Rahong",
        "deskripsi": "Puncak bukit panorama alam dengan udara sejuk pegunungan Rajadesa yang memanjakan mata dengan pemandangan hamparan lembah luas.",
        "fasilitas": [
          "Gardu Pandang Kayu",
          "Spot Foto Ayunan Langit",
          "Kedai Kopi Lereng",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Destinasi perbukitan Puncak Upsa Rahong dengan spot foto gardu pandang menghadap lembah Rajadesa."
  },
  {
    "id": 31,
    "desa": "Jalatrang",
    "kecamatan": "Cipaku",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Berkembang",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/KampungBangur.jpeg",
    "detail": "detail/jalatrang.php",
    "destinasi": [
      {
        "nama": "Kampung Bungur",
        "deskripsi": "Wisata buatan ramah keluarga dengan konsep kampung taman bunga warna-warni, kolam renang anak, dan spot foto kreatif.",
        "fasilitas": [
          "Kolam Renang Anak & Keluarga",
          "Taman Bunga Warna-Warni",
          "Saung Gazebo Lesehan",
          "Kantin Makanan",
          "Toilet & Mushola"
        ]
      }
    ],
    "deskripsi": "Objek wisata keluarga Kampung Bungur dengan fasilitas kolam renang terbuka di kelilingi lanskap sawah asri."
  },
  {
    "id": 32,
    "desa": "Rajadesa",
    "kecamatan": "Rajadesa",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Berkembang",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/BukitSamida.webp",
    "detail": "detail/rajadesa.php",
    "destinasi": [
      {
        "nama": "Samida",
        "deskripsi": "Hutan lindung cagar budaya bersejarah peninggalan Kerajaan Rajadesa dengan aneka pohon purba berusia ratusan tahun.",
        "fasilitas": [
          "Jalur Jalur Setapak Rindang",
          "Pemandu Sejarah",
          "Bale Istirahat",
          "Toilet",
          "Parkir"
        ]
      },
      {
        "nama": "Situs Gunung Marapi",
        "deskripsi": "Situs bersejarah di atas perbukitan Rajadesa yang sarat legenda lokal dan menawarkan pemandangan bukit asri.",
        "fasilitas": [
          "Jalur Tangga Cagar Budaya",
          "Spot Pandang Bukit",
          "Saung Santai",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Kawasan wisata sejarah dan budaya yang memadukan keindahan Bukit Samida serta petilasan Situs Gunung Marapi."
  },
  {
    "id": 33,
    "desa": "Sukamaju",
    "kecamatan": "Cihaurbeuti",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Berkembang",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/BukitSemparanAsli.jpeg",
    "detail": "detail/sukamaju.php",
    "destinasi": [
      {
        "nama": "Bukit Sempalan Asri",
        "deskripsi": "Kawasan perbukitan dengan padang rumput hijau asri dan sudut pandang lanskap perkampungan Ciamis dari ketinggian.",
        "fasilitas": [
          "Gardu Pandang Alam",
          "Area Camping Bukit",
          "Warung Kopi",
          "Toilet",
          "Parkir Motor & Mobil"
        ]
      },
      {
        "nama": "Lobang Timah",
        "deskripsi": "Situs peninggalan galian pertambangan timah masa lalu yang kini dikembangkan menjadi wisata edukasi sejarah geologi.",
        "fasilitas": [
          "Jalur Lorong Wisata Edukasi",
          "Pemandu Lokal",
          "Spot Foto Sejarah",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Kombinasi keindahan panorama Bukit Sempalan Asri dan daya tarik sejarah geologi peninggalan Lobang Timah."
  },
  {
    "id": 34,
    "desa": "Selamanik",
    "kecamatan": "Cipaku",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Berkembang",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/selamanik.jpeg",
    "detail": "detail/selamanik.php",
    "destinasi": [
      {
        "nama": "Homestay",
        "deskripsi": "Penginapan rumah warga ramah lingkungan bergaya arsitektur Sunda dengan pelayanan hangat dan sajian masakan tradisional.",
        "fasilitas": [
          "Kamar Tidur Nyaman",
          "Kamar Mandi Bersih",
          "Wifi Gratis",
          "Sarapan Khas Sunda",
          "Parkir"
        ]
      },
      {
        "nama": "Agrowisata",
        "deskripsi": "Lahan perkebunan holtikultura dan buah-buahan lokal yang asri, menawarkan pengalaman memetik hasil kebun langsung bersama petani.",
        "fasilitas": [
          "Kebun Buah Edukasi",
          "Gazebo Istirahat",
          "Toilet",
          "Pusat Bibit Tanaman"
        ]
      }
    ],
    "deskripsi": "Pengalaman menginap di homestay pedesaan yang hangat dipadu agrowisata perikanan dan perkebunan terpadu."
  },
  {
    "id": 35,
    "desa": "Sukaresik",
    "kecamatan": "Sindangkasih",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/SungaiCireong.jpeg",
    "detail": "detail/sukaresik.php",
    "destinasi": [
      {
        "nama": "Sungai Cireong",
        "deskripsi": "Sungai alami berarus tenang dengan air jernih dingin dari mata air pegunungan diapit rindangnya rumpun bambu.",
        "fasilitas": [
          "Pemandian Alami Bebatuan",
          "Sewa Pelampung & Ban",
          "Warung Nasi Liwet Pinggir Sungai",
          "Kamar Bilas",
          "Toilet"
        ]
      },
      {
        "nama": "Situs Gunung Padang",
        "deskripsi": "Kawasan cagar budaya perbukitan bebatuan megalitikum bersejarah yang sarat misteri peradaban kuno.",
        "fasilitas": [
          "Jalur Pendakian Tangga",
          "Pemandu Sejarah Adat",
          "Bale Singgah",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Objek wisata pemandian jernih Sungai Cireong dipadukan dengan cagar budaya peninggalan Situs Gunung Padang."
  },
  {
    "id": 36,
    "desa": "Darmacaang",
    "kecamatan": "Cikoneng",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/PinusBatuCakra.jpeg",
    "detail": "detail/darmacaang.php",
    "destinasi": [
      {
        "nama": "Hutan Pinus Batu Cakra",
        "deskripsi": "Ekowisata hutan pinus asri di lereng Gunung Sawal dengan formasi batu cakra unik, sejuk untuk hammock-an dan camping keluarga.",
        "fasilitas": [
          "Area Hammock Rimbun",
          "Bumi Perkemahan Pinus",
          "Warung Kopi Hutan",
          "Toilet Bersih",
          "Parkir Luas"
        ]
      }
    ],
    "deskripsi": "Hutan pinus asri di kaki Gunung Sawal dengan formasi batu cakra unik, area berkemah, dan udara segar."
  },
  {
    "id": 37,
    "desa": "Kaso",
    "kecamatan": "Tambaksari",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/Ciawade.jpeg",
    "detail": "detail/kaso.php",
    "destinasi": [
      {
        "nama": "Embung Ciwaleud",
        "deskripsi": "Danau penampung air alami yang disulap menjadi taman air wisata dengan perahu kayuh dan pemandangan perbukitan asri.",
        "fasilitas": [
          "Wahana Perahu Air",
          "Taman Tepi Embung",
          "Spot Foto Dermaga",
          "Toilet",
          "Warung"
        ]
      },
      {
        "nama": "Seni Budaya Mekar Arum",
        "deskripsi": "Pusat pelestarian kesenian tari tradisional, karawitan, dan calung Sunda dengan panggung pentas seni rakyat.",
        "fasilitas": [
          "Panggung Terbuka Seni",
          "Workshop Alat Musik Tradisional",
          "Bale Sanggar Seni",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Wisata air dan konservasi Embung Ciwaleud berpadu pementasan kesenian tradisi budaya Sunda Mekar Arum."
  },
  {
    "id": 38,
    "desa": "Bahara",
    "kecamatan": "Panjalu",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/Cipanjalu.jpeg",
    "detail": "detail/bahara.php",
    "destinasi": [
      {
        "nama": "Situs Opanjalu",
        "deskripsi": "Kawasan cagar budaya ziarah leluhur Panjalu dengan suasana hutan keramat yang asri, tenang, dan terjaga kelestariannya.",
        "fasilitas": [
          "Pemandu Sejarah Ziarah",
          "Bale Pasarean",
          "Toilet & Mushola",
          "Tempat Wudhu",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Cagar budaya petilasan leluhur Situs Opanjalu yang sakral di tengah rimbunnya hutan lindung Panjalu."
  },
  {
    "id": 39,
    "desa": "Sukadana",
    "kecamatan": "Sukadana",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/RumahBintang.jpeg",
    "detail": "detail/sukadana.php",
    "destinasi": [
      {
        "nama": "Agrowisata",
        "deskripsi": "Lahan perkebunan holtikultura dan buah-buahan lokal yang asri, menawarkan pengalaman memetik hasil kebun langsung bersama petani.",
        "fasilitas": [
          "Kebun Buah Edukasi",
          "Gazebo Istirahat",
          "Toilet",
          "Pusat Bibit Tanaman"
        ]
      },
      {
        "nama": "Cagar Budaya Rumah Bintang",
        "deskripsi": "Bangunan arsitektur peninggalan kolonial antik bermotif bintang yang memiliki nilai sejarah masa lampau.",
        "fasilitas": [
          "Pemandu Sejarah Bangunan",
          "Spot Foto Vintage",
          "Bale Informasi",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Sentra agrowisata perkebunan yang berdampingan dengan cagar budaya peninggalan unik Rumah Bintang."
  },
  {
    "id": 40,
    "desa": "Cibadak",
    "kecamatan": "Banjarsari",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/PangangonanCibadak.jpeg",
    "detail": "detail/cibadak.php",
    "destinasi": [
      {
        "nama": "Agrowisata",
        "deskripsi": "Lahan perkebunan holtikultura dan buah-buahan lokal yang asri, menawarkan pengalaman memetik hasil kebun langsung bersama petani.",
        "fasilitas": [
          "Kebun Buah Edukasi",
          "Gazebo Istirahat",
          "Toilet",
          "Pusat Bibit Tanaman"
        ]
      },
      {
        "nama": "Buper dan Pangangonan",
        "deskripsi": "Bumi perkemahan luas terintegrasi dengan area penggembalaan ternak asri berlatar bukit dan persawahan.",
        "fasilitas": [
          "Area Camping Lapangan Luas",
          "Outbound Area",
          "Kran Air Bersih",
          "Toilet & Kamar Mandi"
        ]
      }
    ],
    "deskripsi": "Kawasan rekreasi perbukitan Pangangonan dengan sarana bumi perkemahan terpadu dan agrowisata kebun."
  },
  {
    "id": 41,
    "desa": "Nasol",
    "kecamatan": "Cikoneng",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/JahaBuana.jpeg",
    "detail": "detail/nasol.php",
    "destinasi": [
      {
        "nama": "Jaha Buana",
        "deskripsi": "Objek wisata alam perbukitan Cikoneng dengan panorama lembah hijau, udara sejuk, dan gardu pandang memikat.",
        "fasilitas": [
          "Gardu Pandang Alam",
          "Spot Foto Bunga",
          "Kedai Kopi Santai",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Panorama alam perbukitan Jaha Buana berhawa sejuk dengan terasering persawahan dan view Gunung Sawal."
  },
  {
    "id": 42,
    "desa": "Gunungcupu",
    "kecamatan": "Sindangkasih",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/KampungLegenda.jpeg",
    "detail": "detail/gunungcupu.php",
    "destinasi": [
      {
        "nama": "Kampung Legenda",
        "deskripsi": "Kampung wisata budaya dan edukasi sejarah yang mengangkat cerita rakyat legenda Gunung Cupu dengan replika situs dan pentas dongeng.",
        "fasilitas": [
          "Panggung Dongeng Budaya",
          "Replika Cawan Cupu Keramat",
          "Saung Kuliner Tradisional",
          "Toilet",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Destinasi wisata edukasi budaya yang mengangkat kisah legenda Cupu Manik Astagina dengan nuansa etnik."
  },
  {
    "id": 43,
    "desa": "Kadupandak",
    "kecamatan": "Tambaksari",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/CekdamKadupandak.jpeg",
    "detail": "detail/kadupandak.php",
    "destinasi": [
      {
        "nama": "Cekdam Kadupandak",
        "deskripsi": "Waduk cekdam multifungsi yang difungsikan sebagai destinasi wisata rekreasi air, memancing, dan bersantai sore di pinggir danau.",
        "fasilitas": [
          "Spot Mancing Ikan",
          "Taman Tepi Cekdam",
          "Warung Kopi & Camilan",
          "Toilet",
          "Parkir Motor"
        ]
      }
    ],
    "deskripsi": "Bendungan pengendali air cekdam yang dikelilingi perbukitan hijau, spot favorit memancing dan rekreasi santai."
  },
  {
    "id": 44,
    "desa": "Sukasenang",
    "kecamatan": "Sindangkasih",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/SituRancamayana.jpeg",
    "detail": "detail/sukasenang.php",
    "destinasi": [
      {
        "nama": "Situ Rancamaya",
        "deskripsi": "Danau alami Situ Rancamaya yang tenang dengan teratai air, gazebo terapung, dan udara segar pedesaan Sindangkasih.",
        "fasilitas": [
          "Gazebo Terapung",
          "Jalur Jogging Pinggir Situ",
          "Warung Makanan",
          "Toilet",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Keasrian danau alami Situ Rancamaya yang tenang dengan udara sejuk dinaungi rimbun pepohonan hijau."
  },
  {
    "id": 45,
    "desa": "Jagabaya",
    "kecamatan": "Panawangan",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/BukitCikulak.jpeg",
    "detail": "detail/jagabaya.php",
    "destinasi": [
      {
        "nama": "Bukit Cikulak",
        "deskripsi": "Wisata alam perbukitan tinggi di Panawangan dengan spot swafoto gardu kayu berlatar pemandangan spektakuler perbukitan Ciamis timur.",
        "fasilitas": [
          "Gardu Pandang Kayu",
          "Spot Foto Sayap",
          "Warung Kopi Bukit",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Bukit Cikulak dengan panorama bentang alam terbuka yang memesona untuk menikmati fajar pagi dan perbukitan."
  },
  {
    "id": 46,
    "desa": "Kertabumi",
    "kecamatan": "Cijeungjing",
    "sk": "143/Kpts.811-Huk/2022",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/GunungSusuru.jpeg",
    "detail": "detail/kertabumi.php",
    "destinasi": [
      {
        "nama": "Situs Gunung Susuru",
        "deskripsi": "Situs purbakala dan cagar budaya di atas bukit pertemuan dua sungai dengan susunan punden berundak, gua batu, dan sejarah Kerajaan Galuh Kertabumi.",
        "fasilitas": [
          "Pemandu Arkeologi",
          "Gua & Punden Berundak",
          "Bale Informasi Sejarah",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Situs cagar budaya purbakala Gunung Susuru di pertemuan dua sungai dengan punden berundak dan gua bersejarah."
  },
  {
    "id": 47,
    "desa": "Giriharja",
    "kecamatan": "Rancah",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/JembatanSwiss.jpeg",
    "detail": "detail/giriharja.php",
    "destinasi": [
      {
        "nama": "Jembatan Swiss",
        "deskripsi": "Jembatan gantung ikonik dengan arsitektur menyerupai jembatan lembah di Swiss yang membentang di atas ngarai hijau eksotis.",
        "fasilitas": [
          "Spot Foto Jembatan Gantung",
          "Dek Pandang Ngarai",
          "Warung Kuliner",
          "Toilet",
          "Parkir"
        ]
      },
      {
        "nama": "Kolam Renang Jembatan Swiss",
        "deskripsi": "Wahana rekreasi kolam renang air segar pegunungan berdampingan langsung dengan panorama jembatan gantung Swiss.",
        "fasilitas": [
          "Kolam Renang Dewasa & Anak",
          "Perosotan Air",
          "Kamar Ganti & Bilas",
          "Kantin Makanan",
          "Gazebo Santai"
        ]
      }
    ],
    "deskripsi": "Pesona jembatan gantung ala Swiss membentang di atas lembah asri dipadukan dengan wahana kolam renang."
  },
  {
    "id": 48,
    "desa": "Werasari",
    "kecamatan": "Sadananya",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Buatan",
    "gambar": "pictures/destinasi/PasirBoma.jpeg",
    "detail": "detail/werasari.php",
    "destinasi": [
      {
        "nama": "Agrowisata Pasir Boma",
        "deskripsi": "Kawasan agrowisata perkebunan holtikultura di atas perbukitan Pasir Boma dengan panorama megah lereng Gunung Sawal.",
        "fasilitas": [
          "Kebun Wisata Buah & Sayur",
          "Spot Pandang Lereng Sawal",
          "Saung Tani",
          "Toilet",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Agrowisata terpadu perkebunan buah dan sayur dengan latar megah panorama lereng Gunung Sawal."
  },
  {
    "id": 49,
    "desa": "Cisadap",
    "kecamatan": "Ciamis",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/MakanBupatiGaluh.jpeg",
    "detail": "detail/cidadap.php",
    "destinasi": [
      {
        "nama": "Wisata Religi Makam Bupati Galuh",
        "deskripsi": "Situs ziarah makam leluhur para bupati Galuh Ciamis yang sarat nilai spiritual dan sejarah pemerintahan masa lampau.",
        "fasilitas": [
          "Kompleks Makam Bersejarah",
          "Tempat Ziarah & Wudhu",
          "Mushola",
          "Toilet",
          "Area Parkir"
        ]
      },
      {
        "nama": "Kampung Tahu",
        "deskripsi": "Sentra produksi tahu tradisional khas Cisadap di mana pengunjung dapat melihat dan mencoba proses pembuatan tahu hangat.",
        "fasilitas": [
          "Workshop Pembuatan Tahu",
          "Toko Tahu Goreng Hangat",
          "Pemandu Sentra UKM",
          "Toilet"
        ]
      },
      {
        "nama": "Agrowisata",
        "deskripsi": "Lahan perkebunan holtikultura dan buah-buahan lokal yang asri, menawarkan pengalaman memetik hasil kebun langsung bersama petani.",
        "fasilitas": [
          "Kebun Buah Edukasi",
          "Gazebo Istirahat",
          "Toilet",
          "Pusat Bibit Tanaman"
        ]
      },
      {
        "nama": "Kampung Edukasi",
        "deskripsi": "Wahana pembelajaran interaktif di alam terbuka untuk anak sekolah mengenal lingkungan hidup dan kerajinan.",
        "fasilitas": [
          "Ruang Terbuka Edukasi",
          "Bale Praktik Kerajinan",
          "Toilet",
          "Spot Foto"
        ]
      },
      {
        "nama": "Ternak Domba",
        "deskripsi": "Sentra peternakan domba unggulan Ciamis dengan sarana edukasi pemeliharaan dan pakan ternak ramah anak.",
        "fasilitas": [
          "Kandang Bersih Edukasi",
          "Area Memberi Makan Ternak",
          "Pemandu Peternak",
          "Area Parkir"
        ]
      }
    ],
    "deskripsi": "Desa wisata terpadu dengan 5 potensi unggulan: makam bupati Galuh, sentra Kampung Tahu, agrowisata kebun, kampung edukasi, dan peternakan domba."
  },
  {
    "id": 50,
    "desa": "Panyingkiran",
    "kecamatan": "Ciamis",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/KampungAngklung.jpeg",
    "detail": "detail/panyingkiran.php",
    "destinasi": [
      {
        "nama": "Wisata Religi Makam Syeh Abu Syahar",
        "deskripsi": "Tempat ziarah bersejarah makam tokoh penyebar agama Islam terkemuka di tanah Galuh.",
        "fasilitas": [
          "Makam Keramat Ziarah",
          "Tempat Doa & Wudhu",
          "Mushola",
          "Toilet",
          "Area Parkir"
        ]
      },
      {
        "nama": "Wisata Alam Cireong",
        "deskripsi": "Aliran sungai berbatu alami berair bening sejuk yang sangat diminati wisatawan untuk berendam dan terapi air.",
        "fasilitas": [
          "Kolam Aliran Sungai Alami",
          "Sewa Ban Pelampung",
          "Warung Nasi Liwet Pinggir Sungai",
          "Kamar Bilas",
          "Toilet"
        ]
      },
      {
        "nama": "Kampung Angklung",
        "deskripsi": "Pusat pelestarian dan workshop pembuatan alat musik bambu angklung serta pentas ansambel musik tradisional.",
        "fasilitas": [
          "Sanggar Seni Angklung",
          "Workshop Pembuatan Bambu",
          "Pentas Musik Interaktif",
          "Souvenir Angklung Mini"
        ]
      }
    ],
    "deskripsi": "Pusat pelestarian kesenian musik angklung tradisional, wisata religi makam syekh, dan kesegaran sungai Cireong."
  },
  {
    "id": 51,
    "desa": "Sukawening",
    "kecamatan": "Cipaku",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/Cibagi.jpeg",
    "detail": "detail/sukawening.php",
    "destinasi": [
      {
        "nama": "Wisata Alam Cibagi",
        "deskripsi": "Pemandian alam di aliran sungai jernih Cibagi yang dikelilingi hutan bambu rindang dan suasana pedesaan yang tenang menentramkan.",
        "fasilitas": [
          "Area Pemandian Sungai",
          "Saung Santai Rumpun Bambu",
          "Kamar Mandi Bilas",
          "Warung Kopi",
          "Parkir"
        ]
      }
    ],
    "deskripsi": "Pemandian aliran sungai jernih Cibagi yang alami dengan rindang rumpun bambu yang asri dan sejuk."
  },
  {
    "id": 52,
    "desa": "Kertamandala",
    "kecamatan": "Panjalu",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/VillaSrikandi.jpeg",
    "detail": "detail/kertamandala.php",
    "destinasi": [
      {
        "nama": "Makam Situs Cikapunduhan",
        "deskripsi": "Situs ziarah makam leluhur kuno Cikapunduhan yang dihormati masyarakat di tengah kawasan rimbun pegunungan Panjalu.",
        "fasilitas": [
          "Situs Makam Bersejarah",
          "Bale Ziarah",
          "Toilet",
          "Area Parkir"
        ]
      },
      {
        "nama": "Villa Srikandi",
        "deskripsi": "Penginapan villa berarsitektur kayu pegunungan yang asri dengan pemandangan bukit dan fasilitas istirahat keluarga.",
        "fasilitas": [
          "Kamar Villa Keluarga",
          "Halaman Terbuka Hijau",
          "Dapur Bersama",
          "Wifi",
          "Area Parkir Luas"
        ]
      }
    ],
    "deskripsi": "Situs makam bersejarah leluhur Cikapunduhan berdampingan dengan penginapan villa perbukitan pegunungan."
  },
  {
    "id": 53,
    "desa": "Padmulya",
    "kecamatan": "Cihaurbeuti",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/CurugSeda.jpeg",
    "detail": "detail/padamulya.php",
    "destinasi": [
      {
        "nama": "Curug Seda",
        "deskripsi": "Air terjun alami tersembunyi dengan debit air deras jernih dan tebing bebatuan bertingkat yang memesona.",
        "fasilitas": [
          "Jalur Trekking Curug",
          "Kolam Alami Air Terjun",
          "Saung Bambu",
          "Toilet"
        ]
      },
      {
        "nama": "Kolam Renang Alam JF",
        "deskripsi": "Kolam renang rekreasi keluarga bersumber langsung dari mata air pegunungan yang segar tanpa kaporit.",
        "fasilitas": [
          "Kolam Renang Anak & Dewasa",
          "Kamar Ganti & Bilas",
          "Kantin Makanan",
          "Gazebo Santai"
        ]
      },
      {
        "nama": "Wisata Sungai Ciharus",
        "deskripsi": "Aliran sungai jernih berbatu dengan rimbun pepohonan asri, sangat cocok untuk berendam dan bermain air.",
        "fasilitas": [
          "Area Berendam Bebatuan",
          "Sewa Ban Pelampung",
          "Saung Tepi Sungai",
          "Warung"
        ]
      },
      {
        "nama": "Buper Puncak Asih",
        "deskripsi": "Bumi perkemahan di atas ketinggian Padamulya dengan view perbukitan dan kerlap-kerlip lampu kota di malam hari.",
        "fasilitas": [
          "Lapangan Camping Ground",
          "Titik Api Unggun",
          "Kran Air & Listrik",
          "Toilet & Mushola"
        ]
      }
    ],
    "deskripsi": "Memiliki 4 destinasi unggulan: Curug Seda yang memesona, kolam renang alami JF, wisata sungai Ciharus, dan bumi perkemahan Puncak Asih."
  },
  {
    "id": 54,
    "desa": "Tanjungsari",
    "kecamatan": "Sadananya",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/CurugPanganten.jpeg",
    "detail": "detail/tanjungsari.php",
    "destinasi": [
      {
        "nama": "Curug Panganten",
        "deskripsi": "Air terjun kembar bertingkat yang anggun di tengah hutan lindung lereng Gunung Sawal dengan kolam alami yang jernih.",
        "fasilitas": [
          "Jalur Setapak Hutan",
          "Spot Foto Air Terjun Kembar",
          "Saung Istirahat",
          "Toilet"
        ]
      },
      {
        "nama": "Buper Awilega",
        "deskripsi": "Bumi perkemahan di tengah deretan pohon bambu dan pinus berhawa sejuk dengan fasilitas outbound dan trekking.",
        "fasilitas": [
          "Bumi Perkemahan Luas",
          "Area Outbound & Flying Fox",
          "Kamar Mandi & Toilet",
          "Mushola",
          "Parkir"
        ]
      },
      {
        "nama": "Leuwi Pamipiran",
        "deskripsi": "Lubuk sungai alami berair hijau toska jernih nan dalam yang cocok untuk berenang dan menyelam di alam bebas.",
        "fasilitas": [
          "Spot Berenang Alami",
          "Penyewaan Pelampung",
          "Kamar Ganti Sederhana",
          "Warung Makanan"
        ]
      }
    ],
    "deskripsi": "Menghadirkan 3 daya tarik: Curug Panganten kembar bertingkat, buper Awilega di tengah pinus, dan air jernih Leuwi Pamipiran."
  },
  {
    "id": 55,
    "desa": "Sukasetia",
    "kecamatan": "Cihaurbeuti",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/DesaAdatSejahtera.jpeg",
    "detail": "detail/sukasetia.php",
    "destinasi": [
      {
        "nama": "Agrowisata Sukapulang",
        "deskripsi": "Perkebunan terpadu dengan aneka tanaman buah, kebun kopi pegunungan, dan sajian kopi robusta khas desa.",
        "fasilitas": [
          "Kebun Kopi Edukasi",
          "Kedai Kopi Sukapulang",
          "Pusat Bibit Tanaman",
          "Toilet",
          "Parkir"
        ]
      },
      {
        "nama": "Desa Adat Sejahtera Berencana",
        "deskripsi": "Pemukiman masyarakat adat yang memegang teguh tradisi gotong royong, arsitektur rumah khas, dan kearifan lingkungan.",
        "fasilitas": [
          "Bale Sawala Adat",
          "Pemandu Budaya Desa",
          "Pusat Kerajinan Anyaman",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Perpaduan potensi perkebunan agrowisata Sukapulang dengan tatanan kearifan adat masyarakat Sejahtera Berencana."
  },
  {
    "id": 56,
    "desa": "Maparah",
    "kecamatan": "Panjalu",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Sejarah & Budaya",
    "gambar": "pictures/destinasi/TamanUncalBubulak.jpeg",
    "detail": "detail/maparah.php",
    "destinasi": [
      {
        "nama": "Situs Aria Dipa",
        "deskripsi": "Cagar budaya situs peninggalan Pangeran Aria Dipa, tokoh terkemuka sejarah Panjalu, yang berada di puncak bukit berhawa sejuk.",
        "fasilitas": [
          "Situs Bersejarah Terawat",
          "Bale Pasarean",
          "Pemandu Sejarah",
          "Toilet",
          "Area Parkir"
        ]
      },
      {
        "nama": "Taman Uncal Bubulak",
        "deskripsi": "Taman rekreasi keluarga yang memiliki penangkaran rusa tutul (uncal) jinak di mana anak-anak dapat berinteraksi dan memberi makan.",
        "fasilitas": [
          "Kandang Interaktif Rusa",
          "Pakan Rusa Edukasi",
          "Taman Bermain Anak",
          "Gazebo Santai",
          "Toilet & Kantin"
        ]
      }
    ],
    "deskripsi": "Cagar budaya situs tokoh sejarah Arya Dipa berpadu taman penangkaran rusa dan rekreasi keluarga Bubulak."
  },
  {
    "id": 57,
    "desa": "Sandingtaman",
    "kecamatan": "Panjalu",
    "sk": "500.13.1/Kpts.672-Huk/Tahun 2023",
    "status": "Rintisan",
    "kategori": "Alam",
    "gambar": "pictures/destinasi/CurugTujuhCibolang.jpeg",
    "detail": "detail/sandingtaman.php",
    "destinasi": [
      {
        "nama": "Curug Tujuh",
        "deskripsi": "Air terjun legendaris Curug Cibolang dengan 7 tingkatan air terjun spektakuler di kawasan hutan pinus lindung lereng Gunung Sawal.",
        "fasilitas": [
          "Jalur Wisata 7 Tingkat Curug",
          "Kolam Pemandian Alami",
          "Warung Kuliner Khas",
          "Toilet & Kamar Bilas",
          "Parkir Luas"
        ]
      },
      {
        "nama": "Buper Aki Kabayan",
        "deskripsi": "Bumi perkemahan nyaman di tengah pepohonan pinus rindang dengan fasilitas outbound, air jernih pegunungan, dan udara dingin.",
        "fasilitas": [
          "Area Tenda Camping",
          "Penyewaan Tenda & Sleeping Bag",
          "Toilet & Mushola",
          "Penerangan Listrik"
        ]
      },
      {
        "nama": "Situs Cidehem",
        "deskripsi": "Sumber mata air purba bersejarah yang dikeramatkan dengan air yang sangat jernih dan dipercaya berkhasiat kesehatan.",
        "fasilitas": [
          "Mata Air Alami Cidehem",
          "Tempat Ziarah & Wudhu",
          "Bale Istirahat",
          "Toilet"
        ]
      }
    ],
    "deskripsi": "Keindahan spektakuler 7 tingkatan Curug Cibolang, bumi perkemahan Aki Kabayan, dan mata air bersejarah Situs Cidehem."
  }
];

// Alias untuk kompatibilitas jika ada kode lama yang merujuk destinations
const destinations = desaWisataData;

/* =========================================================
   HELPER DESTINASI
========================================================= */

function getDestName(d) {
  if (!d) return "";
  return typeof d === "object" && d.nama ? d.nama : String(d);
}

function getDestDesc(d, fallback) {
  if (typeof d === "object" && d.deskripsi) return d.deskripsi;
  return fallback || "";
}

function getDestFacilities(d) {
  if (typeof d === "object" && Array.isArray(d.fasilitas)) return d.fasilitas;
  return ["Area Parkir", "Toilet", "Spot Foto", "Warung Kuliner"];
}

/* =========================================================
   ELEMENT HTML
========================================================= */

const destinationContainer = document.getElementById("destinationContainer");
const resultCount = document.getElementById("resultCount");
const totalDestCount = document.getElementById("totalDestCount");
const emptyResult = document.getElementById("emptyResult");
const searchInput = document.getElementById("searchDesaInput");
const desaFilter = document.getElementById("desaFilter") || document.getElementById("kecamatanFilter");
const kecamatanFilter = desaFilter;
const statusFilter = document.getElementById("statusFilter");
const categoryFilter = document.getElementById("categoryFilter");
const viewModeGrid = document.getElementById("viewModeGrid");
const viewModeList = document.getElementById("viewModeList");

let currentViewMode = "grid"; // 'grid' atau 'grouped'
let activeCategory = "Semua";
let activeDesa = "Semua";
let activeKecamatan = "Semua";
let activeStatus = "Semua";
let searchQuery = "";

/* =========================================================
   HELPER RESOLVE ASSET URL
========================================================= */

function resolveAsset(path) {
  if (!path) return (window.appBaseUrl || '/') + 'pictures/LogoDispar.png';
  if (path.startsWith('http://') || path.startsWith('https://')) return path;
  var base = window.appBaseUrl || '/';
  if (!base.endsWith('/')) base += '/';
  return base + path.replace(/^\/+/, '');
}

/* =========================================================
   ICON KATEGORI
========================================================= */

function getCategoryIcon(category) {
  if (category === "Alam") return "bi-tree-fill";
  if (category === "Buatan") return "bi-building";
  return "bi-bank";
}

/* =========================================================
   BUAT KARTU DESA WISATA (GRID VIEW)
   Menampilkan deskripsi dan fasilitas per destinasi
========================================================= */

function createDesaCard(desaItem) {
  const column = document.createElement("div");
  column.className = "col-lg-6 col-md-12 mb-4";

  const totalDest = desaItem.destinasi.length;
  const isBerkembang = desaItem.status === "Berkembang";

  // Badges status desa wisata (Berkembang / Rintisan)
  const statusBadgeHtml = isBerkembang
    ? `<span class="desa-status-badge status-berkembang"><i class="bi bi-patch-check-fill me-1"></i>Berkembang</span>`
    : `<span class="desa-status-badge status-rintisan"><i class="bi bi-clock-history me-1"></i>Rintisan</span>`;

  // Render detail per destinasi (Nama, Deskripsi Destinasi, Fasilitas)
  const destinasiBoxesHtml = desaItem.destinasi
    .map((dest, idx) => {
      const dName = getDestName(dest);
      const dDesc = getDestDesc(dest, desaItem.deskripsi);
      const dFacilities = getDestFacilities(dest);

      const fasBadges = dFacilities
        .map(f => `<span class="badge bg-white text-secondary border fw-normal py-1 px-2 me-1 mb-1" style="font-size: 11.5px;"><i class="bi bi-check-circle-fill text-success me-1"></i>${f}</span>`)
        .join("");

      return `
        <div class="desa-dest-box p-3 mb-2 rounded-3 bg-white border shadow-xs">
          <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-1">
            <span class="fw-bold text-dark dest-item-title" style="font-size: 14.5px;">
              <i class="bi bi-geo-alt-fill text-success me-1"></i>${dName}
            </span>
            <span class="badge bg-success-subtle text-success small" style="font-size: 11px;">
              Destinasi ${idx + 1}
            </span>
          </div>
          <p class="text-secondary small mb-2 dest-item-desc" style="font-size: 12.5px; line-height: 1.6;">
            ${dDesc}
          </p>
          <div class="dest-facilities-wrap d-flex flex-wrap align-items-center pt-1 border-top border-light">
            <span class="text-muted small me-2" style="font-size: 11px; font-weight: 600;">
              <i class="bi bi-stars text-warning me-1"></i>Fasilitas:
            </span>
            ${fasBadges}
          </div>
        </div>
      `;
    })
    .join("");

  column.innerHTML = `
    <div class="destination-card h-100 desa-wisata-card shadow-sm">
      <div class="destination-image position-relative">
        <img
          src="${resolveAsset(desaItem.gambar)}"
          alt="Desa Wisata ${desaItem.desa}"
          loading="lazy"
          onerror="this.onerror=null; this.src='${resolveAsset('pictures/LogoDispar.png')}';"
        >

        <span class="destination-category">
          <i class="bi ${getCategoryIcon(desaItem.kategori)}"></i>
          ${desaItem.kategori}
        </span>

        ${statusBadgeHtml}
      </div>

      <div class="destination-card-body">
        <span class="destination-location">
          <i class="bi bi-geo-alt-fill"></i>
          Desa ${desaItem.desa}, Kecamatan ${desaItem.kecamatan}
        </span>

        <h3 class="desa-title">Desa Wisata ${desaItem.desa}</h3>

        <div class="desa-sk-badge mb-2">
          <i class="bi bi-file-earmark-text text-secondary me-1"></i>
          <span>SK: ${desaItem.sk}</span>
        </div>

        <p class="desa-desc">${desaItem.deskripsi}</p>

        <!-- KELOMPOK DESTINASI DI DESA INI (DETAIL PER DESTINASI + FASILITAS) -->
        <div class="desa-grouped-destinasi">
          <div class="desa-grouped-header d-flex justify-content-between align-items-center mb-2">
            <span>
              <i class="bi bi-collection-fill text-success me-1"></i>
              Destinasi & Fasilitas di Desa Ini:
            </span>
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
              ${totalDest} Destinasi
            </span>
          </div>
          <div class="desa-destinasi-boxes-wrap">
            ${destinasiBoxesHtml}
          </div>
        </div>

        <div class="destination-card-footer mt-auto pt-3">
          <a href="${resolveAsset(desaItem.detail)}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            <span>Lihat Profil Desa Wisata</span>
            <i class="bi bi-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  `;

  return column;
}

/* =========================================================
   BUAT TAMPILAN TERKELOMPOK / DAFTAR LENGKAP (GROUPED VIEW)
   Menampilkan deskripsi & fasilitas per destinasi
========================================================= */

function createGroupedDesaRow(desaItem) {
  const column = document.createElement("div");
  column.className = "col-12 mb-4";

  const totalDest = desaItem.destinasi.length;
  const isBerkembang = desaItem.status === "Berkembang";

  const destItemsListHtml = desaItem.destinasi
    .map((dest, idx) => {
      const dName = getDestName(dest);
      const dDesc = getDestDesc(dest, desaItem.deskripsi);
      const dFacilities = getDestFacilities(dest);

      const fasBadges = dFacilities
        .map(f => `<span class="badge bg-white text-secondary border fw-normal py-1 px-2 me-1 mb-1" style="font-size: 11.5px;"><i class="bi bi-check-circle-fill text-success me-1"></i>${f}</span>`)
        .join("");

      return `
        <div class="grouped-dest-item p-3 mb-2 rounded-3 bg-light border">
          <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-1">
            <div class="d-flex align-items-center">
              <span class="badge bg-success text-white me-2 px-2 py-1 rounded-circle font-monospace">${idx + 1}</span>
              <strong class="text-dark" style="font-size: 14.5px;">${dName}</strong>
            </div>
            <span class="badge bg-white text-secondary border">
              <i class="bi bi-pin-map me-1 text-success"></i>Desa ${desaItem.desa}
            </span>
          </div>
          <p class="text-secondary small mb-2" style="font-size: 12.5px; line-height: 1.55;">${dDesc}</p>
          <div class="d-flex flex-wrap align-items-center pt-1">
            <span class="text-muted small me-2" style="font-size: 11px; font-weight: 600;">
              <i class="bi bi-stars text-warning me-1"></i>Fasilitas:
            </span>
            ${fasBadges}
          </div>
        </div>
      `;
    })
    .join("");

  column.innerHTML = `
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden grouped-desa-card">
      <div class="card-body p-4">
        <div class="row align-items-start">
          <div class="col-lg-3 col-md-4 mb-3 mb-md-0">
            <div class="rounded-3 overflow-hidden position-relative" style="height: 220px;">
              <img
                src="${resolveAsset(desaItem.gambar)}"
                alt="Desa Wisata ${desaItem.desa}"
                class="w-100 h-100 object-fit-cover"
                onerror="this.onerror=null; this.src='${resolveAsset('pictures/LogoDispar.png')}';"
              >
              <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-2">
                <i class="bi ${getCategoryIcon(desaItem.kategori)} me-1"></i>${desaItem.kategori}
              </span>
              <span class="badge ${isBerkembang ? 'bg-success' : 'bg-info text-dark'} position-absolute top-0 end-0 m-2">
                ${desaItem.status}
              </span>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-8 mb-3 mb-lg-0">
            <span class="text-success small fw-bold text-uppercase d-block mb-1">
              <i class="bi bi-geo-alt-fill me-1"></i>Kecamatan ${desaItem.kecamatan}, Ciamis
            </span>
            <h4 class="fw-bold mb-1 text-dark">Desa Wisata ${desaItem.desa}</h4>
            <div class="text-muted small mb-2">
              <i class="bi bi-file-earmark-check me-1"></i>SK: <strong>${desaItem.sk}</strong>
              <span class="ms-2 badge ${isBerkembang ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info-emphasis'} rounded-pill">
                ${desaItem.status}
              </span>
            </div>
            <p class="text-muted small mb-3">${desaItem.deskripsi}</p>
            <a href="${resolveAsset(desaItem.detail)}" class="btn btn-outline-success btn-sm rounded-pill px-3">
              Kunjungi Profil Desa <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>

          <div class="col-lg-5 col-12">
            <div class="p-3 bg-white rounded-3 border">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small text-muted fw-bold text-uppercase">Destinasi & Fasilitas:</span>
                <span class="badge bg-success rounded-pill">${totalDest} Destinasi</span>
              </div>
              <div class="grouped-dest-list-wrap">
                ${destItemsListHtml}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;

  return column;
}

/* =========================================================
   TAMPILKAN DATA
========================================================= */

function renderDesaWisata(data) {
  if (!destinationContainer) return;

  destinationContainer.innerHTML = "";

  if (data.length === 0) {
    if (emptyResult) emptyResult.style.display = "block";
    if (resultCount) resultCount.textContent = "0";
    if (totalDestCount) totalDestCount.textContent = "0";
    return;
  }

  if (emptyResult) emptyResult.style.display = "none";

  const totalDestinasiFound = data.reduce(
    (acc, curr) => acc + (curr.destinasi ? curr.destinasi.length : 1),
    0
  );

  if (resultCount) resultCount.textContent = data.length;
  if (totalDestCount) totalDestCount.textContent = totalDestinasiFound;

  data.forEach((desaItem) => {
    if (currentViewMode === "grid") {
      destinationContainer.appendChild(createDesaCard(desaItem));
    } else {
      destinationContainer.appendChild(createGroupedDesaRow(desaItem));
    }
  });
}

/* =========================================================
   FILTER DAN PENCARIAN
========================================================= */

function filterDesaWisata() {
  const query = searchQuery.trim().toLowerCase();

  const filtered = desaWisataData.filter((item) => {
    // 1. Kategori
    const matchCategory =
      activeCategory === "Semua" || item.kategori === activeCategory;

    // 2. Desa
    const matchDesa =
      activeDesa === "Semua" || item.desa === activeDesa;

    // 3. Status (Berkembang / Rintisan)
    const matchStatus =
      activeStatus === "Semua" || item.status === activeStatus;

    // 4. Pencarian Teks
    let matchSearch = true;
    if (query !== "") {
      const matchNamaDesa = item.desa.toLowerCase().includes(query);
      const matchKecamatan = item.kecamatan.toLowerCase().includes(query);
      const matchKategori = item.kategori.toLowerCase().includes(query);
      const matchSK = item.sk ? item.sk.toLowerCase().includes(query) : false;
      const matchDeskripsi = item.deskripsi.toLowerCase().includes(query);

      const matchDestinasi = item.destinasi.some((d) => {
        const dName = getDestName(d).toLowerCase();
        const dDesc = getDestDesc(d, "").toLowerCase();
        const dFac = getDestFacilities(d).join(" ").toLowerCase();
        return dName.includes(query) || dDesc.includes(query) || dFac.includes(query);
      });

      matchSearch =
        matchNamaDesa ||
        matchKecamatan ||
        matchKategori ||
        matchSK ||
        matchDestinasi ||
        matchDeskripsi;
    }

    return matchCategory && matchDesa && matchStatus && matchSearch;
  });

  renderDesaWisata(filtered);
}

/* =========================================================
   POPULATE DROPDOWN DESA FILTER
========================================================= */

function populateDesaFilter() {
  if (!desaFilter) return;

  const desaSet = new Set();
  desaWisataData.forEach((d) => desaSet.add(d.desa));
  const sortedDesa = Array.from(desaSet).sort((a, b) => a.localeCompare(b));

  sortedDesa.forEach((desaName) => {
    const opt = document.createElement("option");
    opt.value = desaName;
    opt.textContent = `Desa ${desaName}`;
    desaFilter.appendChild(opt);
  });
}

/* =========================================================
   EVENT LISTENERS
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
  populateDesaFilter();

  // Cek parameter kategori dari URL
  const urlParams = new URLSearchParams(window.location.search);
  const kategoriParam = urlParams.get("kategori");
  if (kategoriParam && ["Alam", "Buatan", "Sejarah & Budaya"].includes(kategoriParam)) {
    activeCategory = kategoriParam;
  }

  // Tampilkan data awal
  filterDesaWisata();

  // Search input
  if (searchInput) {
    searchInput.addEventListener("input", function (e) {
      searchQuery = e.target.value;
      filterDesaWisata();
    });
  }

  // Desa filter
  if (desaFilter) {
    desaFilter.addEventListener("change", function (e) {
      activeDesa = e.target.value;
      filterDesaWisata();
    });
  }

  // Status filter
  if (statusFilter) {
    statusFilter.addEventListener("change", function (e) {
      activeStatus = e.target.value;
      filterDesaWisata();
    });
  }

  // Category pills
  const categoryPills = document.querySelectorAll("[data-category-filter]");
  categoryPills.forEach((btn) => {
    btn.addEventListener("click", function () {
      categoryPills.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      activeCategory = this.getAttribute("data-category-filter");
      filterDesaWisata();
    });
  });

  // Toggle View Mode (Grid vs Grouped)
  if (viewModeGrid && viewModeList) {
    viewModeGrid.addEventListener("click", function () {
      viewModeGrid.classList.add("active");
      viewModeList.classList.remove("active");
      currentViewMode = "grid";
      filterDesaWisata();
    });

    viewModeList.addEventListener("click", function () {
      viewModeList.classList.add("active");
      viewModeGrid.classList.remove("active");
      currentViewMode = "grouped";
      filterDesaWisata();
    });
  }
});
