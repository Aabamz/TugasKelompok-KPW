<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
<<<<<<< HEAD
    // Halaman "kartu profil" baca-saja milik sendiri
    public function show()
    {
        $user = Auth::user()->load('profile');
        return view('user.profile.show', ['user' => $user, 'isOwner' => true]);
    }

    // Halaman "kartu profil" baca-saja milik user lain
    public function view(User $user)
    {
        $user->load('profile');
        $isOwner = $user->id === Auth::id();

        return view('user.profile.show', compact('user', 'isOwner'));
    }

    // Halaman form edit, khusus milik sendiri
    public function edit()
    {
        $user = Auth::user()->load('profile');
        return view('user.profile.edit', compact('user'));
=======
    public function show()
    {
        $user = Auth::user()->load('profile');
        return view('user.profile.show', compact('user'));
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
    }

    public function update(Request $request)
    {
        $request->validate([
            'umur'   => 'required|numeric|min:1',
            'bio'    => 'required|string',
            'alamat' => 'required|string',
        ]);

        $userId = Auth::id();

        // Update atau buat profile jika belum ada
        Profile::updateOrCreate(
            ['user_id' => $userId],
            [
                'umur'   => $request->umur,
                'bio'    => $request->bio,
                'alamat' => $request->alamat,
            ]
        );

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }
}
