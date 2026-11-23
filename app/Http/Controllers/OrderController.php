<?php

namespace App\Http\Controllers;

use App\Models\DestinationPrice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Pemetaan nama destinasi slug ke nama resmi di database
    protected $destinationMap = [
        'situ-lengkong-panjalu' => 'Situ Lengkong Panjalu',
        'panjalu' => 'Situ Lengkong Panjalu',
        'situ-lengkong' => 'Situ Lengkong Panjalu',
        'situ-wangi' => 'Situ Wangi',
        'winduraja' => 'Situ Wangi',
        'astana-gede-kawali' => 'Astana Gede Kawali',
        'astana-gede' => 'Astana Gede Kawali',
        'kawali' => 'Astana Gede Kawali',
        'talagasari' => 'Kampung Sawah',
        'kampung-sawah' => 'Kampung Sawah',
        'mekarsari' => 'Puncak Meralaya',
        'puncak-meralaya' => 'Puncak Meralaya',
        'karangkamulyan' => 'Situs Karangkamulyan',
    ];

    public function index()
    {
        $orders = collect();
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $destinations = DestinationPrice::orderBy('destination_name')->get();

        return view('pemesanan.index', compact('orders', 'destinations'));
    }

    public function create(Request $request)
    {
        $selectedDestination = $request->query('destinasi', 'Situ Wangi');
        $destinations = DestinationPrice::orderBy('destination_name')->get();

        // Cari harga destinasi yang dipilih
        $dest = DestinationPrice::where('destination_name', $selectedDestination)->first();
        $ticketPrice = $dest ? $dest->ticket_price : 6500;

        return view('pemesanan.create', compact('selectedDestination', 'destinations', 'ticketPrice'));
    }

    public function store(Request $request)
    {
        // Mendukung POST format JSON (dari fetch JS) maupun Form Data biasa
        $isJson = $request->isJson() || $request->expectsJson();
        $data = $isJson ? $request->json()->all() : $request->all();

        if (!Auth::check()) {
            if ($isJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan masuk terlebih dahulu untuk memesan tiket.',
                ], 401);
            }
            return redirect()->route('login')->with('login_error', 'Silakan masuk terlebih dahulu.');
        }

        $destinationRaw = trim($data['destination'] ?? $data['destinasi'] ?? '');
        $fullName = trim($data['name'] ?? $data['full_name'] ?? '');
        $whatsapp = trim($data['whatsapp'] ?? '');
        $visitDate = trim($data['date'] ?? $data['visit_date'] ?? '');
        $ticketQty = (int) ($data['quantity'] ?? $data['ticket_qty'] ?? 1);

        if (!$destinationRaw || !$fullName || !$whatsapp || !$visitDate || $ticketQty < 1) {
            $msg = 'Harap lengkapi semua kolom formulir pemesanan dengan benar.';
            return $isJson
                ? response()->json(['success' => false, 'message' => $msg], 400)
                : back()->withErrors(['pesan' => $msg])->withInput();
        }

        // Resolusi nama destinasi
        $normalizedSlug = Str::slug($destinationRaw);
        $officialName = $this->destinationMap[$normalizedSlug] ?? $destinationRaw;

        // Cari harga tiket dari database
        $destPrice = DestinationPrice::where('destination_name', $officialName)
            ->orWhere('destination_name', 'LIKE', "%{$officialName}%")
            ->first();

        $ticketPrice = $destPrice ? (int) $destPrice->ticket_price : 6500;
        $totalPrice = $ticketPrice * $ticketQty;

        // Buat kode booking unik (format: VC-YYYYMMDD-XXXXXXXX)
        $bookingCode = 'VC-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        $destNameFinal = $destPrice ? $destPrice->destination_name : $officialName;

        // Cari desa wisata terkait
        $matchedDesa = \App\Models\DesaWisata::where('destinasi_unggulan', 'LIKE', "%{$destNameFinal}%")
            ->orWhere('nama_desa', 'LIKE', "%{$destNameFinal}%")
            ->orWhere('destinasi_unggulan', 'LIKE', "%{$destinationRaw}%")
            ->orWhere('nama_desa', 'LIKE', "%{$destinationRaw}%")
            ->first();

        $order = Order::create([
            'user_id' => Auth::id(),
            'desa_id' => $matchedDesa ? $matchedDesa->id : null,
            'booking_code' => $bookingCode,
            'full_name' => $fullName,
            'whatsapp' => $whatsapp,
            'destination_name' => $destNameFinal,
            'visit_date' => $visitDate,
            'ticket_qty' => $ticketQty,
            'ticket_price' => $ticketPrice,
            'total_price' => $totalPrice,
            'payment_status' => 'menunggu',
            'payment_proof' => null,
            'ticket_status' => 'active',
        ]);

        if ($isJson) {
            return response()->json([
                'success' => true,
                'message' => 'Pemesanan berhasil disimpan.',
                'booking_code' => $bookingCode,
                'redirect_url' => route('order.payment', ['booking' => $bookingCode]),
            ]);
        }

        return redirect()->route('order.payment', ['booking' => $bookingCode])
            ->with('success', 'Pemesanan berhasil dibuat! Silakan selesaikan pembayaran.');
    }

    public function payment(Request $request, $booking = null)
    {
        $bookingCode = $booking ?? $request->query('booking');

        if (!$bookingCode) {
            return redirect()->route('order.index')->with('error', 'Kode pemesanan tidak ditemukan.');
        }

        $order = Order::where('booking_code', $bookingCode)->firstOrFail();

        // Pastikan order milik user yang sedang login jika ada relasi user_id
        if (Auth::check() && $order->user_id && $order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('pemesanan.pembayaran', compact('order'));
    }

    public function uploadProof(Request $request)
    {
        $request->validate([
            'booking_code' => ['required', 'string'],
            'payment_proof' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'], // Max 3MB
        ], [
            'payment_proof.required' => 'Silakan pilih file bukti pembayaran.',
            'payment_proof.image' => 'File harus berupa gambar.',
            'payment_proof.max' => 'Ukuran file bukti maksimal 3 MB.',
        ]);

        $order = Order::where('booking_code', $request->booking_code)->firstOrFail();

        if (strtolower(trim($order->payment_status)) === 'lunas') {
            return back()->with('info', 'Pesanan ini sudah dinyatakan Lunas.');
        }

        $file = $request->file('payment_proof');
        $filename = md5(uniqid(mt_rand(), true)) . '.' . $file->getClientOriginalExtension();

        // Simpan ke public/uploads/bukti-pembayaran agar kompatibel dengan legacy path
        $destinationPath = public_path('uploads/bukti-pembayaran');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);

        $order->payment_proof = 'uploads/bukti-pembayaran/' . $filename;
        $order->payment_status = 'Menunggu Verifikasi';
        $order->save();

        return redirect()->route('order.payment', ['booking' => $order->booking_code])
            ->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi admin.');
    }

    public function checkStatus(Request $request)
    {
        $bookingCode = trim($request->query('booking', ''));

        if (!$bookingCode) {
            return response()->json(['success' => false, 'message' => 'Kode booking tidak ditemukan.'], 400);
        }

        $query = Order::where('booking_code', $bookingCode);
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        $order = $query->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan atau bukan milik akun Anda.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diambil.',
            'bookingCode' => $order->booking_code,
            'paymentStatus' => strtolower($order->payment_status),
            'order' => [
                'booking_code' => $order->booking_code,
                'destination_name' => $order->destination_name,
                'visit_date' => $order->visit_date ? $order->visit_date->format('Y-m-d') : null,
                'ticket_qty' => (int) $order->ticket_qty,
                'total_price' => (float) $order->total_price,
                'payment_status' => strtolower($order->payment_status),
            ],
        ]);
    }

    public function ticket($booking)
    {
        $order = Order::where('booking_code', $booking)->firstOrFail();

        return view('pemesanan.tiket', compact('order'));
    }

    public function myTickets()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('login_error', 'Silakan masuk untuk melihat tiket Anda.');
        }

        $orders = Order::where('user_id', Auth::id())
            ->whereRaw('LOWER(payment_status) = ?', ['lunas'])
            ->orderBy('visit_date', 'desc')
            ->get();

        return view('pemesanan.tiket-saya', compact('orders'));
    }
}
