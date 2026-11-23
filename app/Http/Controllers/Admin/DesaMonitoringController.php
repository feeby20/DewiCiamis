<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesaWisata;
use App\Models\Order;
use App\Models\PengelolaDesa;
use Illuminate\Http\Request;

class DesaMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $query = DesaWisata::with('pengelola');

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->filled('status')) {
            $query->where('status_desa', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_desa', 'LIKE', "%{$s}%")
                  ->orWhere('destinasi_unggulan', 'LIKE', "%{$s}%")
                  ->orWhere('kecamatan', 'LIKE', "%{$s}%");
            });
        }

        $desaList = $query->orderBy('nama_desa')->paginate(20);

        // Agregasi Statistik Keseluruhan 57 Desa
        $totalDesa = DesaWisata::count();
        $totalPengunjung = Order::where('payment_status', 'lunas')->sum('ticket_qty');
        $totalPendapatan = Order::where('payment_status', 'lunas')->sum('total_price');
        $totalSaldoTersedia = DesaWisata::sum('saldo_tersedia');
        $totalSaldoDicairkan = DesaWisata::sum('saldo_dicairkan');

        // Daftar Kecamatan unik untuk filter
        $kecamatanList = DesaWisata::select('kecamatan')->distinct()->orderBy('kecamatan')->pluck('kecamatan');

        return view('admin.desa.index', compact(
            'desaList',
            'totalDesa',
            'totalPengunjung',
            'totalPendapatan',
            'totalSaldoTersedia',
            'totalSaldoDicairkan',
            'kecamatanList'
        ));
    }

    public function show($id)
    {
        $desa = DesaWisata::with(['pengelola', 'pencairanDana' => function ($q) {
            $q->latest()->take(10);
        }])->findOrFail($id);

        $orders = Order::where('desa_id', $desa->id)
            ->latest('created_at')
            ->take(15)
            ->get();

        $totalTiket = Order::where('desa_id', $desa->id)->where('payment_status', 'lunas')->sum('ticket_qty');
        $totalPendapatan = Order::where('desa_id', $desa->id)->where('payment_status', 'lunas')->sum('total_price');

        return view('admin.desa.show', compact('desa', 'orders', 'totalTiket', 'totalPendapatan'));
    }
}
