<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
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
    }

    public function update(Request $request)
    {
        $request->validate([
            'umur'   => 'required|numeric|min:1',
            'bio'    => 'required|string',
            'alamat' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = Auth::user();

        // Proses upload foto profil (jika user memilih file baru)
        if ($request->hasFile('avatar')) {
            // Hapus foto lama supaya tidak menumpuk file di storage
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath   = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }

        // Update atau buat profile jika belum ada
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'umur'   => $request->umur,
                'bio'    => $request->bio,
                'alamat' => $request->alamat,
            ]
        );

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }
}
