<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalTiket = $orders->where('payment_status', 'Lunas')->sum('ticket_qty');
        $totalPesanan = $orders->count();
        $menungguPembayaran = $orders->whereIn('payment_status', ['Menunggu Pembayaran', 'menunggu pembayaran'])->count();

        return view('akun.index', compact('user', 'orders', 'totalTiket', 'totalPesanan', 'menungguPembayaran'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->nama = $validated['nama'];
        $user->email = $validated['email'];

        if (!empty($validated['new_password'])) {
            if (empty($validated['current_password'])) {
                return back()->withErrors(['current_password' => 'Masukkan kata sandi lama untuk mengubah kata sandi.']);
            }

            if (!Hash::check($validated['current_password'], $user->password) && !password_verify($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }

            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();
        session(['user_nama' => $user->nama]);

        return back()->with('success_profil', 'Profil Anda berhasil diperbarui.');
    }
}
