<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Fungsi untuk memproses login
    public function login(Request $request)
    {
        // 1. Validasi input agar tidak kosong
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah email dan password cocok dengan database
        if (Auth::attempt($credentials)) {
            // Jika cocok, buat sesi login
            $request->session()->regenerate();

            // Pindahkan ke halaman Dashboard
            return redirect()->intended('dashboard');
        }

        // 3. Jika salah, balikkan ke login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}