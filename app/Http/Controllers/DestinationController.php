<?php

namespace App\Http\Controllers;

use App\Models\DestinationPrice;
use App\Models\DestinationReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        try {
            $destinasiList = DestinationPrice::orderBy('destination_name')->get();
        } catch (\Throwable $e) {
            $destinasiList = collect([]);
        }

        return view('destinasi.index', compact('destinasiList', 'kategori'));
    }

    public function show($slug)
    {
        // Bersihkan slug menjadi perkiraan nama destinasi
        $formattedName = ucwords(str_replace('-', ' ', $slug));

        // Info deskripsi, galeri, dan fasilitas per destinasi
        $info = $this->getDestinationMetadata($formattedName);
        $destinationName = $info['nama'] ?? $formattedName;
        $ticketPrice = $info['harga'] ?? 6500;
        $reviews = collect([]);

        // Cari destinasi dan ulasan dari database jika tersedia
        try {
            $destination = DestinationPrice::where('destination_name', 'LIKE', "%{$formattedName}%")
                ->orWhere('destination_name', $formattedName)
                ->first();

            if ($destination) {
                $destinationName = $destination->destination_name;
                $ticketPrice = $destination->ticket_price;
            }

            $reviews = DestinationReview::where('destination_name', 'LIKE', "%{$destinationName}%")
                ->orWhere('destination_name', 'LIKE', "%{$formattedName}%")
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            // Fallback graceful jika koneksi DB bermasalah
            \Illuminate\Support\Facades\Log::warning('Gagal load data DB destinasi show: ' . $e->getMessage());
        }

        $destDescription = $info['deskripsi'];
        $destFacilities = $info['fasilitas'];
        $destGallery = $info['galeri'];
        $destCategory = $info['kategori'] ?? 'Wisata Alam';
        $destVillage = $info['desa'] ?? 'Ciamis';
        $destDistrict = $info['kecamatan'] ?? 'Ciamis';

        return view('destinasi.show', compact(
            'destinationName',
            'ticketPrice',
            'reviews',
            'slug',
            'destDescription',
            'destFacilities',
            'destGallery',
            'destCategory',
            'destVillage',
            'destDistrict'
        ));
    }

    private function getDestinationMetadata(string $name): array
    {
        $nameLower = strtolower(trim($name));

        // 1. Wisata Alam & Buper Cinta Rasa (Cintanagara)
        if (str_contains($nameLower, 'wisata alam') || str_contains($nameLower, 'cinta rasa') || str_contains($nameLower, 'cintanagara')) {
            return [
                'nama' => 'Wisata Alam & Buper Cinta Rasa',
                'desa' => 'Cintanagara',
                'kecamatan' => 'Jatinagara',
                'kategori' => 'Wisata Alam & Sejarah',
                'harga' => 6500,
                'deskripsi' => 'Wana Wisata Buper Cinta Rasa di Dusun Batudatar, Desa Cintanagara, Kecamatan Jatinagara menghadirkan perpaduan pesona hutan lindung alami, udara pegunungan yang sangat sejuk, serta peninggalan bersejarah turbin air era kolonial Belanda. Kawasan ini memiliki area bumi perkemahan yang luas di bawah naungan pepohonan hijau rindang, jalur jelajah alam yang asri, serta sumber mata air pegunungan yang jernih. Destinasi ini sangat cocok untuk kegiatan outbound, camping keluarga, komunitas pencinta alam, maupun rekreasi santai melepas penat dari hiruk pikuk perkotaan.',
                'fasilitas' => [
                    ['nama' => 'Area Camping Ground Luas', 'desc' => 'Lahan perkemahan rumput luas berkapasitas puluhan tenda dengan view perbukitan hijau.', 'icon' => 'bi-tent-fill'],
                    ['nama' => 'Peninggalan Turbin Belanda', 'desc' => 'Situs cagar budaya turbin air era kolonial sebagai sarana edukasi sejarah teknologi masa lalu.', 'icon' => 'bi-gear-wide-connected'],
                    ['nama' => 'Toilet & Kamar Mandi Bilas', 'desc' => 'Fasilitas sanitasi bersih dan terawat dengan ketersediaan air pegunungan alami.', 'icon' => 'bi-water'],
                    ['nama' => 'Tempat Ibadah / Mushola', 'desc' => 'Sarana ibadah yang bersih dan nyaman bagi wisatawan muslim.', 'icon' => 'bi-moon-stars-fill'],
                    ['nama' => 'Saung & Gazebo Istirahat', 'desc' => 'Tempat duduk santai beratap bambu untuk bercengkerama bersama keluarga.', 'icon' => 'bi-house-heart-fill'],
                    ['nama' => 'Warung Kopi & Kuliner Lokal', 'desc' => 'Menyajikan aneka minuman hangat, kopi khas lereng bukit, dan makanan ringan.', 'icon' => 'bi-cup-hot-fill'],
                    ['nama' => 'Area Parkir Kendaraan', 'desc' => 'Tempat parkir motor dan mobil yang aman di area pintu masuk destinasi.', 'icon' => 'bi-p-square-fill'],
                    ['nama' => 'Spot Foto Panorama Alam', 'desc' => 'Sudut swafoto menarik dengan latar bentangan bukit dan lembah hijau.', 'icon' => 'bi-camera-fill'],
                ],
                'galeri' => [
                    'pictures/destinasi/CintaNagara.webp',
                    'pictures/destinasi/BumiPekemahan.jpeg',
                    'pictures/destinasi/AgroCipaku.webp',
                    'pictures/destinasi/KampungSawah.jpeg',
                ]
            ];
        }

        // 2. Agrowisata Pedesaan Cintanagara
        if (str_contains($nameLower, 'agrowisata') || str_contains($nameLower, 'agro')) {
            return [
                'nama' => 'Agrowisata Pedesaan Cintanagara',
                'desa' => 'Cintanagara',
                'kecamatan' => 'Jatinagara',
                'kategori' => 'Agrowisata & Edukasi',
                'harga' => 6500,
                'deskripsi' => 'Agrowisata Pedesaan Cintanagara merupakan kawasan perkebunan hortikultura dan budidaya tanaman pangan terpadu berbasis kearifan lokal masyarakat Desa Cintanagara. Pengunjung dapat menikmati pengalaman memetik aneka buah-buahan lokal segar langsung dari pohonnya, belajar teknik pertanian ramah lingkungan, serta bersantai di gazebo tepi kebun dengan udara pegunungan yang bersih. Destinasi ini menghadirkan suasana edukatif dan menyejukkan bagi keluarga, anak-anak sekolah, maupun pencinta agrikultur.',
                'fasilitas' => [
                    ['nama' => 'Kebun Edukasi Petik Buah', 'desc' => 'Area perkebunan buah lokal yang dapat dipetik langsung bersama pemandu tani.', 'icon' => 'bi-tree-fill'],
                    ['nama' => 'Pusat Bibit & Hasil Panen', 'desc' => 'Gerai penjualan sayur organik segar, buah tangan, dan aneka bibit tanaman.', 'icon' => 'bi-basket2-fill'],
                    ['nama' => 'Saung Edukasi Tani', 'desc' => 'Bale pertemuan terbuka untuk belajar teknik bertani dan pengolahan hasil panen.', 'icon' => 'bi-book-half'],
                    ['nama' => 'Gazebo Tengah Kebun', 'desc' => 'Tempat berteduh dan menikmati hidangan di tengah rimbunnya kebun hortikultura.', 'icon' => 'bi-house-fill'],
                    ['nama' => 'Toilet & Fasilitas Bersih', 'desc' => 'Fasilitas sanitasi dengan sabun dan air mengalir yang terjaga higienis.', 'icon' => 'bi-water'],
                    ['nama' => 'Kantin Olahan Hasil Kebun', 'desc' => 'Menyediakan jus buah segar, camilan hangat, dan kuliner khas desa.', 'icon' => 'bi-cup-straw'],
                    ['nama' => 'Area Parkir Nyaman', 'desc' => 'Lokasi parkir kendaraan roda 2 dan roda 4 yang mudah diakses.', 'icon' => 'bi-p-square-fill'],
                    ['nama' => 'Spot Foto Agro Instagramable', 'desc' => 'Lorong tanaman rambat dan dekorasi pertanian estetik untuk berfoto.', 'icon' => 'bi-camera-fill'],
                ],
                'galeri' => [
                    'pictures/destinasi/AgroCipaku.webp',
                    'pictures/destinasi/CintaNagara.webp',
                    'pictures/destinasi/PasirBoma.jpeg',
                    'pictures/destinasi/KampungSawah.jpeg',
                ]
            ];
        }

        // 3. Jalan Usaha Tani
        if (str_contains($nameLower, 'jalan usaha tani') || str_contains($nameLower, 'usaha tani')) {
            return [
                'nama' => 'Jalan Usaha Tani Cintanagara',
                'desa' => 'Cintanagara',
                'kecamatan' => 'Jatinagara',
                'kategori' => 'Wisata Alam & Olahraga',
                'harga' => 6500,
                'deskripsi' => 'Jalan Usaha Tani Cintanagara menyuguhkan jalur lintasan pedesaan berhawa sejuk yang membentang menembus hamparan persawahan terasering hijau dan aliran parit irigasi alami. Jalur ini menjadi favorit wisatawan untuk berolahraga pagi seperti jogging, jalan santai, maupun bersepeda lintas alam. Lanskap sawah bertingkat dengan latar panorama perbukitan Jatinagara yang sering diselimuti kabut pagi menciptakan suasana damai dan menenangkan jiwa.',
                'fasilitas' => [
                    ['nama' => 'Jalur Jogging & Sepeda Sawah', 'desc' => 'Lintasan paving dan tanah padat yang aman dan nyaman dilalui bersepeda santai.', 'icon' => 'bi-bicycle'],
                    ['nama' => 'Gardu Pandang Terasering', 'desc' => 'Panggung kayu terbuka untuk menikmati lanskap sawah dan perbukitan dari ketinggian.', 'icon' => 'bi-binoculars-fill'],
                    ['nama' => 'Spot Foto Pematang Estetik', 'desc' => 'Titik swafoto berlatar hamparan padi hijau berundak dan pemandangan sunrise.', 'icon' => 'bi-camera-fill'],
                    ['nama' => 'Bangku Istirahat Pedesaan', 'desc' => 'Tempat duduk santai di sepanjang jalur untuk menikmati hembusan angin sejuk.', 'icon' => 'bi-chair'],
                    ['nama' => 'Warung Kopi & Jajanan Desa', 'desc' => 'Warung ramah warga yang menjajakan kopi tubruk, teh manis, dan makanan tradisional.', 'icon' => 'bi-cup-hot-fill'],
                    ['nama' => 'Area Parkir Kendaraan', 'desc' => 'Titik kumpul dan parkir di awal gerbang masuk jalur lintasan tani.', 'icon' => 'bi-p-square-fill'],
                    ['nama' => 'Tempat Sampah Terpadu', 'desc' => 'Fasilitas kebersihan di titik istirahat untuk menjaga keaslian lingkungan sawah.', 'icon' => 'bi-trash3-fill'],
                    ['nama' => 'Toilet Umum', 'desc' => 'Fasilitas toilet umum di pos singgah rute jalan tani.', 'icon' => 'bi-water'],
                ],
                'galeri' => [
                    'pictures/destinasi/KampungSawah.jpeg',
                    'pictures/destinasi/CintaNagara.webp',
                    'pictures/destinasi/PasirBoma.jpeg',
                    'pictures/destinasi/AgroCipaku.webp',
                ]
            ];
        }

        // 4. Situ Wangi (Winduraja)
        if (str_contains($nameLower, 'situ wangi') || str_contains($nameLower, 'winduraja')) {
            return [
                'nama' => 'Situ Wangi',
                'desa' => 'Winduraja',
                'kecamatan' => 'Kawali',
                'kategori' => 'Wisata Alam & Air',
                'harga' => 6500,
                'deskripsi' => 'Situ Wangi merupakan danau alami dengan panorama asri nan tenang di Dusun Hayawang, Desa Winduraja, Kecamatan Kawali. Dikelilingi perbukitan hijau dan pohon-pohon rindang, Situ Wangi telah direvitalisasi dengan fasilitas modern seperti jogging track keliling danau, wahana perahu air bebek keluarga, view tower, serta area memancing yang nyaman.',
                'fasilitas' => [
                    ['nama' => 'Wahana Perahu Air Bebek', 'desc' => 'Perahu kayuh santai untuk berkeliling menikmati danau bersama keluarga.', 'icon' => 'bi-water'],
                    ['nama' => 'Jogging Track Keliling Danau', 'desc' => 'Lintasan olahraga keliling danau berlantai paving rapi dan aman.', 'icon' => 'bi-person-walking'],
                    ['nama' => 'View Tower & Dermaga Foto', 'desc' => 'Menara pandang dan anjungan dermaga estetik untuk berswafoto.', 'icon' => 'bi-binoculars-fill'],
                    ['nama' => 'Area Parkir Luas', 'desc' => 'Lahan parkir kendaraan roda 2, roda 4, dan bus wisata yang representatif.', 'icon' => 'bi-p-square-fill'],
                    ['nama' => 'Warung Kuliner Lesehan', 'desc' => 'Menyajikan aneka masakan khas Sunda, ikan bakar, dan kelapa muda.', 'icon' => 'bi-cup-hot-fill'],
                    ['nama' => 'Toilet & Kamar Mandi', 'desc' => 'Fasilitas toilet umum yang bersih dan terawat dengan baik.', 'icon' => 'bi-door-closed-fill'],
                    ['nama' => 'Mushola', 'desc' => 'Mushola bersih dan nyaman dengan tempat wudhu memadai.', 'icon' => 'bi-moon-stars-fill'],
                    ['nama' => 'Gazebo Santai', 'desc' => 'Gazebo teduh pinggir danau untuk beristirahat dan berpiknik.', 'icon' => 'bi-house-fill'],
                ],
                'galeri' => [
                    'pictures/destinasi/WinduRaja.jpeg',
                    'pictures/destinasi/SituWangi.jpeg',
                    'pictures/destinasi/SituLengkongPanjalu.jpeg',
                    'pictures/destinasi/SituRancabala.jpeg',
                ]
            ];
        }

        // 5. Astana Gede Kawali
        if (str_contains($nameLower, 'astana gede') || str_contains($nameLower, 'kawali')) {
            return [
                'nama' => 'Astana Gede Kawali',
                'desa' => 'Kawali',
                'kecamatan' => 'Kawali',
                'kategori' => 'Sejarah & Budaya',
                'harga' => 6500,
                'deskripsi' => 'Astana Gede Kawali merupakan kawasan cagar budaya peninggalan Kerajaan Sunda Galuh yang sarat nilai sejarah dan spiritual. Di tengah hutan lindung sakral seluas 5 hektar yang asri, pengunjung dapat menyaksikan 6 prasasti kuno beraksara dan berbahasa Sunda Kuno, batu tapak peninggalan Prabu Niskala Wastu Kancana, serta makam tokoh bersejarah Kerajaan Galuh.',
                'fasilitas' => [
                    ['nama' => 'Pemandu Cagar Budaya', 'desc' => 'Pemandu lokal bersertifikat yang siap menceritakan sejarah prasasti dan Kerajaan Galuh.', 'icon' => 'bi-person-badge-fill'],
                    ['nama' => 'Museum & Pusat Informasi', 'desc' => 'Pusat informasi sejarah dan dokumentasi prasasti kuno peninggalan Galuh.', 'icon' => 'bi-building-fill'],
                    ['nama' => 'Hutan Lindung & Jalur Setapak', 'desc' => 'Jalur setapak paving teduh di bawah naungan pohon-pohon berusia ratusan tahun.', 'icon' => 'bi-tree-fill'],
                    ['nama' => 'Area Parkir Luas', 'desc' => 'Parkir kendaraan roda 2, roda 4, dan bus pariwisata yang tertata rapi.', 'icon' => 'bi-p-square-fill'],
                    ['nama' => 'Toilet & Tempat Wudhu', 'desc' => 'Fasilitas sanitasi yang bersih dan tempat wudhu air jernih alami.', 'icon' => 'bi-water'],
                    ['nama' => 'Mushola', 'desc' => 'Mushola yang tenang dan nyaman bagi pengunjung yang hendak beribadah.', 'icon' => 'bi-moon-stars-fill'],
                    ['nama' => 'Toko Cinderamata & Warung', 'desc' => 'Menjual aneka oleh-oleh khas Kawali, makanan ringan, dan souvenir.', 'icon' => 'bi-shop'],
                    ['nama' => 'Bale & Saung Istirahat', 'desc' => 'Bale bambu tradisional untuk singgah dan berdiskusi.', 'icon' => 'bi-house-heart-fill'],
                ],
                'galeri' => [
                    'pictures/destinasi/AstanaGedeKawali.jpeg',
                    'pictures/destinasi/Karangkamulyan.jpeg',
                    'pictures/destinasi/GunungSusuru.jpeg',
                    'pictures/destinasi/WinduRaja.jpeg',
                ]
            ];
        }

        // Generic Fallback dengan Fasilitas Sangat Lengkap
        return [
            'nama' => $name,
            'desa' => 'Kabupaten Ciamis',
            'kecamatan' => 'Ciamis',
            'kategori' => 'Wisata Alam',
            'harga' => 6500,
            'deskripsi' => "Destinasi wisata {$name} merupakan salah satu daya tarik wisata unggulan yang berada di Kabupaten Ciamis, Jawa Barat. Menghadirkan perpaduan keindahan alam yang masih asri, udara segar pegunungan, serta kehangatan budaya masyarakat pedesaan. Destinasi ini sangat cocok sebagai destinasi liburan keluarga, rekreasi komunitas, kegiatan fotografi, maupun bersantai menikmati pesona alam Priangan Timur yang memikat hati.",
            'fasilitas' => [
                ['nama' => 'Area Parkir Kendaraan', 'desc' => 'Tersedia tempat parkir roda 2 dan roda 4 yang aman dan mudah dijangkau.', 'icon' => 'bi-p-square-fill'],
                ['nama' => 'Toilet & Kamar Mandi Bersih', 'desc' => 'Fasilitas sanitasi yang bersih dan terawat dengan ketersediaan air bersih mengalir.', 'icon' => 'bi-water'],
                ['nama' => 'Mushola & Tempat Ibadah', 'desc' => 'Sarana ibadah yang bersih dan nyaman bagi pengunjung muslim.', 'icon' => 'bi-moon-stars-fill'],
                ['nama' => 'Gazebo / Saung Istirahat', 'desc' => 'Tempat berteduh dan bercengkerama santai di sekeliling area wisata.', 'icon' => 'bi-house-fill'],
                ['nama' => 'Warung Kuliner Khas', 'desc' => 'Menjual aneka sajian kuliner lokal, makanan ringan, dan minuman hangat.', 'icon' => 'bi-cup-hot-fill'],
                ['nama' => 'Spot Foto Instagramable', 'desc' => 'Beragam sudut swafoto estetik berlatar panorama alam terbuka.', 'icon' => 'bi-camera-fill'],
                ['nama' => 'Pusat Informasi & Petugas', 'desc' => 'Petugas pengelola destinasi yang siap membantu informasi dan keamanan pengunjung.', 'icon' => 'bi-info-circle-fill'],
                ['nama' => 'Tempat Sampah Terpadu', 'desc' => 'Tempat pembuangan sampah di titik strategis untuk menjaga kebersihan lokasi.', 'icon' => 'bi-trash3-fill'],
            ],
            'galeri' => [
                'pictures/destinasi/' . str_replace(' ', '', $name) . '.jpeg',
                'pictures/destinasi/WinduRaja.jpeg',
                'pictures/destinasi/CintaNagara.webp',
                'pictures/destinasi/KampungSawah.jpeg',
            ]
        ];
    }

    public function storeReview(Request $request, $slug)
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['required', 'string', 'min:5', 'max:1000'],
            'destination_name' => ['required', 'string'],
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('login_error', 'Silakan login terlebih dahulu untuk menulis ulasan.');
        }

        $user = Auth::user();

        DestinationReview::create([
            'user_id' => $user->id,
            'user_name' => $user->nama,
            'destination_name' => $request->destination_name,
            'rating' => $request->rating,
            'comment' => $request->komentar,
        ]);

        return back()->with('success_ulasan', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}
