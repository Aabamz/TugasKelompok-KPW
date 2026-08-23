<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan halaman pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Memproses pendaftaran akun baru
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        return redirect()->route('profile.index')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }
}