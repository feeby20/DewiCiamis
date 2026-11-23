<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $destinasi = $request->query('destinasi');
        $status = $request->query('status');
        $search = $request->query('q');

        $query = Order::orderBy('created_at', 'desc');

        if ($destinasi) {
            $query->where('destination_name', $destinasi);
        }

        if ($status) {
            $query->where('payment_status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'LIKE', "%{$search}%")
                  ->orWhere('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('whatsapp', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();

        $daftarDestinasi = Order::distinct()->orderBy('destination_name')->pluck('destination_name');

        // Ringkasan
        $summaryQuery = clone $query;
        $totalOrders = $summaryQuery->count();
        $totalTickets = $summaryQuery->sum('ticket_qty');
        $totalSales = $summaryQuery->whereRaw('LOWER(payment_status) = ?', ['lunas'])->sum('total_price');

        return view('admin.orders.index', compact('orders', 'daftarDestinasi', 'totalOrders', 'totalTickets', 'totalSales', 'destinasi', 'status', 'search'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.detail', compact('order'));
    }

    public function verifikasi(Request $request)
    {
        // Khusus halaman daftar pesanan yang butuh verifikasi (bukti sudah diunggah tapi belum lunas)
        $orders = Order::whereNotNull('payment_proof')
            ->whereRaw('LOWER(payment_status) != ?', ['lunas'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.verifikasi', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string'],
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = strtolower(trim($order->payment_status));
        $newStatus = strtolower(trim($request->status));

        $order->payment_status = $request->status;

        // Jika disetujui lunas, aktifkan tiket dan tambahkan saldo ke kas desa bersangkutan
        if ($newStatus === 'lunas' && $oldStatus !== 'lunas') {
            $order->ticket_status = 'active';

            // Jika desa_id belum terhubung, hubungkan otomatis
            if (!$order->desa_id) {
                $matchedDesa = \App\Models\DesaWisata::where('destinasi_unggulan', 'LIKE', "%{$order->destination_name}%")
                    ->orWhere('nama_desa', 'LIKE', "%{$order->destination_name}%")
                    ->first();
                if ($matchedDesa) {
                    $order->desa_id = $matchedDesa->id;
                }
            }

            if ($order->desa_id) {
                \App\Models\DesaWisata::where('id', $order->desa_id)->increment('saldo_tersedia', $order->total_price);
            }
        }

        $order->save();

        return back()->with('success', 'Status pesanan #' . $order->booking_code . ' berhasil diubah menjadi: ' . $order->payment_status);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
