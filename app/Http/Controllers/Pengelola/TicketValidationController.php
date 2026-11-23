<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketValidationController extends Controller
{
    public function index()
    {
        $pengelola = Auth::guard('pengelola')->user();
        $desa = $pengelola->desa;

        // Ambil riwayat tiket yang sudah divalidasi oleh desa ini
        $history = Order::where('desa_id', $desa->id)
            ->where('ticket_status', 'used')
            ->latest('validated_at')
            ->take(15)
            ->get();

        return view('pengelola.validasi_tiket', compact('desa', 'history'));
    }

    public function checkTicket(Request $request)
    {
        $bookingCode = trim($request->input('booking_code', ''));
        $desa = Auth::guard('pengelola')->user()->desa;

        if (empty($bookingCode)) {
            return back()->with('error', 'Silakan masukkan kode booking atau scan QR Code e-tiket.');
        }

        // Cari pesanan
        $order = Order::where('booking_code', $bookingCode)->first();

        if (!$order) {
            return back()->with('error', "Tiket dengan kode booking '{$bookingCode}' tidak ditemukan di sistem.")
                         ->withInput();
        }

        // Validasi apakah tiket milik desa ini
        $isMatch = ($order->desa_id == $desa->id) ||
                   (stripos($order->destination_name, $desa->nama_desa) !== false) ||
                   (stripos($order->destination_name, $desa->destinasi_unggulan) !== false);

        if (!$isMatch) {
            return back()->with('error', "Tiket ini BUKAN untuk {$desa->nama_desa}, melainkan untuk destinasi: {$order->destination_name}.")
                         ->withInput();
        }

        return back()->with('checked_order', $order)->withInput();
    }

    public function validateTicket(Request $request, $id)
    {
        $pengelola = Auth::guard('pengelola')->user();
        $desa = $pengelola->desa;

        $order = Order::findOrFail($id);

        if ($order->payment_status !== 'lunas') {
            return back()->with('error', 'Tiket ini BELUM LUNAS pembayaran, tidak dapat divalidasi.');
        }

        if ($order->ticket_status === 'used') {
            return back()->with('error', "Tiket ini SUDAH DIGUNAKAN sebelumnya pada: " . ($order->validated_at ? $order->validated_at->format('d M Y H:i') : '-'));
        }

        $order->update([
            'desa_id' => $desa->id,
            'ticket_status' => 'used',
            'validated_at' => now(),
            'validated_by' => $pengelola->id,
        ]);

        return back()->with('success', "BERHASIL! Tiket {$order->booking_code} atas nama {$order->full_name} ({$order->ticket_qty} orang) telah divalidasi dan check-in.");
    }
}
