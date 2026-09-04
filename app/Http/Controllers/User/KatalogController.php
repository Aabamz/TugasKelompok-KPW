<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Menampilkan seluruh katalog film di Dashboard
    public function index(Request $request)
    {
        $query = Film::with('genre')->withAvg('ulasanUtama', 'point')->withCount('ulasanUtama')->withCount('wishlistedBy');

        // Fitur Pencarian Film
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $films = $query->latest()->get();

        // Tandai film mana yang sudah di-wishlist user yang login
        $wishlistedIds = $request->user()->wishlists()->pluck('film.id')->toArray();

        return view('dashboard', compact('films', 'wishlistedIds'));
    }

    // Menampilkan Detail Film
    public function show($id)
    {
        $film = Film::with([
            'genre',
            'peran.cast',
            'kritik' => fn ($q) => $q->whereNull('parent_id')->with(['user', 'replies']),
        ])->withCount('wishlistedBy')->findOrFail($id);
        $isWishlisted = auth()->user()->hasWishlisted($film);

        return view('user.katalog.show', compact('film', 'isWishlisted'));
    }
}