<?php

namespace App\Http\Controllers;

use App\Models\SupportFaq;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $faqs = SupportFaq::where('is_active', 1)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        $trackedMessage = null;
        if ($request->filled('ticket_code')) {
            $trackedMessage = SupportMessage::where('ticket_code', trim($request->ticket_code))->first();
        }

        return view('bantuan.index', compact('faqs', 'trackedMessage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'topic' => ['required', 'string', 'max:100'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'topic.required' => 'Pilih topik bantuan.',
            'subject.required' => 'Subjek pertanyaan wajib diisi.',
            'message.required' => 'Pesan pertanyaan wajib diisi minimal 10 karakter.',
        ]);

        $ticketCode = 'BANTUAN-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

        SupportMessage::create([
            'ticket_code' => $ticketCode,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'topic' => $validated['topic'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'baru',
        ]);

        return redirect()->route('support.index', ['ticket_code' => $ticketCode])
            ->with('success_bantuan', 'Pesan bantuan Anda berhasil dikirim! Simpan kode tiket berikut: ' . $ticketCode);
    }
}
