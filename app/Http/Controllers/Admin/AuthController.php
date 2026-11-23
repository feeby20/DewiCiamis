<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && (Hash::check($credentials['password'], $admin->password_hash) || password_verify($credentials['password'], $admin->password_hash))) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();

            session(['admin_id' => $admin->id, 'admin_email' => $admin->email, 'is_admin' => true, 'role' => 'admin']);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password admin salah.')->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('info', 'Anda telah keluar dari panel admin.');
    }
}
