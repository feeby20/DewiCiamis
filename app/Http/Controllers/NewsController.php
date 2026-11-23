<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $beritaList = Berita::orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('berita.index', compact('beritaList'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        $beritaTerkait = Berita::where('id', '!=', $id)
            ->orderBy('tanggal', 'desc')
            ->take(4)
            ->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
}
