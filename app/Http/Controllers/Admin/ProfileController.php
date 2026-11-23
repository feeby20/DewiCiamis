<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:admins,email,' . $admin->id],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:6'],
        ]);

        $admin->email = $validated['email'];

        if (!empty($validated['new_password'])) {
            if (empty($validated['current_password'])) {
                return back()->withErrors(['current_password' => 'Masukkan kata sandi lama terlebih dahulu.']);
            }

            if (!Hash::check($validated['current_password'], $admin->password_hash) && !password_verify($validated['current_password'], $admin->password_hash)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
            }

            $admin->password_hash = Hash::make($validated['new_password']);
        }

        $admin->save();

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }
}
