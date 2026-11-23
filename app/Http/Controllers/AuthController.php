<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if ($request->has('return_url')) {
            session(['return_url' => $request->query('return_url')]);
        } else {
            $prev = url()->previous();
            if ($prev && !str_contains($prev, 'login') && !str_contains($prev, 'masuk.php') && !str_contains($prev, 'register') && !str_contains($prev, 'daftar.php')) {
                session(['return_url' => $prev]);
            }
        }

        if (Auth::guard('web')->check()) {
            // Sinkronkan ke native session
            if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
                @session_start();
            }
            if (isset($_SESSION)) {
                $u = Auth::guard('web')->user();
                $_SESSION['user_id'] = $u->id;
                $_SESSION['user_nama'] = $u->nama;
                $_SESSION['role'] = $u->role;
            }

            $returnUrl = session()->pull('return_url');
            if ($returnUrl) {
                return redirect($returnUrl);
            }
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        // Cari user terlebih dahulu untuk mengecek format password
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Jika password match baik Bcrypt maupun hash lama
            if (Hash::check($credentials['password'], $user->password) || password_verify($credentials['password'], $user->password)) {
                // Rehash jika dibutuhkan
                if (Hash::needsRehash($user->password)) {
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                }

                Auth::guard('web')->login($user, $remember);
                $request->session()->regenerate();

                // Simpan nama di session untuk kemudahan tampilan jika diperlukan
                session(['user_id' => $user->id, 'user_nama' => $user->nama, 'role' => $user->role]);

                // Sinkronkan ke native PHP session agar halaman legacy langsung mendeteksi user sudah login
                if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
                    @session_start();
                }
                if (isset($_SESSION)) {
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_nama'] = $user->nama;
                    $_SESSION['role'] = $user->role;
                }

                if ($user->isAdmin()) {
                    return redirect()->intended(route('admin.dashboard'));
                }

                $returnUrl = session()->pull('return_url');
                if ($returnUrl) {
                    return redirect($returnUrl)->with('success', 'Selamat datang kembali, ' . $user->nama . '!');
                }

                return redirect()->intended(route('home'))->with('success', 'Selamat datang kembali, ' . $user->nama . '!');
            }
        }

        return back()->with('login_error', 'Email atau password salah.')->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:190', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        session(['user_id' => $user->id, 'user_nama' => $user->nama, 'role' => $user->role]);

        // Sinkronkan ke native PHP session
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            @session_start();
        }
        if (isset($_SESSION)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_nama'] = $user->nama;
            $_SESSION['role'] = $user->role;
        }

        $returnUrl = session()->pull('return_url');
        if ($returnUrl) {
            return redirect($returnUrl)->with('success', 'Pendaftaran akun berhasil! Selamat datang di DewiCiamis.');
        }

        return redirect()->route('home')->with('success', 'Pendaftaran akun berhasil! Selamat datang di DewiCiamis.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            @session_start();
        }
        if (isset($_SESSION)) {
            unset($_SESSION['user_id'], $_SESSION['user_nama'], $_SESSION['role']);
        }

        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'email.exists' => 'Email tidak terdaftar dalam sistem.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
        ]);

        $user = User::where('email', $validated['email'])->first();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui. Silakan login dengan kata sandi baru.');
    }
}
