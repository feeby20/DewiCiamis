<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('pengelola')->check()) {
            return redirect()->route('pengelola.dashboard');
        }
        return view('pengelola.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah input berupa email atau username
        $fieldType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attemptData = [
            $fieldType => $credentials['login'],
            'password' => $credentials['password'],
            'is_active' => true,
        ];

        if (Auth::guard('pengelola')->attempt($attemptData, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('pengelola.dashboard'))
                ->with('success', 'Selamat datang di Panel Pengelola ' . Auth::guard('pengelola')->user()->desa->nama_desa);
        }

        return back()->withInput($request->only('login'))
            ->withErrors(['login' => 'Username/Email atau Password salah, atau akun belum aktif.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('pengelola')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pengelola.login')->with('success', 'Anda telah berhasil keluar.');
    }
}
