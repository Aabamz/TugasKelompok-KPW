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
<<<<<<< HEAD
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|confirmed',
            'admin_code' => 'nullable|string',
        ]);

        // Role ditentukan dari kode rahasia, bukan pilihan yang ditampilkan ke publik
        $role = 'user';
        if ($request->filled('admin_code') && $request->admin_code === config('app.admin_registration_code')) {
            $role = 'admin';
        }

=======
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
<<<<<<< HEAD
            'role'     => $role,
=======
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }
}