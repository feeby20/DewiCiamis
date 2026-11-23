<?php
/**
 * Generator untuk semua halaman detail desa wisata.
 * Menghasilkan file PHP yang menampilkan:
 *   1. Profil/deskripsi desa wisata
 *   2. Kartu per-destinasi yang dapat diklik (menuju /destinasi/{slug})
 *   3. Sidebar info desa + harga tiket
 *   4. Ulasan pengunjung
 */

// =====================================================================
// DATA SEMUA DESA WISATA
// Format per desa:
//   'slug_file' => [
//       'nama_desa'   => string,       // Nama tampilan desa
//       'kecamatan'   => string,
//       'foto_banner' => string,       // gambar utama (dari pictures/destinasi/)
//       'deskripsi_desa' => string,    // paragraf profil desa
//       'destinasi' => [               // array destinasi (minimal 1)
//           [
//               'nama'        => string,
//               'slug'        => string,   // slug Laravel route /destinasi/{slug}
//               'foto'        => string,
//               'kategori'    => string,
//               'kategori_badge' => string, // warna badge: success/primary/warning/info
//               'harga'       => int,
//               'lokasi_detail' => string,
//               'deskripsi_singkat' => string,
//               'fasilitas'   => [string,...],  // 3-4 fasilitas singkat
//           ],
//       ],
//   ]
// =====================================================================

$DESA_DATA = [

    'aomas' => [
        'nama_desa' => 'Desa Aomas',
        'kecamatan' => 'Purwadadi',
        'foto_banner' => 'PuncakBangku.jpeg',
        'deskripsi_desa' => 'Desa Aomas merupakan salah satu desa wisata di Kecamatan Purwadadi yang menyimpan kekayaan alam berupa perbukitan dan hamparan persawahan yang indah. Desa ini dikenal dengan Puncak Bangku, sebuah bukit dengan pemandangan lembah dan kabut pagi yang memukau, menjadikannya destinasi favorit bagi pecinta alam dan wisata petualangan dari berbagai penjuru Kabupaten Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Puncak Bangku',
                'slug' => 'puncak-bangku',
                'foto' => 'PuncakBangku.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Aomas, Kecamatan Purwadadi',
                'deskripsi_singkat' => 'Bukit panorama dengan hamparan lembah dan pemandangan matahari terbit yang spektakuler. Spot favorit untuk menikmati kabut pagi dan sunrise terbaik di Kabupaten Ciamis.',
                'fasilitas' => ['Area Parkir', 'Warung Kuliner', 'Spot Foto Panorama', 'Jalur Trekking'],
            ],
        ],
    ],

    'bahara' => [
        'nama_desa' => 'Desa Bahara',
        'kecamatan' => 'Langkaplancar',
        'foto_banner' => 'CurugSeda.jpeg',
        'deskripsi_desa' => 'Desa Bahara terletak di Kecamatan Langkaplancar, Kabupaten Ciamis, dikelilingi hutan tropis dan lembah sungai yang masih alami. Desa ini memiliki Curug Seda sebagai destinasi andalan—air terjun bertingkat yang dikelilingi pepohonan rindang dan kolam alami yang menyejukkan, menjadi daya tarik tersendiri bagi wisatawan yang mencari ketenangan di alam bebas.',
        'destinasi' => [
            [
                'nama' => 'Curug Seda',
                'slug' => 'curug-seda',
                'foto' => 'CurugSeda.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Bahara, Kecamatan Langkaplancar',
                'deskripsi_singkat' => 'Air terjun bertingkat di tengah hutan tropis yang rimbun dengan kolam alami di bawahnya. Suasana sejuk dan asri menjadikan Curug Seda sebagai surga tersembunyi Langkaplancar.',
                'fasilitas' => ['Kolam Alami', 'Area Piknik', 'Toilet Umum', 'Warung Ringan'],
            ],
        ],
    ],

    'bangunharja' => [
        'nama_desa' => 'Desa Bangunharja',
        'kecamatan' => 'Cisaga',
        'foto_banner' => 'BukitSamida.webp',
        'deskripsi_desa' => 'Desa Bangunharja di Kecamatan Cisaga menawarkan pesona alam Bukit Samida dengan hamparan pinus dan sabana yang memukau. Desa ini aktif mengembangkan pariwisata berbasis alam dan budaya dengan sentuhan kearifan lokal masyarakat Sunda, menjadikannya tujuan wisata yang nyaman dan autentik untuk keluarga maupun kelompok pemuda.',
        'destinasi' => [
            [
                'nama' => 'Bukit Samida',
                'slug' => 'bukit-samida',
                'foto' => 'BukitSamida.webp',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Bangunharja, Kecamatan Cisaga',
                'deskripsi_singkat' => 'Puncak bukit pinus dengan padang sabana luas yang sangat memukau. Tempat terbaik untuk menikmati golden hour dan pemandangan pegunungan Ciamis dari ketinggian.',
                'fasilitas' => ['Jalur Trekking', 'Spot Foto Instagramable', 'Area Parkir', 'Warung Kopi'],
            ],
        ],
    ],

    'banjayanyar' => [
        'nama_desa' => 'Desa Banjayanyar',
        'kecamatan' => 'Cihaurbeuti',
        'foto_banner' => 'CadasNgampar.webp',
        'deskripsi_desa' => 'Desa Banjayanyar di Kecamatan Cihaurbeuti memiliki kekayaan geologi unik berupa Cadas Ngampar, formasi batuan alam berlumut yang mengesankan. Dipadukan dengan lansekap hutan dan sungai yang jernih, desa ini menawarkan wisata alam petualangan yang cocok bagi mereka yang ingin menjelajahi keajaiban alam tersembunyi Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Cadas Ngampar',
                'slug' => 'cadas-ngampar',
                'foto' => 'CadasNgampar.webp',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Banjayanyar, Kecamatan Cihaurbeuti',
                'deskripsi_singkat' => 'Formasi batuan alam berlumut yang terbentuk ribuan tahun menjadi pemandangan geologi yang menakjubkan. Dikelilingi pepohonan hijau dan aliran sungai jernih yang menyejukkan.',
                'fasilitas' => ['Area Istirahat', 'Spot Foto Unik', 'Jalur Pejalan Kaki', 'Warung Ringan'],
            ],
        ],
    ],

    'baregbeg' => [
        'nama_desa' => 'Desa Baregbeg',
        'kecamatan' => 'Baregbeg',
        'foto_banner' => 'TamanUncalBubulak.jpeg',
        'deskripsi_desa' => 'Desa Baregbeg merupakan desa wisata di Kecamatan Baregbeg yang dikembangkan sebagai pusat taman keluarga dan konservasi satwa. Taman Uncal Bubulak menjadi ikon wisata desa ini—taman bertema alam dengan wahana edukasi satwa, kolam keluarga, dan area bermain anak yang menjadikannya pilihan ideal untuk wisata keluarga di akhir pekan.',
        'destinasi' => [
            [
                'nama' => 'Taman Uncal Bubulak',
                'slug' => 'taman-uncal-bubulak',
                'foto' => 'TamanUncalBubulak.jpeg',
                'kategori' => 'Wisata Buatan',
                'kategori_badge' => 'primary',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Baregbeg, Kecamatan Baregbeg',
                'deskripsi_singkat' => 'Taman keluarga dengan konsep konservasi satwa dan edukasi alam. Menyediakan wahana bermain anak, area foto bertema alam, dan kolam air yang menyegarkan.',
                'fasilitas' => ['Wahana Edukasi Satwa', 'Area Bermain Anak', 'Kolam Keluarga', 'Kantin & Toilet'],
            ],
        ],
    ],

    'cibadak' => [
        'nama_desa' => 'Desa Cibadak',
        'kecamatan' => 'Banjarsari',
        'foto_banner' => 'PangangonanCibadak.jpeg',
        'deskripsi_desa' => 'Desa Cibadak di Kecamatan Banjarsari memiliki daya tarik wisata padang penggembalaan yang khas dengan nuansa pedesaan yang autentik. Pangangonan Cibadak menawarkan pemandangan hamparan padang rumput hijau membentang luas dengan latar perbukitan, menciptakan lanskap khas desa sunda yang memanjakan mata dan cocok sebagai spot fotografi alam.',
        'destinasi' => [
            [
                'nama' => 'Pangangonan Cibadak',
                'slug' => 'pangangonan-cibadak',
                'foto' => 'PangangonanCibadak.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Cibadak, Kecamatan Banjarsari',
                'deskripsi_singkat' => 'Hamparan padang penggembalaan hijau luas dengan pemandangan perbukitan yang mempesona. Suasana pedesaan autentik yang cocok untuk berfoto dan menikmati ketenangan alam.',
                'fasilitas' => ['Padang Rumput Luas', 'Spot Foto Panorama', 'Area Parkir', 'Warung Ringan'],
            ],
        ],
    ],

    'cibereum' => [
        'nama_desa' => 'Desa Cibereum',
        'kecamatan' => 'Sukamantri',
        'foto_banner' => 'BuperPuncakAsih.jpeg',
        'deskripsi_desa' => 'Desa Cibereum di Kecamatan Sukamantri menyimpan pesona alam berupa Bumi Perkemahan Puncak Asih yang populer di kalangan pecinta alam Ciamis. Desa ini dikelilingi perbukitan dengan udara sejuk khas pegunungan Priangan, menawarkan pengalaman berkemah, outbound, dan eksplorasi alam yang tak terlupakan bagi pengunjung dari segala usia.',
        'destinasi' => [
            [
                'nama' => 'Bumi Perkemahan Puncak Asih',
                'slug' => 'bumi-perkemahan-puncak-asih',
                'foto' => 'BuperPuncakAsih.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Cibereum, Kecamatan Sukamantri',
                'deskripsi_singkat' => 'Bumi perkemahan di puncak bukit dengan pemandangan lembah dan alam hutan yang masih alami. Sangat ideal untuk kegiatan perkemahan, outbound, dan wisata petualangan keluarga.',
                'fasilitas' => ['Area Camping Ground', 'MCK Bersih', 'Api Unggun', 'Warung Kopi Puncak'],
            ],
        ],
    ],

    'cidadap' => [
        'nama_desa' => 'Desa Cidadap',
        'kecamatan' => 'Lakbok',
        'foto_banner' => 'LayangLakbok.jpeg',
        'deskripsi_desa' => 'Desa Cidadap terletak di Kecamatan Lakbok yang dikenal dengan tradisi permainan rakyat layang-layang raksasa yang diwariskan turun-temurun. Potensi wisata budaya dan alam desa ini menjadi magnet tersendiri, terutama ketika musim angin tiba dan langit desa dihiasi layang-layang bermotif batik Ciamis yang berwarna-warni.',
        'destinasi' => [
            [
                'nama' => 'Festival Layang-Layang Lakbok',
                'slug' => 'layang-lakbok',
                'foto' => 'LayangLakbok.jpeg',
                'kategori' => 'Wisata Budaya',
                'kategori_badge' => 'warning',
                'harga' => 5000,
                'lokasi_detail' => 'Desa Cidadap, Kecamatan Lakbok',
                'deskripsi_singkat' => 'Tradisi festival layang-layang raksasa bermotif batik Ciamis yang menjadi warisan budaya Lakbok. Menyaksikan ratusan layang-layang memenuhi langit biru adalah pengalaman yang tak terlupakan.',
                'fasilitas' => ['Area Penonton', 'Warung Kuliner Lokal', 'Penjualan Layang-layang Hias', 'Area Parkir'],
            ],
        ],
    ],

    'ciklar' => [
        'nama_desa' => 'Desa Ciklar',
        'kecamatan' => 'Panumbangan',
        'foto_banner' => 'SituRancabala.jpeg',
        'deskripsi_desa' => 'Desa Ciklar di Kecamatan Panumbangan menawarkan keindahan Situ Rancabala, danau alam tenang yang dikelilingi perbukitan hijau dan hamparan sawah. Suasana asri dan sejuk danau ini menjadikan Ciklar sebagai destinasi liburan favorit bagi keluarga yang ingin menikmati ketenangan alam pedesaan Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Situ Rancabala',
                'slug' => 'situ-rancabala',
                'foto' => 'SituRancabala.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Ciklar, Kecamatan Panumbangan',
                'deskripsi_singkat' => 'Danau alam tenang yang dikelilingi perbukitan hijau dan sawah. Spot memancing, berperahu, dan berfoto dengan latar refleksi bukit yang sempurna.',
                'fasilitas' => ['Wahana Perahu', 'Area Memancing', 'Warung Tepi Danau', 'Area Parkir'],
            ],
        ],
    ],

    'cikupa' => [
        'nama_desa' => 'Desa Cikupa',
        'kecamatan' => 'Lumbung',
        'foto_banner' => 'KampungMadu.jpeg',
        'deskripsi_desa' => 'Desa Cikupa di Kecamatan Lumbung dikenal sebagai desa penghasil madu hutan alami dengan tradisi beternak lebah yang sudah berlangsung turun-temurun. Kampung Madu Cikupa menjadi destinasi agrowisata edukatif yang menarik, di mana pengunjung dapat menyaksikan langsung proses panen madu, belajar beternak lebah, dan mencicipi produk madu murni khas desa.',
        'destinasi' => [
            [
                'nama' => 'Kampung Madu Cikupa',
                'slug' => 'kampung-madu',
                'foto' => 'KampungMadu.jpeg',
                'kategori' => 'Agrowisata',
                'kategori_badge' => 'warning',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Cikupa, Kecamatan Lumbung',
                'deskripsi_singkat' => 'Desa penghasil madu hutan alami dengan pengalaman langsung panen madu dan beternak lebah. Produk madu murni siap bawa pulang sebagai oleh-oleh khas.',
                'fasilitas' => ['Peternakan Lebah Edukasi', 'Toko Produk Madu', 'Area Demonstrasi Panen', 'Parkir Kendaraan'],
            ],
        ],
    ],

    'cimari' => [
        'nama_desa' => 'Desa Cimari',
        'kecamatan' => 'Cijeungjing',
        'foto_banner' => 'SituRancamayana.jpeg',
        'deskripsi_desa' => 'Desa Cimari di Kecamatan Cijeungjing memiliki Situ Rancamayana sebagai destinasi wisata unggulan. Danau alam ini dikelilingi hamparan sawah dan perbukitan tropis yang menawarkan ketenangan dan pemandangan alam yang indah. Desa Cimari aktif mengembangkan wisata air dan ekowisata untuk mendukung perekonomian masyarakat lokal.',
        'destinasi' => [
            [
                'nama' => 'Situ Rancamayana',
                'slug' => 'situ-rancamayana',
                'foto' => 'SituRancamayana.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Cimari, Kecamatan Cijeungjing',
                'deskripsi_singkat' => 'Danau alam tenang dikelilingi hamparan sawah hijau dan perbukitan tropis. Menawarkan aktivitas berperahu santai dan memancing dengan pemandangan alam yang memanjakan mata.',
                'fasilitas' => ['Wahana Perahu Kayuh', 'Spot Memancing', 'Warung Tepi Situ', 'Area Parkir'],
            ],
        ],
    ],

    'cisontrol' => [
        'nama_desa' => 'Desa Cisontrol',
        'kecamatan' => 'Rancah',
        'foto_banner' => 'WisataEdukasiAnakCisontol.jpeg',
        'deskripsi_desa' => 'Desa Cisontrol di Kecamatan Rancah mengembangkan wisata edukasi berbasis anak dan keluarga yang inovatif. Desa ini memiliki fasilitas wisata edukasi yang dirancang untuk merangsang kreativitas dan kecintaan anak-anak terhadap alam dan seni, menjadikannya pilihan tepat untuk wisata sekolah dan liburan keluarga yang bermakna.',
        'destinasi' => [
            [
                'nama' => 'Wisata Edukasi Anak Cisontrol',
                'slug' => 'wisata-edukasi-cisontrol',
                'foto' => 'WisataEdukasiAnakCisontol.jpeg',
                'kategori' => 'Wisata Edukasi',
                'kategori_badge' => 'info',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Cisontrol, Kecamatan Rancah',
                'deskripsi_singkat' => 'Kawasan wisata edukasi interaktif untuk anak dan keluarga dengan berbagai wahana kreatif. Menggabungkan pengalaman belajar dan bermain dalam suasana alam pedesaan yang menyenangkan.',
                'fasilitas' => ['Wahana Edukasi Interaktif', 'Area Bermain Anak', 'Galeri Karya Anak', 'Kantin Keluarga'],
            ],
        ],
    ],

    'darmacaang' => [
        'nama_desa' => 'Desa Darmacaang',
        'kecamatan' => 'Cikoneng',
        'foto_banner' => 'KampungAngklung.jpeg',
        'deskripsi_desa' => 'Desa Darmacaang di Kecamatan Cikoneng merupakan salah satu desa wisata budaya yang masih melestarikan tradisi musik Angklung dan kesenian Sunda. Kampung Angklung Darmacaang menjadi tujuan wisata budaya yang menarik bagi pelajar dan wisatawan yang ingin mengenal lebih dekat kekayaan seni tradisional Jawa Barat.',
        'destinasi' => [
            [
                'nama' => 'Kampung Angklung Darmacaang',
                'slug' => 'kampung-angklung',
                'foto' => 'KampungAngklung.jpeg',
                'kategori' => 'Wisata Budaya',
                'kategori_badge' => 'warning',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Darmacaang, Kecamatan Cikoneng',
                'deskripsi_singkat' => 'Kampung pelestari seni Angklung dan budaya Sunda yang otentik. Pengunjung dapat belajar bermain Angklung, menyaksikan pertunjukan seni, dan mengenal ragam budaya Priangan.',
                'fasilitas' => ['Sanggar Latihan Angklung', 'Pertunjukan Seni Budaya', 'Penjualan Kerajinan Lokal', 'Area Parkir'],
            ],
        ],
    ],

    'giriharja' => [
        'nama_desa' => 'Desa Giriharja',
        'kecamatan' => 'Panumbangan',
        'foto_banner' => 'SituHiang.jpeg',
        'deskripsi_desa' => 'Desa Giriharja di Kecamatan Panumbangan menyimpan kekayaan alam berupa Situ Hiang, danau alami dengan ekosistem unik dan pemandangan yang sangat memanjakan. Desa ini juga dikenal dengan kegiatan ekowisata dan pertanian organiknya, menjadi contoh sukses pengembangan desa wisata berbasis kelestarian lingkungan di Kabupaten Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Situ Hiang',
                'slug' => 'situ-hiang',
                'foto' => 'SiituHiang.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Giriharja, Kecamatan Panumbangan',
                'deskripsi_singkat' => 'Danau alami dengan ekosistem unik dan pemandangan perbukitan yang memesona. Suasana tenang dengan ragam flora dan fauna air menjadikannya spot ekowisata terbaik Panumbangan.',
                'fasilitas' => ['Jalur Ekowisata', 'Spot Birdwatching', 'Perahu Santai', 'Warung Tepi Danau'],
            ],
        ],
    ],

    'gunungcupu' => [
        'nama_desa' => 'Desa Gunungcupu',
        'kecamatan' => 'Sindangkasih',
        'foto_banner' => 'KampungTahu.jpeg',
        'deskripsi_desa' => 'Desa Gunungcupu di Kecamatan Sindangkasih terkenal sebagai sentra produksi tahu dan tempe tradisional yang telah berlangsung puluhan tahun. Kampung Tahu Gunungcupu menawarkan pengalaman agrowisata kuliner yang unik: pengunjung dapat menyaksikan langsung proses pembuatan tahu dari kedelai pilihan, mencicipi tahu goreng hangat, dan membawa pulang produk olahan khas desa.',
        'destinasi' => [
            [
                'nama' => 'Kampung Tahu Gunungcupu',
                'slug' => 'kampung-tahu',
                'foto' => 'KampungTahu.jpeg',
                'kategori' => 'Agrowisata',
                'kategori_badge' => 'warning',
                'harga' => 5000,
                'lokasi_detail' => 'Desa Gunungcupu, Kecamatan Sindangkasih',
                'deskripsi_singkat' => 'Sentra produksi tahu dan tempe tradisional yang sudah eksis puluhan tahun. Wisatawan dapat melihat langsung proses produksi, mencicipi tahu goreng segar, dan belanja oleh-oleh khas.',
                'fasilitas' => ['Galeri Produksi Tahu', 'Warung Tahu Goreng Segar', 'Toko Oleh-oleh', 'Area Parkir'],
            ],
        ],
    ],

    'gunungsari' => [
        'nama_desa' => 'Desa Gunungsari',
        'kecamatan' => 'Panjalu',
        'foto_banner' => 'GunungSusuru.jpeg',
        'deskripsi_desa' => 'Desa Gunungsari di Kecamatan Panjalu memiliki kekayaan alam berupa Gunung Susuru dengan hutan pinus dan jalur pendakian yang menantang. Desa ini cocok untuk wisatawan pecinta alam yang ingin menikmati petualangan mendaki, trekking hutan, dan menyaksikan panorama Kabupaten Ciamis dari puncak.',
        'destinasi' => [
            [
                'nama' => 'Gunung Susuru',
                'slug' => 'gunung-susuru',
                'foto' => 'GunungSusuru.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Gunungsari, Kecamatan Panjalu',
                'deskripsi_singkat' => 'Gunung dengan jalur pendakian melalui hutan pinus yang rindang. Puncaknya menyajikan panorama lembah Panjalu dan Situ Lengkong yang menakjubkan.',
                'fasilitas' => ['Jalur Trekking Berbatu', 'Pos Istirahat', 'Spot Foto Panorama', 'Area Parkir'],
            ],
        ],
    ],

    'jagabaya' => [
        'nama_desa' => 'Desa Jagabaya',
        'kecamatan' => 'Panawangan',
        'foto_banner' => 'ParalayangPanawangan.webp',
        'deskripsi_desa' => 'Desa Jagabaya di Kecamatan Panawangan menjadi pusat olahraga paralayang Kabupaten Ciamis yang dikenal hingga tingkat nasional. Bukit-bukit di sekitar desa menyediakan area take-off yang ideal dengan pemandangan udara spektakuler. Desa ini secara rutin menyelenggarakan kejuaraan paralayang dan menjadi destinasi favorit para atlet dan wisatawan petualang.',
        'destinasi' => [
            [
                'nama' => 'Paralayang Panawangan',
                'slug' => 'paralayang-panawangan',
                'foto' => 'ParalayangPanawangan.webp',
                'kategori' => 'Wisata Olahraga',
                'kategori_badge' => 'info',
                'harga' => 15000,
                'lokasi_detail' => 'Desa Jagabaya, Kecamatan Panawangan',
                'deskripsi_singkat' => 'Surga paralayang Kabupaten Ciamis dengan area take-off premium dan pemandangan udara yang spektakuler. Menyajikan jasa tandem untuk wisatawan dan arena kompetisi untuk para atlet.',
                'fasilitas' => ['Take-off Area Profesional', 'Tandem Flight Service', 'Area Penonton', 'Warung Kuliner'],
            ],
        ],
    ],

    'jalatrang' => [
        'nama_desa' => 'Desa Jalatrang',
        'kecamatan' => 'Cipaku',
        'foto_banner' => 'Cipaku.jpeg',
        'deskripsi_desa' => 'Desa Jalatrang di Kecamatan Cipaku menawarkan pesona alam sungai dan persawahan yang masih alami. Desa ini mengembangkan wisata air sungai dengan ragam aktivitas seperti tubing, berenang di kolam alami, dan menikmati suasana pedesaan yang damai di tepi aliran sungai Cipaku yang jernih.',
        'destinasi' => [
            [
                'nama' => 'Wisata Sungai Cipaku',
                'slug' => 'wisata-cipaku',
                'foto' => 'Cipaku.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Jalatrang, Kecamatan Cipaku',
                'deskripsi_singkat' => 'Kawasan wisata sungai dengan air jernih segar khas pegunungan. Tersedia aktivitas berenang di kolam alami, bermain air, dan menikmati alam tepi sungai yang asri.',
                'fasilitas' => ['Kolam Renang Alam', 'Area Bermain Air', 'Saung Istirahat', 'Warung Kuliner'],
            ],
        ],
    ],

    'kadupandak' => [
        'nama_desa' => 'Desa Kadupandak',
        'kecamatan' => 'Tambaksari',
        'foto_banner' => 'CekdamKadupandak.jpeg',
        'deskripsi_desa' => 'Desa Kadupandak di Kecamatan Tambaksari memiliki Cek Dam Kadupandak sebagai ikon wisata desanya. Bendungan mini yang berfungsi sebagai pengairan sawah ini telah disulap menjadi destinasi wisata air yang segar dengan latar alam persawahan terasering dan perbukitan yang memanjakan mata, sangat populer untuk berfoto dan bersantai.',
        'destinasi' => [
            [
                'nama' => 'Cek Dam Kadupandak',
                'slug' => 'cek-dam-kadupandak',
                'foto' => 'CekdamKadupandak.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Kadupandak, Kecamatan Tambaksari',
                'deskripsi_singkat' => 'Bendungan mini yang dikelilingi sawah terasering dan perbukitan hijau. Spot berfoto yang sangat populer dengan latar aliran air yang jernih dan alam pedesaan yang autentik.',
                'fasilitas' => ['Spot Foto Tepi Bendungan', 'Area Piknik', 'Warung Ringan', 'Area Parkir'],
            ],
        ],
    ],

    'karangkamulyan' => [
        'nama_desa' => 'Desa Karangkamulyan',
        'kecamatan' => 'Cijeungjing',
        'foto_banner' => 'Karangkamulyan.jpeg',
        'deskripsi_desa' => 'Desa Karangkamulyan di Kecamatan Cijeungjing merupakan situs bersejarah Kerajaan Galuh yang sangat penting bagi sejarah Sunda dan Jawa Barat. Kawasan Situs Karangkamulyan menyimpan peninggalan arkeologi berupa makam raja-raja Galuh, batu prasasti, dan struktur sakral yang dikeramatkan. Desa ini menjadi destinasi wisata sejarah dan spiritual yang dikunjungi ribuan peziarah setiap tahunnya.',
        'destinasi' => [
            [
                'nama' => 'Situs Karangkamulyan',
                'slug' => 'karangkamulyan',
                'foto' => 'Karangkamulyan.jpeg',
                'kategori' => 'Wisata Sejarah & Budaya',
                'kategori_badge' => 'warning',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Karangkamulyan, Kecamatan Cijeungjing',
                'deskripsi_singkat' => 'Situs arkeologi warisan Kerajaan Galuh dengan makam raja-raja Sunda dan batu prasasti bersejarah. Destinasi ziarah dan wisata budaya paling penting di Kabupaten Ciamis.',
                'fasilitas' => ['Kompleks Makam Raja Galuh', 'Museum Mini Galuh', 'Pemandu Wisata Sejarah', 'Area Parkir Luas'],
            ],
        ],
    ],

    'karangpaningal' => [
        'nama_desa' => 'Desa Karangpaningal',
        'kecamatan' => 'Tambaksari',
        'foto_banner' => 'PasirJatiGrownHill.jpeg',
        'deskripsi_desa' => 'Desa Karangpaningal di Kecamatan Tambaksari menawarkan pemandangan perbukitan dan hamparan alam hijau yang menakjubkan. Destinasi Pasir Jati Grown Hill menjadi ikon wisata alam perbukitan desa ini yang terkenal dengan padang rumput dan spot panorama ketinggian yang memanjakan.',
        'destinasi' => [
            [
                'nama' => 'Pasir Jati Grown Hill',
                'slug' => 'pasir-jati-grown-hill',
                'foto' => 'PasirJatiGrownHill.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Karangpaningal, Kecamatan Tambaksari',
                'deskripsi_singkat' => 'Perbukitan dengan padang rumput hijau luas dan spot panorama yang menakjubkan. Sangat cocok untuk menikmati golden hour, berkemah, dan berfoto dengan latar alam terbuka.',
                'fasilitas' => ['Spot Panorama 360°', 'Area Camping', 'Jalur Trekking', 'Warung Kopi Puncak'],
            ],
        ],
    ],

    'kaso' => [
        'nama_desa' => 'Desa Kaso',
        'kecamatan' => 'Tambaksari',
        'foto_banner' => 'CurugTujuhCibolang.jpeg',
        'deskripsi_desa' => 'Desa Kaso di Kecamatan Tambaksari memiliki destinasi wisata air terjun Curug Tujuh Cibolang yang menjadi kebanggaan warga setempat. Air terjun berlapis tujuh ini mengalir deras di antara batu-batu alam dan hutan tropis lebat, menciptakan suasana yang magis dan menyejukkan bagi siapapun yang mengunjunginya.',
        'destinasi' => [
            [
                'nama' => 'Curug Tujuh Cibolang',
                'slug' => 'curug-tujuh-cibolang',
                'foto' => 'CurugTujuhCibolang.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Kaso, Kecamatan Tambaksari',
                'deskripsi_singkat' => 'Air terjun berlapis tujuh yang mengalir deras di tengah hutan tropis lebat. Masing-masing tingkatan memiliki kolam alami yang segar dan pemandangan yang unik.',
                'fasilitas' => ['Kolam Alami Tiap Terjunan', 'Jalur Trekking Hutan', 'Warung Ringan', 'Toilet Umum'],
            ],
        ],
    ],

    'kawali' => [
        'nama_desa' => 'Desa Kawali',
        'kecamatan' => 'Kawali',
        'foto_banner' => 'AstanaGedeKawali.jpeg',
        'deskripsi_desa' => 'Desa Kawali merupakan bekas ibu kota Kerajaan Sunda Galuh yang memiliki nilai sejarah dan budaya sangat tinggi. Astana Gede Kawali adalah kompleks situs megalitikum dengan prasasti kuno, batu bertulis, dan makam raja-raja yang telah ada sejak abad ke-14. Desa ini menjadi destinasi wisata sejarah dan budaya paling bersejarah di Kabupaten Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Astana Gede Kawali',
                'slug' => 'astana-gede-kawali',
                'foto' => 'AstanaGedeKawali.jpeg',
                'kategori' => 'Wisata Sejarah & Budaya',
                'kategori_badge' => 'warning',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Kawali, Kecamatan Kawali',
                'deskripsi_singkat' => 'Kompleks situs megalitikum Kerajaan Galuh abad ke-14 dengan prasasti bertulis aksara Sunda Kuno. Menjadi bukti kejayaan Kerajaan Sunda yang paling otentik di Jawa Barat.',
                'fasilitas' => ['Kompleks Prasasti Kuno', 'Pemandu Wisata Sejarah', 'Museum Galuh Mini', 'Area Parkir'],
            ],
        ],
    ],

    'kawasen' => [
        'nama_desa' => 'Desa Kawasen',
        'kecamatan' => 'Banjarsari',
        'foto_banner' => 'PuncakMaralaya.jpeg',
        'deskripsi_desa' => 'Desa Kawasen di Kecamatan Banjarsari memiliki Puncak Maralaya sebagai destinasi wisata unggulan dengan pemandangan matahari terbenam yang spektakuler. Perbukitan yang membentang di sekitar desa memberikan panorama alam yang sangat indah, cocok untuk para pencinta alam dan fotografi lanskap.',
        'destinasi' => [
            [
                'nama' => 'Puncak Maralaya',
                'slug' => 'puncak-maralaya',
                'foto' => 'PuncakMaralaya.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Kawasen, Kecamatan Banjarsari',
                'deskripsi_singkat' => 'Puncak bukit dengan panorama sunset dan hamparan lembah yang sangat spektakuler. Spot favorit fotografer dan pencinta alam untuk menikmati pemandangan terbaik Ciamis.',
                'fasilitas' => ['Spot Sunset Premium', 'Area Istirahat', 'Warung Kopi Puncak', 'Jalur Trekking'],
            ],
        ],
    ],

    'kertabumi' => [
        'nama_desa' => 'Desa Kertabumi',
        'kecamatan' => 'Cijeungjing',
        'foto_banner' => 'KolamRenangAlamJF.jpeg',
        'deskripsi_desa' => 'Desa Kertabumi di Kecamatan Cijeungjing mengembangkan wisata air keluarga dengan kolam renang alam yang bersumber dari mata air pegunungan. Pemandian alam Kertabumi menawarkan pengalaman berenang di kolam alami yang segar dan bersih, sangat populer di kalangan keluarga dan anak-anak sebagai destinasi wisata air alam Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Kolam Renang Alam Kertabumi',
                'slug' => 'kolam-renang-alam-kertabumi',
                'foto' => 'KolamRenangAlamJF.jpeg',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Kertabumi, Kecamatan Cijeungjing',
                'deskripsi_singkat' => 'Kolam renang alami bersumber dari mata air pegunungan yang jernih dan segar. Tersedia kolam untuk anak-anak dan dewasa dengan lingkungan alam yang asri.',
                'fasilitas' => ['Kolam Renang Alam', 'Kolam Anak Aman', 'Ruang Bilas & Toilet', 'Warung Kuliner'],
            ],
        ],
    ],

    'kertajaya' => [
        'nama_desa' => 'Desa Kertajaya',
        'kecamatan' => 'Panawangan',
        'foto_banner' => 'PuncakKartajaya.jpeg',
        'deskripsi_desa' => 'Desa Kertajaya di Kecamatan Panawangan menawarkan Puncak Kertajaya dengan panorama alam yang menakjubkan. Bukit ini menjadi destinasi favorit para petualang dan pecinta alam yang ingin menikmati bentangan hijau lembah Panawangan dari ketinggian, sambil menikmati udara segar pegunungan Priangan Timur.',
        'destinasi' => [
            [
                'nama' => 'Puncak Kertajaya',
                'slug' => 'puncak-kertajaya',
                'foto' => 'PuncakKartajaya.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Kertajaya, Kecamatan Panawangan',
                'deskripsi_singkat' => 'Puncak bukit dengan panorama lembah dan perbukitan yang sangat memanjakan. Jalur trekking yang nyaman melalui kebun dan hutan menjadikannya pengalaman petualangan yang berkesan.',
                'fasilitas' => ['Jalur Trekking', 'Spot Panorama Ketinggian', 'Warung Kopi Puncak', 'Area Parkir'],
            ],
        ],
    ],

    'kertamandala' => [
        'nama_desa' => 'Desa Kertamandala',
        'kecamatan' => 'Panjalu',
        'foto_banner' => 'SituLengkongPanjalu.jpeg',
        'deskripsi_desa' => 'Desa Kertamandala di Kecamatan Panjalu berbatasan langsung dengan Situ Lengkong Panjalu, danau suci yang menjadi ikon pariwisata Ciamis. Desa ini memiliki peran penting dalam ekosistem wisata Panjalu dengan menyediakan akses, penginapan warga, dan layanan perahu untuk wisatawan yang ingin mengelilingi pulau Nusa Gede di tengah danau.',
        'destinasi' => [
            [
                'nama' => 'Situ Lengkong Panjalu',
                'slug' => 'situ-lengkong-panjalu',
                'foto' => 'SituLengkongPanjalu.jpeg',
                'kategori' => 'Wisata Alam & Budaya',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Kertamandala, Kecamatan Panjalu',
                'deskripsi_singkat' => 'Danau suci Panjalu dengan Pulau Nusa Gede di tengahnya—rumah hutan tutupan kramat yang mistis. Berkeliling danau dengan perahu kayu sambil menikmati keindahan alam dan nilai spiritualnya.',
                'fasilitas' => ['Perahu Tradisional', 'Dermaga Wisata', 'Area Ziarah Nusa Gede', 'Warung Kuliner'],
            ],
        ],
    ],

    'maparah' => [
        'nama_desa' => 'Desa Maparah',
        'kecamatan' => 'Panjalu',
        'foto_banner' => 'Cipanjalu.jpeg',
        'deskripsi_desa' => 'Desa Maparah di Kecamatan Panjalu memiliki kekayaan alam sumber air panas dan wisata sungai yang menyegarkan. Cipanjalu menjadi destinasi wisata air alam yang populer dengan kolam rendam air panas alami dan pemandangan alam sungai yang jernih.',
        'destinasi' => [
            [
                'nama' => 'Pemandian Cipanjalu',
                'slug' => 'cipanjalu',
                'foto' => 'Cipanjalu.jpeg',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Maparah, Kecamatan Panjalu',
                'deskripsi_singkat' => 'Pemandian alam sungai dengan air jernih segar khas pegunungan Panjalu. Suasana alami dengan pepohonan rindang di tepi sungai yang sangat cocok untuk relaksasi.',
                'fasilitas' => ['Area Kolam Alam', 'Saung Istirahat', 'Warung Kuliner', 'Toilet & Ruang Bilas'],
            ],
        ],
    ],

    'mekarsari' => [
        'nama_desa' => 'Desa Mekarsari',
        'kecamatan' => 'Panumbangan',
        'foto_banner' => 'BukitCikulak.jpeg',
        'deskripsi_desa' => 'Desa Mekarsari di Kecamatan Panumbangan memiliki Bukit Cikulak sebagai destinasi wisata alam andalannya. Perbukitan dengan lansekap hutan pinus yang sejuk ini menjadi pilihan para pencinta alam dan fotografer yang ingin mengabadikan keindahan alam Priangan dari ketinggian.',
        'destinasi' => [
            [
                'nama' => 'Bukit Cikulak',
                'slug' => 'bukit-cikulak',
                'foto' => 'BukitCikulak.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Mekarsari, Kecamatan Panumbangan',
                'deskripsi_singkat' => 'Bukit pinus yang rindang dengan jalur pendakian santai dan pemandangan lembah yang memesona. Favorit para fotografer untuk mengabadikan golden hour di atas awan.',
                'fasilitas' => ['Jalur Trekking Santai', 'Hutan Pinus', 'Spot Foto', 'Warung Kopi'],
            ],
        ],
    ],

    'nasol' => [
        'nama_desa' => 'Desa Nasol',
        'kecamatan' => 'Cikoneng',
        'foto_banner' => 'CurugSalosin.jpeg',
        'deskripsi_desa' => 'Desa Nasol di Kecamatan Cikoneng memiliki Curug Salosin sebagai destinasi wisata air terjun alami yang menawan. Air terjun ini mengalir deras dari celah bebatuan purba di tengah hutan tropis yang rimbun, menawarkan kesegaran dan keindahan alam tersembunyi yang belum banyak diketahui wisatawan.',
        'destinasi' => [
            [
                'nama' => 'Curug Salosin',
                'slug' => 'curug-salosin',
                'foto' => 'CurugSalosin.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Nasol, Kecamatan Cikoneng',
                'deskripsi_singkat' => 'Air terjun alami tersembunyi di balik hutan tropis yang rimbun. Percikan air yang menyegarkan dan suasana alam yang tenang menjadikannya surga tersembunyi Cikoneng.',
                'fasilitas' => ['Kolam Alami', 'Jalur Trekking Hutan', 'Area Piknik', 'Warung Ringan'],
            ],
        ],
    ],

    'padamulya' => [
        'nama_desa' => 'Desa Padamulya',
        'kecamatan' => 'Cipaku',
        'foto_banner' => 'JembatanSwiss.jpeg',
        'deskripsi_desa' => 'Desa Padamulya di Kecamatan Cipaku terkenal dengan Jembatan Swiss dan Kolam Renang Jembatan Swiss—kawasan wisata air yang dibangun dengan infrastruktur berkualitas tinggi terinspirasi arsitektur Eropa. Desa ini menjadi salah satu destinasi wisata keluarga terpopuler di Kabupaten Ciamis dengan fasilitas lengkap dan alam yang asri.',
        'destinasi' => [
            [
                'nama' => 'Jembatan Swiss Cipaku',
                'slug' => 'jembatan-swiss',
                'foto' => 'JembatanSwiss.jpeg',
                'kategori' => 'Wisata Buatan',
                'kategori_badge' => 'primary',
                'harga' => 15000,
                'lokasi_detail' => 'Desa Padamulya, Kecamatan Cipaku',
                'deskripsi_singkat' => 'Jembatan cantik terinspirasi arsitektur Swiss yang melintasi sungai jernih. Spot foto yang sangat populer dengan latar jembatan indah dan alam sungai yang mempesona.',
                'fasilitas' => ['Jembatan Hias Instagramable', 'Area Foto Premium', 'Kolam Renang', 'Warung Kuliner'],
            ],
            [
                'nama' => 'Kolam Renang Jembatan Swiss',
                'slug' => 'kolam-renang-jembatan-swiss',
                'foto' => 'KolanRenangJembatanSwiss.webp',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 15000,
                'lokasi_detail' => 'Desa Padamulya, Kecamatan Cipaku',
                'deskripsi_singkat' => 'Kolam renang modern tepi sungai dengan fasilitas lengkap dan pemandangan alam yang indah. Sangat cocok untuk wisata keluarga dan anak-anak di akhir pekan.',
                'fasilitas' => ['Kolam Dewasa & Anak', 'Ruang Bilas', 'Penyewaan Pelampung', 'Kantin'],
            ],
        ],
    ],

    'panjalu' => [
        'nama_desa' => 'Desa Panjalu',
        'kecamatan' => 'Panjalu',
        'foto_banner' => 'SituLengkongPanjalu.jpeg',
        'deskripsi_desa' => 'Desa Panjalu adalah desa wisata pusat Kecamatan Panjalu yang terkenal dengan Situ Lengkong, danau alam sakral warisan Kerajaan Galuh. Desa ini memiliki nilai sejarah tinggi dan menjadi pusat kegiatan wisata budaya, ziarah, dan ekowisata. Panjalu juga dikenal dengan produk kerajinan kayu dan batik motif Galuh yang menjadi oleh-oleh khas.',
        'destinasi' => [
            [
                'nama' => 'Situ Lengkong Panjalu',
                'slug' => 'situ-lengkong-panjalu',
                'foto' => 'SituLengkongPanjalu.jpeg',
                'kategori' => 'Wisata Alam & Budaya',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Panjalu, Kecamatan Panjalu',
                'deskripsi_singkat' => 'Danau sakral dengan Pulau Nusa Gede di tengahnya yang menjadi ikon wisata Panjalu. Berkeliling danau menggunakan perahu kayu sambil menikmati nuansa spiritual dan keindahan alam.',
                'fasilitas' => ['Perahu Tradisional', 'Dermaga Wisata', 'Museum Panjalu', 'Warung Kuliner'],
            ],
        ],
    ],

    'panyingkiran' => [
        'nama_desa' => 'Desa Panyingkiran',
        'kecamatan' => 'Panyingkiran',
        'foto_banner' => 'DesaAdatSejahtera.jpeg',
        'deskripsi_desa' => 'Desa Panyingkiran di Kecamatan Panyingkiran merupakan desa adat yang masih menjaga tradisi dan kearifan lokal Sunda dengan sangat baik. Desa adat ini menjadi tujuan wisata budaya untuk mempelajari adat istiadat, arsitektur rumah tradisional Sunda, dan pertunjukan seni budaya yang diwariskan turun-temurun.',
        'destinasi' => [
            [
                'nama' => 'Desa Adat Panyingkiran',
                'slug' => 'desa-adat-panyingkiran',
                'foto' => 'DesaAdatSejahtera.jpeg',
                'kategori' => 'Wisata Budaya',
                'kategori_badge' => 'warning',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Panyingkiran, Kecamatan Panyingkiran',
                'deskripsi_singkat' => 'Desa adat yang masih mempertahankan tradisi dan arsitektur Sunda autentik. Tersedia paket wisata budaya, pertunjukan seni, dan pengalaman tinggal di rumah adat.',
                'fasilitas' => ['Rumah Adat Tradisional', 'Sanggar Seni Budaya', 'Pemandu Wisata Budaya', 'Toko Kerajinan'],
            ],
        ],
    ],

    'pukasari' => [
        'nama_desa' => 'Desa Pukasari',
        'kecamatan' => 'Lopari',
        'foto_banner' => 'CurugPanganten.jpeg',
        'deskripsi_desa' => 'Desa Pukasari di Kecamatan Lopari memiliki Curug Panganten sebagai destinasi utama—air terjun romantis yang dikelilingi hutan tropis lembap dengan kolam alami di bawahnya. Keindahan dan suasana alami Curug Panganten menjadikannya salah satu destinasi wisata alam paling romantis dan menawan di Kabupaten Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Curug Panganten',
                'slug' => 'curug-panganten',
                'foto' => 'CurugPanganten.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Pukasari, Kecamatan Lopari',
                'deskripsi_singkat' => 'Air terjun romantis di tengah hutan tropis dengan kolam alami yang jernih. Jalur trekking menuju air terjun melalui hutan lebat menambah pengalaman petualangan yang berkesan.',
                'fasilitas' => ['Kolam Alami', 'Jalur Trekking Hutan', 'Area Piknik Tepi Air', 'Warung Ringan'],
            ],
        ],
    ],

    'rajadesa' => [
        'nama_desa' => 'Desa Rajadesa',
        'kecamatan' => 'Rajadesa',
        'foto_banner' => 'PuncakUpsa.jpeg',
        'deskripsi_desa' => 'Desa Rajadesa merupakan pusat pemerintahan Kecamatan Rajadesa yang mengembangkan wisata alam perbukitan dan udara segar pegunungan. Puncak Upsa menjadi destinasi andalan dengan panorama bukit yang menakjubkan, sangat populer di kalangan pencinta alam dan pemuda Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Puncak Upsa Rajadesa',
                'slug' => 'puncak-upsa',
                'foto' => 'PuncakUpsa.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Rajadesa, Kecamatan Rajadesa',
                'deskripsi_singkat' => 'Puncak bukit dengan pemandangan spektakuler ke arah lembah dan perbukitan sekitarnya. Spot favorit untuk menikmati ketenangan alam dan matahari terbit yang indah.',
                'fasilitas' => ['Spot Panorama', 'Jalur Pendakian', 'Area Istirahat', 'Warung Ringan'],
            ],
        ],
    ],

    'raksabaya' => [
        'nama_desa' => 'Desa Raksabaya',
        'kecamatan' => 'Cimaragas',
        'foto_banner' => 'SituCibubuhan.webp',
        'deskripsi_desa' => 'Desa Raksabaya di Kecamatan Cimaragas memiliki Situ Cibubuhan sebagai destinasi wisata danau alami yang tenang dan asri. Danau ini dikelilingi perbukitan hijau dan hamparan sawah yang menawarkan suasana pedesaan yang damai, cocok untuk kegiatan memancing, berperahu, dan menikmati alam Priangan.',
        'destinasi' => [
            [
                'nama' => 'Situ Cibubuhan',
                'slug' => 'situ-cibubuhan',
                'foto' => 'SituCibubuhan.webp',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Raksabaya, Kecamatan Cimaragas',
                'deskripsi_singkat' => 'Danau alami tenang dikelilingi perbukitan hijau yang mempesona. Aktivitas memancing dan berperahu dengan latar alam danau yang damai dan pemandangan yang menyejukkan.',
                'fasilitas' => ['Wahana Perahu', 'Area Memancing', 'Warung Tepi Danau', 'Area Parkir'],
            ],
        ],
    ],

    'sadeweata' => [
        'nama_desa' => 'Desa Sadeweata',
        'kecamatan' => 'Lumbung',
        'foto_banner' => 'KampungBangur.jpeg',
        'deskripsi_desa' => 'Desa Sadeweata di Kecamatan Lumbung mengembangkan wisata budaya dengan Kampung Bangur sebagai sentra kerajinan dan budaya lokal. Desa ini aktif melestarikan tradisi kesenian Sunda sambil membuka diri bagi wisatawan yang ingin mengenal kebudayaan dan kehidupan pedesaan Priangan yang autentik.',
        'destinasi' => [
            [
                'nama' => 'Kampung Bangur Sadeweata',
                'slug' => 'kampung-bangur',
                'foto' => 'KampungBangur.jpeg',
                'kategori' => 'Wisata Budaya',
                'kategori_badge' => 'warning',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sadeweata, Kecamatan Lumbung',
                'deskripsi_singkat' => 'Kampung wisata budaya dengan pertunjukan seni dan kerajinan lokal khas Sunda. Suasana pedesaan yang tenang dengan keramahan warga menjadi daya tarik tersendiri.',
                'fasilitas' => ['Galeri Kerajinan', 'Pertunjukan Seni', 'Homestay Warga', 'Warung Kuliner Lokal'],
            ],
        ],
    ],

    'sagalaherang' => [
        'nama_desa' => 'Desa Sagalaherang',
        'kecamatan' => 'Panumbangan',
        'foto_banner' => 'PasirBoma.jpeg',
        'deskripsi_desa' => 'Desa Sagalaherang di Kecamatan Panumbangan memiliki Pasir Boma sebagai destinasi wisata alam perbukitan yang populer. Desa ini memanfaatkan kekayaan alam hutan dan bukit untuk wisata trekking, bumi perkemahan, dan pengamatan alam yang menarik bagi wisatawan minat khusus.',
        'destinasi' => [
            [
                'nama' => 'Pasir Boma Sagalaherang',
                'slug' => 'pasir-boma',
                'foto' => 'PasirBoma.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sagalaherang, Kecamatan Panumbangan',
                'deskripsi_singkat' => 'Perbukitan alami dengan hutan lebat dan pemandangan yang memukau. Cocok untuk kegiatan trekking, berkemah, dan pengamatan alam di kawasan perbukitan Panumbangan.',
                'fasilitas' => ['Jalur Trekking', 'Area Camping', 'Spot Pandang', 'Warung Ringan'],
            ],
        ],
    ],

    'sandingtaman' => [
        'nama_desa' => 'Desa Sandingtaman',
        'kecamatan' => 'Panjalu',
        'foto_banner' => 'CurugPanganten.jpeg',
        'deskripsi_desa' => 'Desa Sandingtaman di Kecamatan Panjalu merupakan desa wisata yang kaya akan potensi alam dengan beberapa air terjun dan sumber mata air yang segar. Desa ini berkomitmen mengembangkan ekowisata berbasis komunitas untuk menjaga kelestarian alam sekaligus meningkatkan kesejahteraan masyarakat lokal.',
        'destinasi' => [
            [
                'nama' => 'Wisata Alam Sandingtaman',
                'slug' => 'sandingtaman',
                'foto' => 'CurugPanganten.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sandingtaman, Kecamatan Panjalu',
                'deskripsi_singkat' => 'Kawasan ekowisata dengan air terjun, mata air segar, dan hutan tropis yang masih alami. Dikembangkan berbasis komunitas untuk pengalaman wisata alam yang autentik.',
                'fasilitas' => ['Jalur Ekowisata', 'Air Terjun', 'Mata Air Segar', 'Warung Ringan'],
            ],
        ],
    ],

    'selamanik' => [
        'nama_desa' => 'Desa Selamanik',
        'kecamatan' => 'Cipaku',
        'foto_banner' => 'selamanik.jpeg',
        'deskripsi_desa' => 'Desa Selamanik di Kecamatan Cipaku memiliki kekayaan alam berupa pemandangan hamparan perbukitan dan sungai yang memukau. Destinasi wisata Selamanik menawarkan pengalaman alam pedesaan yang autentik dengan aktivitas trekking ringan dan menikmati keindahan lanskap alam Priangan.',
        'destinasi' => [
            [
                'nama' => 'Wisata Alam Selamanik',
                'slug' => 'selamanik',
                'foto' => 'selamanik.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Selamanik, Kecamatan Cipaku',
                'deskripsi_singkat' => 'Kawasan wisata alam dengan pemandangan perbukitan dan hamparan persawahan yang indah. Sangat cocok untuk trekking santai, berfoto, dan menikmati udara segar pedesaan.',
                'fasilitas' => ['Jalur Trekking Ringan', 'Spot Foto Panorama', 'Area Istirahat', 'Warung Kuliner'],
            ],
        ],
    ],

    'sidamulih' => [
        'nama_desa' => 'Desa Sidamulih',
        'kecamatan' => 'Sidamulih',
        'foto_banner' => 'PemandianAirPanas.webp',
        'deskripsi_desa' => 'Desa Sidamulih di Kecamatan Sidamulih memiliki sumber air panas alami yang telah lama dimanfaatkan sebagai pemandian tradisional. Pemandian air panas Sidamulih menawarkan sensasi relaksasi mandi air panas belerang alami yang dipercaya memiliki khasiat kesehatan, menjadikannya tujuan wisata wellness yang populer di Kabupaten Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Pemandian Air Panas Sidamulih',
                'slug' => 'pemandian-air-panas-sidamulih',
                'foto' => 'PemandianAirPanas.webp',
                'kategori' => 'Wisata Kesehatan',
                'kategori_badge' => 'info',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sidamulih, Kecamatan Sidamulih',
                'deskripsi_singkat' => 'Pemandian air panas belerang alami dengan khasiat kesehatan yang sudah dikenal lama. Tersedia kolam rendam individu dan keluarga untuk pengalaman relaksasi yang menyehatkan.',
                'fasilitas' => ['Kolam Air Panas Alam', 'Kolam Rendam Keluarga', 'Ruang Bilas', 'Warung Kuliner'],
            ],
        ],
    ],

    'situmandala' => [
        'nama_desa' => 'Desa Situmandala',
        'kecamatan' => 'Rancah',
        'foto_banner' => 'PinusBatuCakra.jpeg',
        'deskripsi_desa' => 'Desa Situmandala di Kecamatan Rancah memiliki kawasan hutan pinus Batu Cakra yang sangat indah dan cocok untuk wisata alam dan fotografi. Desa ini mengembangkan pariwisata berbasis hutan pinus dengan jalur trekking yang baik dan spot foto yang sangat instagramable di antara rimbunnya pepohonan pinus.',
        'destinasi' => [
            [
                'nama' => 'Pinus Batu Cakra',
                'slug' => 'pinus-batu-cakra',
                'foto' => 'PinusBatuCakra.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Situmandala, Kecamatan Rancah',
                'deskripsi_singkat' => 'Hutan pinus dengan formasi batu unik yang sangat fotogenik. Suasana sejuk di bawah rimbunnya pinus dengan sinar matahari yang memfilter masuk menciptakan pemandangan magis.',
                'fasilitas' => ['Jalur Hutan Pinus', 'Spot Foto Instagramable', 'Area Piknik', 'Warung Ringan'],
            ],
        ],
    ],

    'situwangi' => [
        'nama_desa' => 'Desa Winduraja',
        'kecamatan' => 'Kawali',
        'foto_banner' => 'SituWangi.jpeg',
        'deskripsi_desa' => 'Desa Winduraja di Kecamatan Kawali merupakan rumah bagi Situ Wangi, salah satu destinasi wisata danau paling terkenal dan populer di Kabupaten Ciamis. Kawasan danau ini telah direvitalisasi dengan fasilitas modern lengkap termasuk wahana air, jogging track, dan view tower, menjadikannya destinasi wisata keluarga terpopuler di Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Situ Wangi',
                'slug' => 'situ-wangi',
                'foto' => 'SituWangi.jpeg',
                'kategori' => 'Wisata Alam & Air',
                'kategori_badge' => 'success',
                'harga' => 6500,
                'lokasi_detail' => 'Desa Winduraja, Kecamatan Kawali',
                'deskripsi_singkat' => 'Danau alam yang telah direvitalisasi menjadi destinasi wisata keluarga modern. Tersedia wahana perahu bebek, jogging track tepi danau, view tower, area memancing, dan spot foto tepi air yang indah.',
                'fasilitas' => ['Wahana Perahu Bebek', 'Jogging Track Keliling Danau', 'View Tower', 'Area Memancing', 'Toilet & Parkir'],
            ],
        ],
    ],

    'sukadana' => [
        'nama_desa' => 'Desa Sukadana',
        'kecamatan' => 'Langkaplancar',
        'foto_banner' => 'SukaPulang.jpeg',
        'deskripsi_desa' => 'Desa Sukadana di Kecamatan Langkaplancar menawarkan pengalaman wisata alam dan budaya pedesaan yang autentik di kawasan perbukitan Priangan Timur. Desa ini memiliki kekayaan alam berupa hutan dan sumber air yang masih alami, dipadukan dengan tradisi kehidupan petani Sunda yang kental.',
        'destinasi' => [
            [
                'nama' => 'Wisata Alam Sukadana',
                'slug' => 'sukadana',
                'foto' => 'SukaPulang.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sukadana, Kecamatan Langkaplancar',
                'deskripsi_singkat' => 'Kawasan wisata alam pedesaan dengan pemandangan hutan, persawahan, dan kehidupan petani Sunda yang autentik. Pengalaman ekowisata yang menyegarkan jiwa dan raga.',
                'fasilitas' => ['Jalur Ekowisata', 'Spot Foto Alam', 'Homestay Warga', 'Warung Kuliner Lokal'],
            ],
        ],
    ],

    'sukahurip' => [
        'nama_desa' => 'Desa Sukahurip',
        'kecamatan' => 'Panumbangan',
        'foto_banner' => 'BuperAkiKabayan.jpeg',
        'deskripsi_desa' => 'Desa Sukahurip di Kecamatan Panumbangan dikenal dengan Bumi Perkemahan Aki Kabayan yang sarat nuansa budaya Sunda legendaris. Destinasi ini terinspirasi kisah rakyat Si Kabayan yang populer, menawarkan pengalaman berkemah dengan suasana kampung Sunda yang autentik, pertunjukan seni budaya, dan wisata edukasi kearifan lokal.',
        'destinasi' => [
            [
                'nama' => 'Bumi Perkemahan Aki Kabayan',
                'slug' => 'bumi-perkemahan-aki-kabayan',
                'foto' => 'BuperAkiKabayan.jpeg',
                'kategori' => 'Wisata Budaya & Alam',
                'kategori_badge' => 'warning',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sukahurip, Kecamatan Panumbangan',
                'deskripsi_singkat' => 'Bumi perkemahan bertema budaya Si Kabayan dengan nuansa kampung Sunda autentik. Tersedia pertunjukan seni tradisional, edukasi kearifan lokal, dan berbagai kegiatan budaya menarik.',
                'fasilitas' => ['Area Camping Ground', 'Panggung Seni Budaya', 'Sanggar Edukasi Lokal', 'Warung Kuliner Sunda'],
            ],
        ],
    ],

    'sukajaya' => [
        'nama_desa' => 'Desa Sukajaya',
        'kecamatan' => 'Lakbok',
        'foto_banner' => 'KampungTeratai.jpeg',
        'deskripsi_desa' => 'Desa Sukajaya di Kecamatan Lakbok memiliki keunikan Kampung Teratai dengan telaga yang dipenuhi bunga teratai indah berwarna-warni. Pemandangan hamparan teratai di atas air yang membentang luas menjadikan desa ini sebagai spot fotografi alam yang sangat populer dan instagramable di Kabupaten Ciamis.',
        'destinasi' => [
            [
                'nama' => 'Kampung Teratai Sukajaya',
                'slug' => 'kampung-teratai',
                'foto' => 'KampungTeratai.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sukajaya, Kecamatan Lakbok',
                'deskripsi_singkat' => 'Kampung dengan telaga cantik dipenuhi bunga teratai warna-warni yang bermekaran. Spot fotografi alam yang sangat populer dan romantis, terutama di pagi hari saat bunga mekar penuh.',
                'fasilitas' => ['Telaga Teratai', 'Jembatan Kayu Tepi Telaga', 'Spot Foto', 'Warung Ringan'],
            ],
        ],
    ],

    'sukamaju' => [
        'nama_desa' => 'Desa Sukamaju',
        'kecamatan' => 'Cihaurbeuti',
        'foto_banner' => 'CiawadeJpeg',
        'foto_banner' => 'Ciawade.jpeg',
        'deskripsi_desa' => 'Desa Sukamaju di Kecamatan Cihaurbeuti memiliki kawasan wisata air Ciawade yang menawarkan kesegaran air sungai di pegunungan. Desa ini berkembang pesat sebagai destinasi wisata air alam keluarga yang terjangkau dan menyenangkan.',
        'destinasi' => [
            [
                'nama' => 'Wisata Air Ciawade',
                'slug' => 'ciawade',
                'foto' => 'Ciawade.jpeg',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sukamaju, Kecamatan Cihaurbeuti',
                'deskripsi_singkat' => 'Kawasan wisata air sungai yang jernih dan segar. Sangat cocok untuk anak-anak bermain air dengan pengawasan, bersantai di tepi sungai, dan menikmati alam pedesaan yang asri.',
                'fasilitas' => ['Area Bermain Air', 'Saung Istirahat', 'Warung Kuliner', 'Toilet Umum'],
            ],
        ],
    ],

    'sukaresik' => [
        'nama_desa' => 'Desa Sukaresik',
        'kecamatan' => 'Panumbangan',
        'foto_banner' => 'PuncakManik.jpeg',
        'deskripsi_desa' => 'Desa Sukaresik di Kecamatan Panumbangan memiliki Puncak Manik sebagai destinasi alam unggulannya. Puncak bukit ini menawarkan panorama 360 derajat yang menakjubkan ke segala arah, menjadikannya salah satu spot terbaik untuk menikmati keindahan alam Kabupaten Ciamis dari ketinggian.',
        'destinasi' => [
            [
                'nama' => 'Puncak Manik',
                'slug' => 'puncak-manik',
                'foto' => 'PuncakManik.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sukaresik, Kecamatan Panumbangan',
                'deskripsi_singkat' => 'Puncak bukit dengan panorama 360 derajat yang menakjubkan. Spot terbaik menikmati hamparan alam Ciamis, mulai dari sawah, lembah, hingga barisan pegunungan Priangan.',
                'fasilitas' => ['Spot Panorama 360°', 'Jalur Pendakian', 'Gardu Pandang', 'Warung Kopi Puncak'],
            ],
        ],
    ],

    'sukasenang' => [
        'nama_desa' => 'Desa Sukasenang',
        'kecamatan' => 'Banjarsari',
        'foto_banner' => 'GunungPadang.jpeg',
        'deskripsi_desa' => 'Desa Sukasenang di Kecamatan Banjarsari memiliki kekayaan wisata alam berupa Gunung Padang dengan lansekap hutan dan perbukitan yang indah. Desa ini cocok bagi wisatawan yang ingin menikmati ketenangan alam pedesaan dan jalur pendakian ringan sambil menikmati udara sejuk pegunungan Priangan.',
        'destinasi' => [
            [
                'nama' => 'Gunung Padang Sukasenang',
                'slug' => 'gunung-padang',
                'foto' => 'GunungPadang.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sukasenang, Kecamatan Banjarsari',
                'deskripsi_singkat' => 'Kawasan perbukitan dengan lansekap alam yang masih terjaga keasliannya. Jalur pendakian ringan dengan pemandangan indah di setiap ketinggian menjadikannya pilihan tepat untuk wisata petualangan.',
                'fasilitas' => ['Jalur Pendakian Ringan', 'Spot Panorama', 'Area Istirahat', 'Warung Ringan'],
            ],
        ],
    ],

    'sukasetia' => [
        'nama_desa' => 'Desa Sukasetia',
        'kecamatan' => 'Cisaga',
        'foto_banner' => 'BukitSemparanAsli.jpeg',
        'deskripsi_desa' => 'Desa Sukasetia di Kecamatan Cisaga menawarkan pesona Bukit Semparan yang sangat memukau dengan pemandangan panorama alam Ciamis yang luar biasa. Desa ini aktif mengembangkan wisata alam petualangan yang berkelanjutan dengan melibatkan pemuda lokal sebagai pemandu wisata profesional.',
        'destinasi' => [
            [
                'nama' => 'Bukit Semparan Sukasetia',
                'slug' => 'bukit-semparan',
                'foto' => 'BukitSemparanAsli.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sukasetia, Kecamatan Cisaga',
                'deskripsi_singkat' => 'Bukit dengan pemandangan panorama alam yang sangat spektakuler. Jalur pendakian yang terawat dengan baik dan pemandu lokal menjadikan pengalaman petualangan semakin berkesan.',
                'fasilitas' => ['Jalur Pendakian Terawat', 'Pemandu Wisata Lokal', 'Spot Foto Panorama', 'Area Parkir'],
            ],
        ],
    ],

    'sukawening' => [
        'nama_desa' => 'Desa Sukawening',
        'kecamatan' => 'Cipaku',
        'foto_banner' => 'SungaiCiharus.jpeg',
        'deskripsi_desa' => 'Desa Sukawening di Kecamatan Cipaku memiliki kekayaan alam berupa Sungai Ciharus yang menawarkan aktivitas wisata air yang menyenangkan. Kejernihan air sungai dan alam sekitarnya yang masih terjaga menjadikan Sukawening sebagai destinasi wisata air alam yang menyegarkan dan terjangkau.',
        'destinasi' => [
            [
                'nama' => 'Sungai Ciharus Sukawening',
                'slug' => 'sungai-ciharus',
                'foto' => 'SungaiCiharus.jpeg',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Sukawening, Kecamatan Cipaku',
                'deskripsi_singkat' => 'Sungai dengan air jernih segar khas pegunungan yang menjadi spot berenang dan bermain air favorit. Tepi sungai yang rindang dengan bebatuan alami menciptakan suasana alam yang menyejukkan.',
                'fasilitas' => ['Area Renang Alam', 'Bermain Air Anak', 'Saung Tepi Sungai', 'Warung Kuliner'],
            ],
        ],
    ],

    'sumberjaya' => [
        'nama_desa' => 'Desa Sumberjaya',
        'kecamatan' => 'Cihaurbeuti',
        'foto_banner' => 'BumiPekemahan.jpeg',
        'deskripsi_desa' => 'Desa Sumberjaya di Kecamatan Cihaurbeuti memiliki kawasan Taman Wisata dan Bumi Perkemahan Nanggela yang menjadi destinasi wisata keluarga dan petualangan yang populer. Dikelilingi perbukitan berhawa sejuk dengan pepohonan rindang, desa ini menawarkan pengalaman berkemah, outbound, dan rekreasi keluarga di alam terbuka yang menyegarkan.',
        'destinasi' => [
            [
                'nama' => 'Taman Wisata Sumberjaya',
                'slug' => 'taman-wisata-sumberjaya',
                'foto' => 'BumiPekemahan.jpeg',
                'kategori' => 'Wisata Buatan',
                'kategori_badge' => 'primary',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sumberjaya, Kecamatan Cihaurbeuti',
                'deskripsi_singkat' => 'Taman rekreasi keluarga di lereng bukit dengan pepohonan rindang dan udara segar. Menyediakan ragam wahana keluarga dan area bersantai yang nyaman di alam terbuka.',
                'fasilitas' => ['Area Bermain Keluarga', 'Spot Foto Alam', 'Warung Kuliner', 'Area Parkir'],
            ],
            [
                'nama' => 'Bumi Perkemahan Nanggela',
                'slug' => 'bumi-perkemahan-nanggela',
                'foto' => 'BumiPekemahan.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 10000,
                'lokasi_detail' => 'Desa Sumberjaya, Kecamatan Cihaurbeuti',
                'deskripsi_singkat' => 'Lahan perkemahan seluas 0,7 hektar di lereng bukit pinus. Sangat populer untuk pramuka, outbound, dan perkemahan komunitas dengan fasilitas yang lengkap.',
                'fasilitas' => ['Lahan Camping 0,7 Ha', 'MCK Bersih', 'Api Unggun', 'Fasilitas Outbound'],
            ],
        ],
    ],

    'talagasari' => [
        'nama_desa' => 'Desa Talagasari',
        'kecamatan' => 'Kawali',
        'foto_banner' => 'WinduRaja.jpeg',
        'deskripsi_desa' => 'Desa Talagasari di Kecamatan Kawali berdekatan dengan kawasan wisata Kawali yang kaya sejarah dan alam. Desa ini memiliki potensi wisata sejarah Winduraja dan wisata alam yang terus dikembangkan untuk menarik lebih banyak wisatawan ke kawasan Kawali.',
        'destinasi' => [
            [
                'nama' => 'Wisata Alam Winduraja',
                'slug' => 'winduraja',
                'foto' => 'WinduRaja.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Talagasari, Kecamatan Kawali',
                'deskripsi_singkat' => 'Kawasan wisata alam dengan pemandangan perbukitan dan hamparan persawahan yang khas kawasan Kawali. Cocok untuk bersantai dan menikmati ketenangan alam pedesaan.',
                'fasilitas' => ['Spot Foto Panorama', 'Area Piknik', 'Warung Ringan', 'Area Parkir'],
            ],
        ],
    ],

    'tanjungsari' => [
        'nama_desa' => 'Desa Tanjungsari',
        'kecamatan' => 'Sadananya',
        'foto_banner' => 'CireongJpeg',
        'foto_banner' => 'Cireong.jpeg',
        'deskripsi_desa' => 'Desa Tanjungsari di Kecamatan Sadananya memiliki potensi wisata sungai Cireong yang sangat indah dengan kejernihan air dan bebatuan sungai yang khas. Desa ini mengembangkan wisata sungai sebagai daya tarik utama dengan berbagai aktivitas air yang menyenangkan bagi seluruh anggota keluarga.',
        'destinasi' => [
            [
                'nama' => 'Sungai Cireong Tanjungsari',
                'slug' => 'sungai-cireong',
                'foto' => 'Cireong.jpeg',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Tanjungsari, Kecamatan Sadananya',
                'deskripsi_singkat' => 'Sungai Cireong yang jernih dengan bebatuan alam dan arus yang segar. Cocok untuk berenang, bermain air bersama keluarga, dan menikmati alam pedesaan yang asri.',
                'fasilitas' => ['Area Renang Sungai', 'Bermain Air', 'Saung Istirahat', 'Warung Kuliner'],
            ],
        ],
    ],

    'wanasigra' => [
        'nama_desa' => 'Desa Wanasigra',
        'kecamatan' => 'Sindangkasih',
        'foto_banner' => 'CidehemJpeg',
        'foto_banner' => 'Cidehem.jpeg',
        'deskripsi_desa' => 'Desa Wanasigra di Kecamatan Sindangkasih merupakan desa wisata yang kaya akan potensi alam hutan dan sungai. Kawasan wisata alam Cidehem menjadi daya tarik utama dengan keindahan alam sungai dan hutan yang masih alami, menawarkan pengalaman ekowisata yang menyegarkan dan mendalam.',
        'destinasi' => [
            [
                'nama' => 'Wisata Alam Cidehem',
                'slug' => 'cidehem',
                'foto' => 'Cidehem.jpeg',
                'kategori' => 'Wisata Alam',
                'kategori_badge' => 'success',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Wanasigra, Kecamatan Sindangkasih',
                'deskripsi_singkat' => 'Kawasan ekowisata dengan keindahan sungai jernih dan hutan tropis yang masih alami. Pengalaman berwisata alam yang mendalam sambil menikmati keanekaragaman hayati lokal.',
                'fasilitas' => ['Jalur Ekowisata', 'Area Sungai', 'Spot Foto Alam', 'Warung Ringan'],
            ],
        ],
    ],

    'werasari' => [
        'nama_desa' => 'Desa Werasari',
        'kecamatan' => 'Sadananya',
        'foto_banner' => 'CibagJpeg',
        'foto_banner' => 'Cibagi.jpeg',
        'deskripsi_desa' => 'Desa Werasari di Kecamatan Sadananya memiliki potensi wisata alam sungai Cibagi yang menarik. Kejernihan air sungai dan tebing-tebing alam di sekitarnya menjadikan Werasari sebagai destinasi wisata air alam yang segar dan menantang bagi pecinta aktivitas outdoor.',
        'destinasi' => [
            [
                'nama' => 'Wisata Sungai Cibagi',
                'slug' => 'cibagi',
                'foto' => 'Cibagi.jpeg',
                'kategori' => 'Wisata Air',
                'kategori_badge' => 'info',
                'harga' => 7500,
                'lokasi_detail' => 'Desa Werasari, Kecamatan Sadananya',
                'deskripsi_singkat' => 'Sungai Cibagi dengan tebing-tebing alam dan air jernih yang menantang. Menawarkan aktivitas berenang, panjat tebing mini, dan eksplorasi alam sungai yang seru.',
                'fasilitas' => ['Area Renang Sungai', 'Tebing Alami', 'Area Piknik', 'Warung Kuliner'],
            ],
        ],
    ],

];

// =====================================================================
// FUNGSI HELPER: Render warna badge kategori
// =====================================================================

function getIconKategori($kat) {
    $map = [
        'Wisata Alam' => 'bi-tree-fill',
        'Wisata Buatan' => 'bi-building',
        'Wisata Air' => 'bi-water',
        'Wisata Budaya' => 'bi-music-note-beamed',
        'Wisata Budaya & Alam' => 'bi-music-note-beamed',
        'Wisata Alam & Budaya' => 'bi-tree-fill',
        'Wisata Olahraga' => 'bi-bicycle',
        'Wisata Edukasi' => 'bi-book-half',
        'Wisata Kesehatan' => 'bi-heart-pulse-fill',
        'Wisata Sejarah & Budaya' => 'bi-bank',
        'Agrowisata' => 'bi-flower1',
    ];
    return $map[$kat] ?? 'bi-geo-alt-fill';
}

// =====================================================================
// FUNGSI GENERATOR: Hasilkan konten PHP halaman desa wisata
// =====================================================================

function generateDesaPage($slug, $data) {
    $namaDesa   = addslashes($data['nama_desa']);
    $kecamatan  = addslashes($data['kecamatan']);
    $fotoBanner = $data['foto_banner'];
    $deskripsi  = htmlspecialchars($data['deskripsi_desa']);
    $jumlahDest = count($data['destinasi']);

    // Harga tiket dari destinasi pertama (default)
    $hargaDefault = $data['destinasi'][0]['harga'];
    $namaDestinasiDefault = addslashes($data['destinasi'][0]['nama']);

    // ---- Render kartu destinasi ----
    $kartuDest = '';
    foreach ($data['destinasi'] as $i => $dest) {
        $destNama     = htmlspecialchars($dest['nama']);
        $destSlug     = $dest['slug'];
        $destFoto     = $dest['foto'];
        $destKat      = htmlspecialchars($dest['kategori']);
        $destBadge    = $dest['kategori_badge'];
        $destHarga    = number_format($dest['harga'], 0, ',', '.');
        $destLokasi   = htmlspecialchars($dest['lokasi_detail']);
        $destDesc     = htmlspecialchars($dest['deskripsi_singkat']);
        $destIcon     = getIconKategori($dest['kategori']);

        $badgeFasils = '';
        foreach ($dest['fasilitas'] as $fas) {
            $fasHtml = htmlspecialchars($fas);
            $badgeFasils .= "                                                <span class=\"badge bg-light text-secondary border small\"><i class=\"bi bi-check2 text-success me-1\"></i>{$fasHtml}</span>\n";
        }

        $kartuDest .= <<<HTML

                        <!-- DESTINASI: {$destNama} -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden destinasi-card-hover bg-white">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-5">
                                        <a href="../destinasi/{$destSlug}" class="d-block overflow-hidden position-relative" style="height: 240px;">
                                            <img src="../pictures/destinasi/{$destFoto}" alt="{$destNama}" class="w-100 h-100 object-fit-cover card-img-zoom">
                                            <span class="badge bg-{$destBadge} position-absolute top-0 start-0 m-3 shadow-sm">
                                                <i class="bi {$destIcon} me-1"></i> {$destKat}
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
                                                    <a href="../destinasi/{$destSlug}" class="text-dark text-decoration-none">{$destNama}</a>
                                                </h4>
                                                <span class="badge bg-light text-success border border-success-subtle fw-semibold">Rp {$destHarga}</span>
                                            </div>
                                            <small class="text-muted d-block mb-2">
                                                <i class="bi bi-geo-alt-fill text-success me-1"></i>{$destLokasi}
                                            </small>
                                            <p class="text-secondary small mb-3" style="line-height: 1.65;">
                                                {$destDesc}
                                            </p>
                                            <div class="mb-3 d-flex flex-wrap gap-1">
{$badgeFasils}                                            </div>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <a href="../destinasi/{$destSlug}" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-semibold">
                                                    <i class="bi bi-eye-fill me-1"></i> Lihat Deskripsi, Galeri &amp; Fasilitas
                                                </a>
                                                <a href="../pemesanan.php?destinasi={$destSlug}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2">
                                                    <i class="bi bi-ticket-perforated me-1"></i> Pesan Tiket
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
HTML;
    }

    $jumlahDestLabel = $jumlahDest === 1 ? '1 Destinasi Tersedia' : "{$jumlahDest} Destinasi Tersedia";

    // Coba baca harga dari DB, fallback ke default
    $hargaTiket = $hargaDefault;

    // ---- Hasilkan konten PHP utama halaman ----
    $phpContent = <<<PHPEND
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

\$sudahLogin = isset(\$_SESSION['user_id']);
\$namaPengguna = \$_SESSION['user_nama'] ?? 'Akun Saya';

\$namaDesa       = '$namaDesa';
\$kecamatan      = '$kecamatan';
\$namaDestinasi  = '$namaDestinasiDefault';
\$hargaTiket     = $hargaDefault;

// Ambil harga tiket dari database jika tersedia
try {
    \$stmtHarga = \$pdo->prepare("
        SELECT ticket_price FROM destination_prices
        WHERE destination_name = :nama LIMIT 1
    ");
    \$stmtHarga->execute([':nama' => \$namaDestinasi]);
    \$dataHarga = \$stmtHarga->fetch(PDO::FETCH_ASSOC);
    if (\$dataHarga && isset(\$dataHarga['ticket_price'])) {
        \$hargaTiket = (int) \$dataHarga['ticket_price'];
    }
} catch (PDOException \$e) {
    error_log('Harga tiket gagal dimuat: ' . \$e->getMessage());
}

\$hargaTiketFormat = number_format(\$hargaTiket, 0, ',', '.');

// CSRF & ulasan
if (empty(\$_SESSION['review_csrf'])) {
    \$_SESSION['review_csrf'] = bin2hex(random_bytes(32));
}

\$pesanUlasan = \$_SESSION['review_message'] ?? null;
unset(\$_SESSION['review_message']);

// Proses kirim ulasan
if (\$_SERVER['REQUEST_METHOD'] === 'POST' && isset(\$_POST['kirim_ulasan'])) {
    if (!\$sudahLogin) { header('Location: ../masuk.php'); exit; }
    \$token    = \$_POST['review_csrf'] ?? '';
    \$rating   = (int) (\$_POST['rating'] ?? 0);
    \$komentar = trim(\$_POST['comment'] ?? '');
    if (!hash_equals(\$_SESSION['review_csrf'], \$token)) {
        \$_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Permintaan tidak valid. Silakan coba kembali.'];
    } elseif (\$rating < 1 || \$rating > 5) {
        \$_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Silakan pilih rating bintang 1 sampai 5.'];
    } elseif (\$komentar === '') {
        \$_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Komentar ulasan tidak boleh kosong.'];
    } elseif (mb_strlen(\$komentar) > 1000) {
        \$_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Komentar maksimal 1000 karakter.'];
    } else {
        try {
            \$stmt = \$pdo->prepare("INSERT INTO destination_reviews (user_id, user_name, destination_name, rating, comment) VALUES (:uid, :uname, :dname, :rating, :comment)");
            \$stmt->execute([':uid' => \$_SESSION['user_id'], ':uname' => \$namaPengguna, ':dname' => \$namaDestinasi, ':rating' => \$rating, ':comment' => \$komentar]);
            \$_SESSION['review_message'] = ['type' => 'success', 'text' => 'Terima kasih! Ulasan kamu berhasil dikirim.'];
            \$_SESSION['review_csrf'] = bin2hex(random_bytes(32));
        } catch (PDOException \$e) {
            \$_SESSION['review_message'] = ['type' => 'danger', 'text' => 'Ulasan gagal dikirim. Silakan coba lagi.'];
        }
    }
    header('Location: {$slug}.php?ulasan=1#ulasan'); exit;
}

// Ambil ulasan
\$daftarUlasan = []; \$jumlahUlasan = 0; \$rataRating = 0;
try {
    \$stmtR = \$pdo->prepare("SELECT COUNT(*) AS jml, COALESCE(AVG(rating), 0) AS avg FROM destination_reviews WHERE destination_name = :d");
    \$stmtR->execute([':d' => \$namaDestinasi]);
    \$rowR = \$stmtR->fetch(PDO::FETCH_ASSOC);
    \$jumlahUlasan = (int) \$rowR['jml'];
    \$rataRating   = round((float) \$rowR['avg'], 1);
    \$stmtU = \$pdo->prepare("SELECT * FROM destination_reviews WHERE destination_name = :d ORDER BY created_at DESC LIMIT 20");
    \$stmtU->execute([':d' => \$namaDestinasi]);
    \$daftarUlasan = \$stmtU->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException \$e) {
    error_log('Gagal mengambil ulasan: ' . \$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(\$namaDesa) ?> | DewiCiamis - Desa Wisata Kabupaten Ciamis</title>
    <meta name="description" content="Jelajahi potensi wisata <?= htmlspecialchars(\$namaDesa) ?>, Kecamatan <?= htmlspecialchars(\$kecamatan) ?>, Kabupaten Ciamis. Temukan destinasi, fasilitas, galeri foto, dan pemesanan tiket.">
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
                <?php if (\$sudahLogin): ?>
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars(\$namaPengguna, ENT_QUOTES, 'UTF-8') ?>
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
            <span><?= htmlspecialchars(\$namaDesa) ?></span>
        </div>
        <div class="detail-hero-content">
            <div class="detail-category">
                <i class="bi bi-house-heart-fill"></i>
                DESA WISATA KABUPATEN CIAMIS
            </div>
            <h1><?= htmlspecialchars(\$namaDesa) ?></h1>
            <div class="detail-location">
                <i class="bi bi-geo-alt-fill"></i>
                Kecamatan <?= htmlspecialchars(\$kecamatan) ?>, Kabupaten Ciamis, Jawa Barat
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
                    <img src="../pictures/destinasi/$fotoBanner" alt="<?= htmlspecialchars(\$namaDesa) ?>" class="detail-image" style="width: 100%; max-height: 420px; object-fit: cover;">
                </div>
                <div class="photo-source mb-4">
                    <i class="bi bi-camera-fill"></i>
                    <span>Sumber Foto: Dokumentasi <?= htmlspecialchars(\$namaDesa) ?></span>
                </div>

                <!-- PROFIL DESA -->
                <article class="detail-article mb-5">
                    <span class="article-label">PROFIL DESA WISATA</span>
                    <h2>Mengenal <?= htmlspecialchars(\$namaDesa) ?></h2>
                    <p>{$deskripsi}</p>
                </article>

                <!-- KATALOG DESTINASI -->
                <div class="destinasi-katalog-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <span class="badge bg-success-subtle text-success px-3 rounded-pill mb-1 small fw-semibold">
                                <i class="bi bi-collection-fill me-1"></i> EKSPLORASI DESTINASI
                            </span>
                            <h3 class="fw-bold text-dark mb-1">Destinasi di <?= htmlspecialchars(\$namaDesa) ?></h3>
                        </div>
                        <span class="badge bg-success rounded-pill px-3 py-2">$jumlahDestLabel</span>
                    </div>
                    <p class="text-secondary small mb-4">
                        Klik pada foto atau tombol destinasi untuk melihat <strong>deskripsi lengkap</strong>, <strong>galeri foto</strong>, <strong>fasilitas terperinci</strong>, dan <strong>pemesanan tiket</strong>:
                    </p>
                    <div class="row g-4">
{$kartuDest}
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
                                <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode(\$namaDesa . ' ' . \$kecamatan . ' Ciamis') ?>" target="_blank" rel="noopener noreferrer" class="location-link">
                                    <strong><?= htmlspecialchars(\$namaDesa) ?></strong>
                                    <small><i class="bi bi-box-arrow-up-right"></i> Lihat di Google Maps</small>
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-map"></i>
                            <div>
                                <span>Kecamatan</span>
                                <strong><?= htmlspecialchars(\$kecamatan) ?></strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-file-earmark-check-fill"></i>
                            <div>
                                <span>Status</span>
                                <strong>Desa Wisata Aktif</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-collection-fill"></i>
                            <div>
                                <span>Jumlah Destinasi</span>
                                <strong>$jumlahDest Destinasi</strong>
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
                                <strong class="text-success fs-5">Rp <?= \$hargaTiketFormat ?> / orang</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <span>Jam Operasional</span>
                                <strong>07.00 – 17.00 WIB</strong>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="../pemesanan.php?destinasi=<?= urlencode(\$namaDestinasi) ?>" class="btn btn-success w-100 rounded-pill fw-semibold">
                                <i class="bi bi-ticket-perforated me-2"></i>Pesan Tiket Sekarang
                            </a>
                        </div>
                    </div>

                    <!-- JELAJAHI DESA -->
                    <div class="info-card bg-success text-white">
                        <div class="text-center py-2">
                            <i class="bi bi-compass-fill" style="font-size: 2rem; opacity: 0.8;"></i>
                            <h5 class="fw-bold mt-2 mb-1">Jelajahi <?= htmlspecialchars(\$namaDesa) ?></h5>
                            <p class="small mb-3 opacity-75">Nikmati keindahan alam dan budaya <?= htmlspecialchars(\$namaDesa) ?>, Kecamatan <?= htmlspecialchars(\$kecamatan) ?>.</p>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode(\$namaDesa . ' ' . \$kecamatan . ' Ciamis') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-light btn-sm rounded-pill px-4 fw-semibold text-success">
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
            <p class="text-muted"><?= htmlspecialchars(\$namaDesa) ?>, Kecamatan <?= htmlspecialchars(\$kecamatan) ?></p>
        </div>

        <?php if (\$pesanUlasan): ?>
        <div class="alert alert-<?= \$pesanUlasan['type'] ?> review-alert">
            <?= htmlspecialchars(\$pesanUlasan['text']) ?>
        </div>
        <?php endif; ?>

        <?php if (\$jumlahUlasan > 0): ?>
        <div class="review-summary">
            <div class="review-average"><?= number_format(\$rataRating, 1) ?></div>
            <div>
                <div class="review-stars">
                    <?php for (\$i = 1; \$i <= 5; \$i++): ?>
                        <i class="bi bi-star<?= \$i <= round(\$rataRating) ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                </div>
                <div class="review-total"><?= \$jumlahUlasan ?> ulasan pengunjung</div>
            </div>
        </div>
        <div>
            <?php foreach (\$daftarUlasan as \$ulasan): ?>
            <div class="review-item">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="review-avatar"><i class="bi bi-person-fill"></i></div>
                    <div>
                        <strong class="d-block" style="color:#26352d;"><?= htmlspecialchars(\$ulasan['user_name']) ?></strong>
                        <small class="text-muted"><?= htmlspecialchars(substr(\$ulasan['created_at'] ?? '', 0, 10)) ?></small>
                    </div>
                </div>
                <div class="review-stars mb-2" style="font-size:14px;">
                    <?php for (\$i = 1; \$i <= 5; \$i++): ?>
                        <i class="bi bi-star<?= \$i <= (int)\$ulasan['rating'] ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-muted small mb-0" style="line-height:1.7;"><?= nl2br(htmlspecialchars(\$ulasan['comment'])) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="review-empty mb-3" style="background:#fff; text-align:center; padding:30px; border:1px dashed #d9e2dc; border-radius:14px; color:#777;">
            <i class="bi bi-chat-square-text" style="display:block; font-size:32px; color:#a5b9ac; margin-bottom:10px;"></i>
            Belum ada ulasan untuk <?= htmlspecialchars(\$namaDesa) ?>. Jadilah yang pertama memberikan ulasan!
        </div>
        <?php endif; ?>

        <?php if (\$sudahLogin): ?>
        <div class="review-form-card">
            <h3>Tulis Ulasan Anda</h3>
            <form method="POST" action="">
                <input type="hidden" name="kirim_ulasan" value="1">
                <input type="hidden" name="review_csrf" value="<?= htmlspecialchars(\$_SESSION['review_csrf']) ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Rating</label>
                    <div class="rating-input">
                        <?php for (\$i = 5; \$i >= 1; \$i--): ?>
                        <input type="radio" name="rating" id="star<?= \$i ?>" value="<?= \$i ?>">
                        <label for="star<?= \$i ?>" title="<?= \$i ?> bintang">&#9733;</label>
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
                    <?php if (\$sudahLogin): ?>
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
PHPEND;

    return $phpContent;
}

// =====================================================================
// JALANKAN GENERATOR: Tulis semua file
// =====================================================================

$outputDir = __DIR__ . '/../public/detail/';
$berhasil  = 0;
$gagal     = 0;

foreach ($DESA_DATA as $slug => $data) {
    $filePath = $outputDir . $slug . '.php';
    $content  = generateDesaPage($slug, $data);

    if (file_put_contents($filePath, $content) !== false) {
        echo "[OK]  $slug.php (" . count($data['destinasi']) . " destinasi)\n";
        $berhasil++;
    } else {
        echo "[ERR] Gagal menulis $slug.php\n";
        $gagal++;
    }
}

echo "\n=== SELESAI: $berhasil file berhasil, $gagal gagal ===\n";
