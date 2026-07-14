<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     * Jika sudah login, redirect ke dashboard sesuai guard.
     */
    public function showLoginForm()
    {
        if (Auth::guard('guru')->check()) {
            return redirect()->route('guru.dashboard');
        }

        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login berdasarkan tipe (guru/siswa).
     */
    public function login(Request $request)
    {
        $request->validate([
            'type' => 'required|in:guru,siswa',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $type = $request->input('type');
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::guard($type)->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route($type . '.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput($request->only('username', 'type'));
    }

    /**
     * Logout dari guard aktif.
     */
    public function logout(Request $request)
    {
        if (Auth::guard('guru')->check()) {
            Auth::guard('guru')->logout();
        }

        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
