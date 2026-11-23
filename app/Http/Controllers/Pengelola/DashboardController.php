<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PencairanDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pengelola = Auth::guard('pengelola')->user();
        $desa = $pengelola->desa;

        // Ambil order untuk desa ini
        $desaOrders = Order::where(function ($q) use ($desa) {
            $q->where('desa_id', $desa->id)
              ->orWhere('destination_name', 'LIKE', '%' . $desa->nama_desa . '%')
              ->orWhere('destination_name', 'LIKE', '%' . $desa->destinasi_unggulan . '%');
        });

        $totalPengunjung = (clone $desaOrders)->where('payment_status', 'lunas')->sum('ticket_qty');
        $totalPendapatan = (clone $desaOrders)->where('payment_status', 'lunas')->sum('total_price');
        $tiketTervalidasi = (clone $desaOrders)->where('ticket_status', 'used')->count();
        $tiketAktif = (clone $desaOrders)->where('payment_status', 'lunas')->where('ticket_status', 'active')->count();

        // Pengunjung hari ini
        $pengunjungHariIni = (clone $desaOrders)
            ->where('payment_status', 'lunas')
            ->whereDate('visit_date', today())
            ->sum('ticket_qty');

        // Pesanan terbaru
        $recentOrders = (clone $desaOrders)
            ->latest('created_at')
            ->take(6)
            ->get();

        // Pencairan terakhir
        $recentPencairan = PencairanDana::where('desa_id', $desa->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pengelola.dashboard', compact(
            'pengelola',
            'desa',
            'totalPengunjung',
            'totalPendapatan',
            'tiketTervalidasi',
            'tiketAktif',
            'pengunjungHariIni',
            'recentOrders',
            'recentPencairan'
        ));
    }
}
