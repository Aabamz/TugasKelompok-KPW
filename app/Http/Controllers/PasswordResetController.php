<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    // Tampilkan form "Masukkan email kamu"
    public function showEmailForm()
    {
        return view('adminlte::auth.passwords.email');
    }

    // Proses kirim email berisi link reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Link reset password sudah dikirim ke email kamu. Cek inbox (atau folder spam) ya!')
            : back()->withErrors(['email' => __($status)]);
    }

    // Tampilkan form "Masukkan password baru", diakses lewat link di email
    public function showResetForm(Request $request, string $token)
    {
        return view('adminlte::auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // Proses simpan password baru
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil diganti! Silakan login pakai password baru kamu.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
