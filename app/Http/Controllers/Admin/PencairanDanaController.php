<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesaWisata;
use App\Models\PencairanDana;
use Illuminate\Http\Request;

class PencairanDanaController extends Controller
{
    public function index(Request $request)
    {
        $query = PencairanDana::with(['desa', 'pengelola']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->desa_id);
        }

        $pencairanList = $query->latest('tanggal_pengajuan')->paginate(15);

        // Ringkasan
        $totalPengajuan = PencairanDana::count();
        $totalMenunggu = PencairanDana::where('status', 'menunggu')->count();
        $totalNominalDicairkan = PencairanDana::where('status', 'disetujui')->sum('nominal');
        $nominalMenunggu = PencairanDana::where('status', 'menunggu')->sum('nominal');

        $desaList = DesaWisata::orderBy('nama_desa')->get(['id', 'nama_desa']);

        return view('admin.pencairan.index', compact(
            'pencairanList',
            'totalPengajuan',
            'totalMenunggu',
            'totalNominalDicairkan',
            'nominalMenunggu',
            'desaList'
        ));
    }

    public function konfirmasi(Request $request, $id)
    {
        $pencairan = PencairanDana::with('desa')->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:3072',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $desa = $pencairan->desa;

        if ($validated['status'] === 'disetujui') {
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $filename = 'bukti_wd_' . $pencairan->kode_pencairan . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/bukti_pencairan'), $filename);
                $pencairan->bukti_transfer = 'uploads/bukti_pencairan/' . $filename;
            }

            $pencairan->status = 'disetujui';
            $pencairan->catatan_admin = $validated['catatan_admin'];
            $pencairan->tanggal_konfirmasi = now();
            $pencairan->save();

            // Tambahkan ke saldo_dicairkan desa
            $desa->increment('saldo_dicairkan', $pencairan->nominal);

            return back()->with('success', "Pencairan dana {$pencairan->kode_pencairan} senilai Rp " . number_format($pencairan->nominal, 0, ',', '.') . " ke rekening {$desa->nama_bank} ({$desa->nomor_rekening}) BERHASIL DIKONFIRMASI!");
        } else {
            // Jika ditolak, kembalikan saldo ke saldo_tersedia desa
            $pencairan->status = 'ditolak';
            $pencairan->catatan_admin = $validated['catatan_admin'] ?? 'Pengajuan ditolak oleh dinas.';
            $pencairan->tanggal_konfirmasi = now();
            $pencairan->save();

            $desa->increment('saldo_tersedia', $pencairan->nominal);

            return back()->with('info', "Pengajuan pencairan {$pencairan->kode_pencairan} DITOLAK. Saldo telah dikembalikan ke rekening desa {$desa->nama_desa}.");
        }
    }
}
