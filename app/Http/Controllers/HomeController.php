<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\DestinationPrice;
use App\Models\DestinationReview;
use App\Models\SupportFaq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faqs = SupportFaq::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        $ulasan = DestinationReview::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $destinasiUnggulan = DestinationPrice::where('ticket_price', '>', 0)
            ->orderBy('destination_name')
            ->take(6)
            ->get();

        return view('home', compact('faqs', 'beritaTerbaru', 'ulasan', 'destinasiUnggulan'));
    }
}
