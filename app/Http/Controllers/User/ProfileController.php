<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('profile');
        return view('user.profile.show', compact('user'));
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
         // Update atau buat profile jika belum ada
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
