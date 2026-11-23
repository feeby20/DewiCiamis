<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index()
    {
        $beritaList = Berita::orderBy('tanggal', 'desc')->paginate(15);
        return view('admin.berita.index', compact('beritaList'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'ringkasan' => ['required', 'string'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . md5(uniqid()) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/berita');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0777, true);
            }
            $file->move($destination, $filename);
            $gambarPath = 'uploads/berita/' . $filename;
        }

        Berita::create([
            'judul' => $validated['judul'],
            'ringkasan' => $validated['ringkasan'],
            'isi' => $validated['isi'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'ringkasan' => ['required', 'string'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . md5(uniqid()) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/berita');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0777, true);
            }
            $file->move($destination, $filename);
            $berita->gambar = 'uploads/berita/' . $filename;
        }

        $berita->judul = $validated['judul'];
        $berita->ringkasan = $validated['ringkasan'];
        $berita->isi = $validated['isi'];
        $berita->tanggal = $validated['tanggal'];
        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && File::exists(public_path($berita->gambar))) {
            File::delete(public_path($berita->gambar));
        }
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
