<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Toggle: kalau belum ada di wishlist -> tambah, kalau sudah -> hapus
    public function toggle(Film $film)
    {
        $user = Auth::user();

        if ($user->hasWishlisted($film)) {
            $user->wishlists()->detach($film->id);
            $message = 'Dihapus dari wishlist';
        } else {
            $user->wishlists()->attach($film->id);
            $message = 'Ditambahkan ke wishlist';
        }

        if (request()->wantsJson()) {
            return response()->json([
                'wishlisted'      => $user->hasWishlisted($film),
                'wishlist_count'  => $film->wishlistedBy()->count(),
                'message'         => $message,
            ]);
        }

        return back()->with('success', $message);
    }

    // Halaman daftar wishlist milik user yang login
    public function index()
    {
        $films = Auth::user()->wishlists()->with('genre')->withAvg('ulasanUtama', 'point')->withCount('ulasanUtama')->withCount('wishlistedBy')->latest('wishlists.created_at')->get();

        return view('user.wishlist.index', ['films' => $films, 'profileUser' => Auth::user(), 'isOwner' => true]);
    }

    // Halaman daftar wishlist milik user manapun (bisa dilihat orang lain)
    public function show(\App\Models\User $user)
    {
        $films = $user->wishlists()->with('genre')->withAvg('ulasanUtama', 'point')->withCount('ulasanUtama')->withCount('wishlistedBy')->latest('wishlists.created_at')->get();
        $isOwner = $user->id === Auth::id();

        return view('user.wishlist.index', ['films' => $films, 'profileUser' => $user, 'isOwner' => $isOwner]);
    }
}
