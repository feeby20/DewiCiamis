<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    public function profil()
    {
        $desa = Auth::guard('pengelola')->user()->desa;
        return view('pengelola.profil_desa', compact('desa'));
    }

    public function updateProfil(Request $request)
    {
        $desa = Auth::guard('pengelola')->user()->desa;

        $validated = $request->validate([
            'deskripsi' => 'required|string',
            'jam_buka' => 'required|string|max:100',
            'hari_operasional' => 'required|string|max:100',
            'harga_tiket' => 'required|numeric|min:0',
            'destinasi_unggulan' => 'nullable|string|max:150',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = 'desa_' . $desa->slug . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/desa'), $filename);
            $validated['gambar'] = 'uploads/desa/' . $filename;
        }

        $desa->update($validated);

        return back()->with('success', 'Profil dan informasi destinasi desa berhasil diperbarui!');
    }

    public function rekening()
    {
        $desa = Auth::guard('pengelola')->user()->desa;
        return view('pengelola.rekening', compact('desa'));
    }

    public function updateRekening(Request $request)
    {
        $desa = Auth::guard('pengelola')->user()->desa;

        $validated = $request->validate([
            'nama_bank' => 'required|string|max:50',
            'nomor_rekening' => 'required|string|max:50',
            'atas_nama_rekening' => 'required|string|max:100',
        ]);

        $desa->update($validated);

        return back()->with('success', 'Nomor rekening bank kas/BUMDes desa berhasil disimpan!');
    }
}
