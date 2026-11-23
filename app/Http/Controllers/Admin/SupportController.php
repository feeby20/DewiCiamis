<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportFaq;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $messages = SupportMessage::orderBy('created_at', 'desc')->paginate(20);
        $faqs = SupportFaq::orderBy('sort_order')->get();

        return view('admin.bantuan.index', compact('messages', 'faqs'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => ['required', 'string'],
        ]);

        $message = SupportMessage::findOrFail($id);
        $message->admin_reply = $request->admin_reply;
        $message->status = 'selesai';
        $message->replied_at = now();
        $message->save();

        return back()->with('success', 'Balasan berhasil dikirim untuk tiket ' . $message->ticket_code);
    }

    public function destroy($id)
    {
        $message = SupportMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Pesan bantuan berhasil dihapus.');
    }
}
