<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PencairanDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function laporan(Request $request)
    {
        $desa = Auth::guard('pengelola')->user()->desa;

        $query = Order::where(function ($q) use ($desa) {
            $q->where('desa_id', $desa->id)
              ->orWhere('destination_name', 'LIKE', '%' . $desa->nama_desa . '%')
              ->orWhere('destination_name', 'LIKE', '%' . $desa->destinasi_unggulan . '%');
        });

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('visit_date', [$request->start_date, $request->end_date]);
        }

        $orders = $query->latest('created_at')->paginate(15);

        // Ringkasan
        $totalPendapatan = (clone $query)->where('payment_status', 'lunas')->sum('total_price');
        $totalTiket = (clone $query)->where('payment_status', 'lunas')->sum('ticket_qty');

        return view('pengelola.laporan', compact('desa', 'orders', 'totalPendapatan', 'totalTiket'));
    }

    public function pencairan()
    {
        $desa = Auth::guard('pengelola')->user()->desa;
        $pengelola = Auth::guard('pengelola')->user();

        // Ambil riwayat pengajuan pencairan dana desa ini
        $pencairanList = PencairanDana::where('desa_id', $desa->id)
            ->latest('created_at')
            ->paginate(10);

        return view('pengelola.pencairan', compact('desa', 'pengelola', 'pencairanList'));
    }

    public function requestPencairan(Request $request)
    {
        $pengelola = Auth::guard('pengelola')->user();
        $desa = $pengelola->desa;

        if (empty($desa->nomor_rekening) || empty($desa->nama_bank)) {
            return back()->with('error', 'Silakan lengkapi nomor rekening bank desa terlebih dahulu pada menu Rekening Bank Desa.');
        }

        $validated = $request->validate([
            'nominal' => 'required|numeric|min:10000|max:' . max(10000, $desa->saldo_tersedia),
            'catatan' => 'nullable|string|max:255',
        ], [
            'nominal.max' => 'Nominal pengajuan tidak boleh melebihi saldo tersedia (Rp ' . number_format($desa->saldo_tersedia, 0, ',', '.') . ').',
            'nominal.min' => 'Minimal pengajuan pencairan dana adalah Rp 10.000.',
        ]);

        if ($desa->saldo_tersedia < $validated['nominal']) {
            return back()->with('error', 'Saldo tersedia tidak mencukupi untuk nominal pengajuan ini.');
        }

        // Generate Kode Pencairan
        $kode = 'WD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        PencairanDana::create([
            'kode_pencairan' => $kode,
            'desa_id' => $desa->id,
            'pengelola_id' => $pengelola->id,
            'nominal' => $validated['nominal'],
            'bank_tujuan' => $desa->nama_bank,
            'nomor_rekening' => $desa->nomor_rekening,
            'atas_nama' => $desa->atas_nama_rekening,
            'status' => 'menunggu',
            'catatan_admin' => $validated['catatan'] ?? null,
            'tanggal_pengajuan' => now(),
        ]);

        // Kurangi saldo_tersedia desa sementara menunggu konfirmasi
        $desa->decrement('saldo_tersedia', $validated['nominal']);

        return back()->with('success', "Pengajuan pencairan dana senilai Rp " . number_format($validated['nominal'], 0, ',', '.') . " berhasil dikirim ke Admin Dinas Pariwisata.");
    }
}
