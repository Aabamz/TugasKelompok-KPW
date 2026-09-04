<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
<<<<<<< HEAD
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Halaman cari & browse user lain
    public function search(Request $request)
    {
        $keyword = $request->query('q');

        $users = User::where('id', '!=', Auth::id())
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('user.profile.search', compact('users', 'keyword'));
    }

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

    // Daftar orang yang mengikuti $user
    public function followers(User $user)
    {
        $people = $user->followers()->paginate(12);
        return view('user.profile.follow-list', [
            'user'  => $user,
            'people' => $people,
            'title' => 'Followers ' . $user->name,
        ]);
    }

    // Daftar orang yang diikuti $user
    public function followingList(User $user)
    {
        $people = $user->following()->paginate(12);
        return view('user.profile.follow-list', [
            'user'  => $user,
            'people' => $people,
            'title' => $user->name . ' Following',
        ]);
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('profile');
        return view('user.profile.show', compact('user'));
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }

    public function update(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'umur'         => 'required|numeric|min:1',
            'bio'          => 'required|string',
            'alamat'       => 'required|string',
            'avatar'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'social_links'   => 'nullable|array|max:4',
            'social_links.*' => 'nullable|url|max:255',
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

        // Buang input link kosong sebelum disimpan
        $socialLinks = array_values(array_filter($request->input('social_links', []), fn ($url) => !empty($url)));

        // Update atau buat profile jika belum ada
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'umur'         => $request->umur,
                'bio'          => $request->bio,
                'alamat'       => $request->alamat,
                'social_links' => $socialLinks,
=======
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
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
            ]
        );

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }
}
