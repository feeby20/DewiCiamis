const fs = require('fs');
const path = require('path');

// 85 Destinations descriptions and facilities mapping
const destinationDetails = {
  // 1. Kawali
  "Astana Gede Kawali": {
    deskripsi: "Kawasan cagar budaya peninggalan Kerajaan Sunda Galuh yang sarat prasasti kuno, batu tapak, makam bersejarah, dan rimbunnya hutan lindung sakral.",
    fasilitas: ["Area Parkir", "Toilet & Tempat Wudhu", "Pemandu Wisata", "Spot Foto Sejarah", "Pusat Informasi & Gazebo"]
  },
  // 2. Winduraja
  "Situ Wangi": {
    deskripsi: "Danau alami nan asri dengan udara sejuk pegunungan, jalur jogging keliling danau, serta wahana perahu air keluarga.",
    fasilitas: ["Wahana Perahu Bebek", "Dermaga Spot Foto", "Area Parkir", "Warung Kuliner", "Toilet & Mushola"]
  },
  // 3. Talagasari
  "Kampung Sawah": {
    deskripsi: "Destinasi wisata buatan dengan panorama bentangan persawahan hijau, jembatan kayu estetik, gazebo santai, dan kuliner khas sunda.",
    fasilitas: ["Gazebo Tengah Sawah", "Jembatan Bambu Selfie", "Resto Masakan Sunda", "Toilet", "Area Parkir"]
  },
  // 4. Sidamulih
  "Pasir Jati Grown Hill": {
    deskripsi: "Puncak perbukitan hijau dengan gardu pandang 360 derajat ke lembah Pamarican, sangat cocok untuk berswafoto dan menikmati sunset.",
    fasilitas: ["Gardu Pandang", "Spot Foto Sayap & Ayunan", "Warung Kopi", "Toilet", "Parkir Kendaraan"]
  },
  // 5. Mekarsari
  "Puncak Meralaya": {
    deskripsi: "Wisata alam perbukitan dengan pesona lembah hijau berpadu terasering persawahan dan panorama sunrise spektakuler.",
    fasilitas: ["Area Camping Ground", "Gazebo Pandang", "Spot Foto Alam", "Toilet", "Warung Makanan"]
  },
  // 6. Ciakar
  "Wisata Murbey": {
    deskripsi: "Kawasan agrowisata edukasi budidaya pohon murbei terpadu, peternakan ulat sutera, petik buah murbei segar, dan olahan sirup herbal.",
    fasilitas: ["Kebun Petik Murbei", "Pusat Edukasi Sutera", "Toko Oleh-oleh Olahan", "Toilet", "Area Parkir"]
  },
  // 7. Cintanagara
  "Wisata Alam": {
    deskripsi: "Menyuguhkan keindahan alam pedesaan berhawa sejuk dengan panorama perbukitan hijau dan gemericik air alami.",
    fasilitas: ["Jalur Trekking", "Spot Foto Alam", "Area Parkir", "Toilet", "Warung"]
  },
  "Agrowisata": {
    deskripsi: "Lahan perkebunan holtikultura dan buah-buahan lokal yang asri, menawarkan pengalaman memetik hasil kebun langsung bersama petani.",
    fasilitas: ["Kebun Buah Edukasi", "Gazebo Istirahat", "Toilet", "Pusat Bibit Tanaman"]
  },
  "Jalan Usaha Tani": {
    deskripsi: "Jalur lintasan asri menembus hamparan sawah dan kebun yang cocok untuk bersepeda pagi dan jalan santai pedesaan.",
    fasilitas: ["Jalur Sepeda & Jogging", "Spot Foto Sunrise", "Bangku Istirahat", "Area Parkir"]
  },
  // 8. Karangkamulyan
  "Situs Karangkamulyan": {
    deskripsi: "Situs arkeologi cagar budaya Kerajaan Galuh legendaris Ciung Wanara di tengah hutan lindung alami dengan aneka peninggalan batu megalitikum.",
    fasilitas: ["Pemandu Sejarah", "Museum Cagar Budaya", "Area Parkir Luas", "Warung & Souvenir", "Toilet & Mushola"]
  },
  // 9. Bangunharja
  "Puncak Manik": {
    deskripsi: "Destinasi perbukitan tinggi di Cisaga dengan panorama lembah sungai Citanduy, gardu pandang alam, dan udara bersih nan menyegarkan.",
    fasilitas: ["Gardu Pandang Manik", "Spot Foto Instagramable", "Camping Area", "Toilet", "Warung Kopi"]
  },
  // 10. Cisontrol
  "Wisata Edukasi Anak": {
    deskripsi: "Taman bermain edukatif ruang terbuka yang dilengkapi wahana interaktif ramah anak, kolam air, dan area pengenalan satwa ternak.",
    fasilitas: ["Wahana Bermain Anak", "Kolam Air Anak", "Gazebo Keluarga", "Kantin Ramah Anak", "Toilet Bersih"]
  },
  // 11. Situmandala
  "Puncak Bangku": {
    deskripsi: "Dikenal sebagai 'Negeri di Atas Awan' Ciamis, menawarkan pemandangan lautan kabut pagi tebal membentang di atas lembah Rancah.",
    fasilitas: ["Gardu Pandang Awan", "Spot Foto Estetik", "Kedai Kopi & Teh", "Area Parkir", "Toilet"]
  },
  "Puncak Pispun": {
    deskripsi: "Kawasan perbukitan tenang dengan panorama perladangan hijau dan spot foto panorama pedesaan terbuka.",
    fasilitas: ["Area Santai", "Spot Foto Lanskap", "Toilet", "Tempat Duduk Gazebo"]
  },
  // 12. Wanasigra
  "Situs Gandoang": {
    deskripsi: "Situs cagar budaya keramat peninggalan leluhur dengan tradisi upacara Merlawu, batu pangcalikan, dan sumber mata air jernih.",
    fasilitas: ["Area Upacara Adat", "Bale Tradisional", "Pemandu Budaya", "Toilet", "Area Parkir"]
  },
  // 13. Sukahurip
  "Curug Salosin": {
    deskripsi: "Air terjun alami bertingkat di lereng Gunung Sawal dengan kolam alami berair jernih pegunungan yang sangat menyegarkan.",
    fasilitas: ["Jalur Trekking Alam", "Kolam Pemandian Alami", "Saung Istirahat", "Warung", "Toilet"]
  },
  // 14. Sumberjaya
  "Taman Wisata": {
    deskripsi: "Taman rekreasi hijau keluarga dengan kolam santai, rimbun pepohonan buah, dan spot foto warna-warni.",
    fasilitas: ["Taman Bunga & Spot Foto", "Gazebo Keluarga", "Area Parkir", "Toilet", "Kantin"]
  },
  "Bumi Perkemahan": {
    deskripsi: "Area perkemahan luas di bawah naungan pohon pinus dengan fasilitas outbound dan api unggun yang aman.",
    fasilitas: ["Lapangan Camping Luas", "Sumber Air Bersih", "Toilet & Mushola", "Penyewaan Tenda"]
  },
  // 15. Ciomas
  "Paralayang": {
    deskripsi: "Landasan take-off olahraga dirgantara paralayang dengan ketinggian yang menawarkan view magis danau Situ Lengkong dari angkasa.",
    fasilitas: ["Landasan Take-Off", "Penyewaan Alat & Tandem Pilot", "Spot Pandang Udara", "Kantin", "Toilet"]
  },
  // 16. Panjalu
  "Situ Lengkong Panjalu": {
    deskripsi: "Danau wisata alam dan religi seluas 57 hektar dengan pulau Nusa Gede di tengahnya yang menyimpan makam Prabu Hariang Kancana.",
    fasilitas: ["Perahu Wisata Keliling Nusa", "Ziarah Religi Nusa Gede", "Pasar Oleh-oleh & Souvenir", "Parkir Bus & Mobil", "Restoran Lesehan"]
  },
  // 17. Cikupa
  "Pemandian Air Panas": {
    deskripsi: "Sumber mata air panas alami dengan kandungan mineral belerang berkhasiat terapi kesehatan diapit suasana pegunungan asri.",
    fasilitas: ["Kolam Rendam Air Panas", "Kamar Mandi Terapi Privat", "Kamar Ganti & Bilas", "Kantin Makanan", "Parkir"]
  },
  // 18. Banjaranyar
  "Kampung Madu": {
    deskripsi: "Sentra budidaya lebah madu klanceng dan trigona alami, edukasi mencicip madu langsung dari sarang, serta kebun bunga nektar.",
    fasilitas: ["Pusat Edukasi Peternakan Lebah", "Tasting Madu Murni", "Gerai Produk Madu Asli", "Spot Selfie Kebun Bunga", "Toilet"]
  },
  // 19. Karangpaningal
  "Kampung Kuta": {
    deskripsi: "Desa adat tradisional Sunda dengan rumah panggung beratap ijuk rumbia, hutan larangan sakral, dan aturan adat hidup selaras alam.",
    fasilitas: ["Homestay Rumah Adat", "Pemandu Adat Kuta", "Kerajinan Bambu Tradisional", "Bale Sawala Pertemuan", "Toilet"]
  },
  // 20. Baregbeg
  "Layang Lakbok": {
    deskripsi: "Kawasan wisata alam persawahan terpadu Lakbok yang terkenal dengan festival layang-layang tradisional dan agro-kuliner sawah.",
    fasilitas: ["Area Terbuka Layang-layang", "Jembatan Sawah", "Gazebo Lesehan", "Kantin Kuliner Khas", "Toilet"]
  },
  // 21. Cibeureum
  "Situ Cibubuhan": {
    deskripsi: "Situ alami pegunungan di Sukamantri dengan hawa sejuk, spot memancing tenang, dan latar lanskap perbukitan hijau perawan.",
    fasilitas: ["Spot Mancing Ikan", "Jalur Mengitari Situ", "Saung Santai", "Toilet", "Warung Kopi"]
  },
  // 22. Gunungsari
  "Cadas Ngampar": {
    deskripsi: "Destinasi wisata alam sungai jernih berhulu Gunung Sawal dengan bebatuan cadas eksotis yang bertingkat dan air dingin menyegarkan.",
    fasilitas: ["Wahana River Tubing", "Pemandian Sungai Alami", "Saung Bambu Pinggir Sungai", "Kamar Bilas & Toilet", "Parkir"]
  },
  // 23. Kawasen
  "Tonjong Golok": {
    deskripsi: "Objek wisata aliran sungai jernih bertebing batu eksotis yang menawan di Banjarsari, cocok untuk berenang dan bermain air.",
    fasilitas: ["Area Berenang Alami", "Penyewaan Ban Pelampung", "Warung Makanan", "Toilet", "Parkir Kendaraan"]
  },
  // 24. Sagalaherang
  "Paralayang": {
    deskripsi: "Spot landasan terbang paralayang dan gantole di Panawangan dengan pemandangan bentang alam perbukitan Ciamis utara yang spektakuler.",
    fasilitas: ["Take-Off Deck", "Instruktur Tandem Berlisensi", "Spot Selfie Sunset", "Kantin", "Toilet"]
  },
  // 25. Kertajaya
  "Puncak Kertajaya": {
    deskripsi: "Puncak perbukitan tinggi yang menyajikan pemandangan lanskap pegunungan terbuka, sejuk untuk melepas penat dan bersantai keluarga.",
    fasilitas: ["Menara Pandang", "Spot Foto Kayu", "Warung Minuman & Makanan", "Toilet", "Parkir"]
  },
  // 26. Raksabaya
  "Kampung Teratai": {
    deskripsi: "Kawasan ekowisata danau rawa dengan hamparan bunga teratai mekar nan indah, jembatan kayu terapung, dan kebun bunga.",
    fasilitas: ["Jembatan Apung Danau Teratai", "Spot Foto Perahu Bunga", "Gazebo Tepi Kolam", "Warung Kuliner", "Toilet"]
  },
  // 27. Pusakasari
  "Agro Wisata": {
    deskripsi: "Kawasan agrowisata perkebunan holtikultura, sayuran organik, dan buah-buahan lokal dengan paket edukasi pertanian modern.",
    fasilitas: ["Kebun Edukasi Pertanian", "Pusat Penjualan Buah Segar", "Saung Tani", "Toilet", "Area Parkir"]
  },
  // 28. Sadewata
  "Situ Hiang": {
    deskripsi: "Danau purba tersembunyi yang tenang di Lumbung dengan pepohonan rindang dan udara segar alami khas pedesaan.",
    fasilitas: ["Jalur Menikmati Danau", "Spot Pemancingan", "Saung Tradisional", "Toilet", "Area Parkir"]
  },
  // 29. Cimari
  "Situ Rancabala": {
    deskripsi: "Destinasi danau buatan dan alami dengan pemandangan air yang teduh, cocok untuk bersantai sore dan memancing bersama keluarga.",
    fasilitas: ["Dermaga Mini", "Area Memancing Santai", "Warung Makanan Ringan", "Toilet", "Parkir"]
  },
  // 30. Sukajaya
  "Puncak Upsa Rahong": {
    deskripsi: "Puncak bukit panorama alam dengan udara sejuk pegunungan Rajadesa yang memanjakan mata dengan pemandangan hamparan lembah luas.",
    fasilitas: ["Gardu Pandang Kayu", "Spot Foto Ayunan Langit", "Kedai Kopi Lereng", "Toilet", "Area Parkir"]
  },
  // 31. Jalatrang
  "Kampung Bungur": {
    deskripsi: "Wisata buatan ramah keluarga dengan konsep kampung taman bunga warna-warni, kolam renang anak, dan spot foto kreatif.",
    fasilitas: ["Kolam Renang Anak & Keluarga", "Taman Bunga Warna-Warni", "Saung Gazebo Lesehan", "Kantin Makanan", "Toilet & Mushola"]
  },
  // 32. Rajadesa
  "Samida": {
    deskripsi: "Hutan lindung cagar budaya bersejarah peninggalan Kerajaan Rajadesa dengan aneka pohon purba berusia ratusan tahun.",
    fasilitas: ["Jalur Jalur Setapak Rindang", "Pemandu Sejarah", "Bale Istirahat", "Toilet", "Parkir"]
  },
  "Situs Gunung Marapi": {
    deskripsi: "Situs bersejarah di atas perbukitan Rajadesa yang sarat legenda lokal dan menawarkan pemandangan bukit asri.",
    fasilitas: ["Jalur Tangga Cagar Budaya", "Spot Pandang Bukit", "Saung Santai", "Toilet"]
  },
  // 33. Sukamaju
  "Bukit Sempalan Asri": {
    deskripsi: "Kawasan perbukitan dengan padang rumput hijau asri dan sudut pandang lanskap perkampungan Ciamis dari ketinggian.",
    fasilitas: ["Gardu Pandang Alam", "Area Camping Bukit", "Warung Kopi", "Toilet", "Parkir Motor & Mobil"]
  },
  "Lobang Timah": {
    deskripsi: "Situs peninggalan galian pertambangan timah masa lalu yang kini dikembangkan menjadi wisata edukasi sejarah geologi.",
    fasilitas: ["Jalur Lorong Wisata Edukasi", "Pemandu Lokal", "Spot Foto Sejarah", "Toilet"]
  },
  // 34. Selamanik
  "Homestay": {
    deskripsi: "Penginapan rumah warga ramah lingkungan bergaya arsitektur Sunda dengan pelayanan hangat dan sajian masakan tradisional.",
    fasilitas: ["Kamar Tidur Nyaman", "Kamar Mandi Bersih", "Wifi Gratis", "Sarapan Khas Sunda", "Parkir"]
  },
  // 35. Sukaresik
  "Sungai Cireong": {
    deskripsi: "Sungai alami berarus tenang dengan air jernih dingin dari mata air pegunungan diapit rindangnya rumpun bambu.",
    fasilitas: ["Pemandian Alami Bebatuan", "Sewa Pelampung & Ban", "Warung Nasi Liwet Pinggir Sungai", "Kamar Bilas", "Toilet"]
  },
  "Situs Gunung Padang": {
    deskripsi: "Kawasan cagar budaya perbukitan bebatuan megalitikum bersejarah yang sarat misteri peradaban kuno.",
    fasilitas: ["Jalur Pendakian Tangga", "Pemandu Sejarah Adat", "Bale Singgah", "Toilet"]
  },
  // 36. Darmacaang
  "Hutan Pinus Batu Cakra": {
    deskripsi: "Ekowisata hutan pinus asri di lereng Gunung Sawal dengan formasi batu cakra unik, sejuk untuk hammock-an dan camping keluarga.",
    fasilitas: ["Area Hammock Rimbun", "Bumi Perkemahan Pinus", "Warung Kopi Hutan", "Toilet Bersih", "Parkir Luas"]
  },
  // 37. Kaso
  "Embung Ciwaleud": {
    deskripsi: "Danau penampung air alami yang disulap menjadi taman air wisata dengan perahu kayuh dan pemandangan perbukitan asri.",
    fasilitas: ["Wahana Perahu Air", "Taman Tepi Embung", "Spot Foto Dermaga", "Toilet", "Warung"]
  },
  "Seni Budaya Mekar Arum": {
    deskripsi: "Pusat pelestarian kesenian tari tradisional, karawitan, dan calung Sunda dengan panggung pentas seni rakyat.",
    fasilitas: ["Panggung Terbuka Seni", "Workshop Alat Musik Tradisional", "Bale Sanggar Seni", "Toilet"]
  },
  // 38. Bahara
  "Situs Opanjalu": {
    deskripsi: "Kawasan cagar budaya ziarah leluhur Panjalu dengan suasana hutan keramat yang asri, tenang, dan terjaga kelestariannya.",
    fasilitas: ["Pemandu Sejarah Ziarah", "Bale Pasarean", "Toilet & Mushola", "Tempat Wudhu", "Parkir"]
  },
  // 39. Sukadana
  "Cagar Budaya Rumah Bintang": {
    deskripsi: "Bangunan arsitektur peninggalan kolonial antik bermotif bintang yang memiliki nilai sejarah masa lampau.",
    fasilitas: ["Pemandu Sejarah Bangunan", "Spot Foto Vintage", "Bale Informasi", "Toilet"]
  },
  // 40. Cibadak
  "Buper dan Pangangonan": {
    deskripsi: "Bumi perkemahan luas terintegrasi dengan area penggembalaan ternak asri berlatar bukit dan persawahan.",
    fasilitas: ["Area Camping Lapangan Luas", "Outbound Area", "Kran Air Bersih", "Toilet & Kamar Mandi"]
  },
  // 41. Nasol
  "Jaha Buana": {
    deskripsi: "Objek wisata alam perbukitan Cikoneng dengan panorama lembah hijau, udara sejuk, dan gardu pandang memikat.",
    fasilitas: ["Gardu Pandang Alam", "Spot Foto Bunga", "Kedai Kopi Santai", "Toilet", "Area Parkir"]
  },
  // 42. Gunungcupu
  "Kampung Legenda": {
    deskripsi: "Kampung wisata budaya dan edukasi sejarah yang mengangkat cerita rakyat legenda Gunung Cupu dengan replika situs dan pentas dongeng.",
    fasilitas: ["Panggung Dongeng Budaya", "Replika Cawan Cupu Keramat", "Saung Kuliner Tradisional", "Toilet", "Parkir"]
  },
  // 43. Kadupandak
  "Cekdam Kadupandak": {
    deskripsi: "Waduk cekdam multifungsi yang difungsikan sebagai destinasi wisata rekreasi air, memancing, dan bersantai sore di pinggir danau.",
    fasilitas: ["Spot Mancing Ikan", "Taman Tepi Cekdam", "Warung Kopi & Camilan", "Toilet", "Parkir Motor"]
  },
  // 44. Sukasenang
  "Situ Rancamaya": {
    deskripsi: "Danau alami Situ Rancamaya yang tenang dengan teratai air, gazebo terapung, dan udara segar pedesaan Sindangkasih.",
    fasilitas: ["Gazebo Terapung", "Jalur Jogging Pinggir Situ", "Warung Makanan", "Toilet", "Parkir"]
  },
  // 45. Jagabaya
  "Bukit Cikulak": {
    deskripsi: "Wisata alam perbukitan tinggi di Panawangan dengan spot swafoto gardu kayu berlatar pemandangan spektakuler perbukitan Ciamis timur.",
    fasilitas: ["Gardu Pandang Kayu", "Spot Foto Sayap", "Warung Kopi Bukit", "Toilet", "Area Parkir"]
  },
  // 46. Kertabumi
  "Situs Gunung Susuru": {
    deskripsi: "Situs purbakala dan cagar budaya di atas bukit pertemuan dua sungai dengan susunan punden berundak, gua batu, dan sejarah Kerajaan Galuh Kertabumi.",
    fasilitas: ["Pemandu Arkeologi", "Gua & Punden Berundak", "Bale Informasi Sejarah", "Toilet", "Area Parkir"]
  },
  // 47. Giriharja
  "Jembatan Swiss": {
    deskripsi: "Jembatan gantung ikonik dengan arsitektur menyerupai jembatan lembah di Swiss yang membentang di atas ngarai hijau eksotis.",
    fasilitas: ["Spot Foto Jembatan Gantung", "Dek Pandang Ngarai", "Warung Kuliner", "Toilet", "Parkir"]
  },
  "Kolam Renang Jembatan Swiss": {
    deskripsi: "Wahana rekreasi kolam renang air segar pegunungan berdampingan langsung dengan panorama jembatan gantung Swiss.",
    fasilitas: ["Kolam Renang Dewasa & Anak", "Perosotan Air", "Kamar Ganti & Bilas", "Kantin Makanan", "Gazebo Santai"]
  },
  // 48. Werasari
  "Agrowisata Pasir Boma": {
    deskripsi: "Kawasan agrowisata perkebunan holtikultura di atas perbukitan Pasir Boma dengan panorama megah lereng Gunung Sawal.",
    fasilitas: ["Kebun Wisata Buah & Sayur", "Spot Pandang Lereng Sawal", "Saung Tani", "Toilet", "Area Parkir"]
  },
  // 49. Cisadap
  "Wisata Religi Makam Bupati Galuh": {
    deskripsi: "Situs ziarah makam leluhur para bupati Galuh Ciamis yang sarat nilai spiritual dan sejarah pemerintahan masa lampau.",
    fasilitas: ["Kompleks Makam Bersejarah", "Tempat Ziarah & Wudhu", "Mushola", "Toilet", "Area Parkir"]
  },
  "Kampung Tahu": {
    deskripsi: "Sentra produksi tahu tradisional khas Cisadap di mana pengunjung dapat melihat dan mencoba proses pembuatan tahu hangat.",
    fasilitas: ["Workshop Pembuatan Tahu", "Toko Tahu Goreng Hangat", "Pemandu Sentra UKM", "Toilet"]
  },
  "Kampung Edukasi": {
    deskripsi: "Wahana pembelajaran interaktif di alam terbuka untuk anak sekolah mengenal lingkungan hidup dan kerajinan.",
    fasilitas: ["Ruang Terbuka Edukasi", "Bale Praktik Kerajinan", "Toilet", "Spot Foto"]
  },
  "Ternak Domba": {
    deskripsi: "Sentra peternakan domba unggulan Ciamis dengan sarana edukasi pemeliharaan dan pakan ternak ramah anak.",
    fasilitas: ["Kandang Bersih Edukasi", "Area Memberi Makan Ternak", "Pemandu Peternak", "Area Parkir"]
  },
  // 50. Panyingkiran
  "Wisata Religi Makam Syeh Abu Syahar": {
    deskripsi: "Tempat ziarah bersejarah makam tokoh penyebar agama Islam terkemuka di tanah Galuh.",
    fasilitas: ["Makam Keramat Ziarah", "Tempat Doa & Wudhu", "Mushola", "Toilet", "Area Parkir"]
  },
  "Wisata Alam Cireong": {
    deskripsi: "Aliran sungai berbatu alami berair bening sejuk yang sangat diminati wisatawan untuk berendam dan terapi air.",
    fasilitas: ["Kolam Aliran Sungai Alami", "Sewa Ban Pelampung", "Warung Nasi Liwet Pinggir Sungai", "Kamar Bilas", "Toilet"]
  },
  "Kampung Angklung": {
    deskripsi: "Pusat pelestarian dan workshop pembuatan alat musik bambu angklung serta pentas ansambel musik tradisional.",
    fasilitas: ["Sanggar Seni Angklung", "Workshop Pembuatan Bambu", "Pentas Musik Interaktif", "Souvenir Angklung Mini"]
  },
  // 51. Sukawening
  "Wisata Alam Cibagi": {
    deskripsi: "Pemandian alam di aliran sungai jernih Cibagi yang dikelilingi hutan bambu rindang dan suasana pedesaan yang tenang menentramkan.",
    fasilitas: ["Area Pemandian Sungai", "Saung Santai Rumpun Bambu", "Kamar Mandi Bilas", "Warung Kopi", "Parkir"]
  },
  // 52. Kertamandala
  "Makam Situs Cikapunduhan": {
    deskripsi: "Situs ziarah makam leluhur kuno Cikapunduhan yang dihormati masyarakat di tengah kawasan rimbun pegunungan Panjalu.",
    fasilitas: ["Situs Makam Bersejarah", "Bale Ziarah", "Toilet", "Area Parkir"]
  },
  "Villa Srikandi": {
    deskripsi: "Penginapan villa berarsitektur kayu pegunungan yang asri dengan pemandangan bukit dan fasilitas istirahat keluarga.",
    fasilitas: ["Kamar Villa Keluarga", "Halaman Terbuka Hijau", "Dapur Bersama", "Wifi", "Area Parkir Luas"]
  },
  // 53. Padamulya (Padmulya)
  "Curug Seda": {
    deskripsi: "Air terjun alami tersembunyi dengan debit air deras jernih dan tebing bebatuan bertingkat yang memesona.",
    fasilitas: ["Jalur Trekking Curug", "Kolam Alami Air Terjun", "Saung Bambu", "Toilet"]
  },
  "Kolam Renang Alam JF": {
    deskripsi: "Kolam renang rekreasi keluarga bersumber langsung dari mata air pegunungan yang segar tanpa kaporit.",
    fasilitas: ["Kolam Renang Anak & Dewasa", "Kamar Ganti & Bilas", "Kantin Makanan", "Gazebo Santai"]
  },
  "Wisata Sungai Ciharus": {
    deskripsi: "Aliran sungai jernih berbatu dengan rimbun pepohonan asri, sangat cocok untuk berendam dan bermain air.",
    fasilitas: ["Area Berendam Bebatuan", "Sewa Ban Pelampung", "Saung Tepi Sungai", "Warung"]
  },
  "Buper Puncak Asih": {
    deskripsi: "Bumi perkemahan di atas ketinggian Padamulya dengan view perbukitan dan kerlap-kerlip lampu kota di malam hari.",
    fasilitas: ["Lapangan Camping Ground", "Titik Api Unggun", "Kran Air & Listrik", "Toilet & Mushola"]
  },
  // 54. Tanjungsari
  "Curug Panganten": {
    deskripsi: "Air terjun kembar bertingkat yang anggun di tengah hutan lindung lereng Gunung Sawal dengan kolam alami yang jernih.",
    fasilitas: ["Jalur Setapak Hutan", "Spot Foto Air Terjun Kembar", "Saung Istirahat", "Toilet"]
  },
  "Buper Awilega": {
    deskripsi: "Bumi perkemahan di tengah deretan pohon bambu dan pinus berhawa sejuk dengan fasilitas outbound dan trekking.",
    fasilitas: ["Bumi Perkemahan Luas", "Area Outbound & Flying Fox", "Kamar Mandi & Toilet", "Mushola", "Parkir"]
  },
  "Leuwi Pamipiran": {
    deskripsi: "Lubuk sungai alami berair hijau toska jernih nan dalam yang cocok untuk berenang dan menyelam di alam bebas.",
    fasilitas: ["Spot Berenang Alami", "Penyewaan Pelampung", "Kamar Ganti Sederhana", "Warung Makanan"]
  },
  // 55. Sukasetia
  "Agrowisata Sukapulang": {
    deskripsi: "Perkebunan terpadu dengan aneka tanaman buah, kebun kopi pegunungan, dan sajian kopi robusta khas desa.",
    fasilitas: ["Kebun Kopi Edukasi", "Kedai Kopi Sukapulang", "Pusat Bibit Tanaman", "Toilet", "Parkir"]
  },
  "Desa Adat Sejahtera Berencana": {
    deskripsi: "Pemukiman masyarakat adat yang memegang teguh tradisi gotong royong, arsitektur rumah khas, dan kearifan lingkungan.",
    fasilitas: ["Bale Sawala Adat", "Pemandu Budaya Desa", "Pusat Kerajinan Anyaman", "Toilet"]
  },
  // 56. Maparah
  "Situs Aria Dipa": {
    deskripsi: "Cagar budaya situs peninggalan Pangeran Aria Dipa, tokoh terkemuka sejarah Panjalu, yang berada di puncak bukit berhawa sejuk.",
    fasilitas: ["Situs Bersejarah Terawat", "Bale Pasarean", "Pemandu Sejarah", "Toilet", "Area Parkir"]
  },
  "Taman Uncal Bubulak": {
    deskripsi: "Taman rekreasi keluarga yang memiliki penangkaran rusa tutul (uncal) jinak di mana anak-anak dapat berinteraksi dan memberi makan.",
    fasilitas: ["Kandang Interaktif Rusa", "Pakan Rusa Edukasi", "Taman Bermain Anak", "Gazebo Santai", "Toilet & Kantin"]
  },
  // 57. Sandingtaman
  "Curug Tujuh": {
    deskripsi: "Air terjun legendaris Curug Cibolang dengan 7 tingkatan air terjun spektakuler di kawasan hutan pinus lindung lereng Gunung Sawal.",
    fasilitas: ["Jalur Wisata 7 Tingkat Curug", "Kolam Pemandian Alami", "Warung Kuliner Khas", "Toilet & Kamar Bilas", "Parkir Luas"]
  },
  "Buper Aki Kabayan": {
    deskripsi: "Bumi perkemahan nyaman di tengah pepohonan pinus rindang dengan fasilitas outbound, air jernih pegunungan, dan udara dingin.",
    fasilitas: ["Area Tenda Camping", "Penyewaan Tenda & Sleeping Bag", "Toilet & Mushola", "Penerangan Listrik"]
  },
  "Situs Cidehem": {
    deskripsi: "Sumber mata air purba bersejarah yang dikeramatkan dengan air yang sangat jernih dan dipercaya berkhasiat kesehatan.",
    fasilitas: ["Mata Air Alami Cidehem", "Tempat Ziarah & Wudhu", "Bale Istirahat", "Toilet"]
  }
};

module.exports = { destinationDetails };
