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
<<<<<<< HEAD
        $query = Film::with('genre')->withAvg('ulasanUtama', 'point')->withCount('ulasanUtama')->withCount('wishlistedBy');
=======
        $query = Film::with('genre');
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021

        // Fitur Pencarian Film
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $films = $query->latest()->get();

<<<<<<< HEAD
        // Tandai film mana yang sudah di-wishlist user yang login
        $wishlistedIds = $request->user()->wishlists()->pluck('film.id')->toArray();

        return view('dashboard', compact('films', 'wishlistedIds'));
=======
        return view('dashboard', compact('films'));
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }

    // Menampilkan Detail Film
    public function show($id)
    {
<<<<<<< HEAD
        $film = Film::with([
            'genre',
            'peran.cast',
            'kritik' => fn ($q) => $q->whereNull('parent_id')->with(['user', 'replies']),
        ])->withCount('wishlistedBy')->findOrFail($id);
        $isWishlisted = auth()->user()->hasWishlisted($film);

        return view('user.katalog.show', compact('film', 'isWishlisted'));
=======
        $film = Film::with(['genre', 'peran.cast', 'kritik.user'])->findOrFail($id);

        return view('user.katalog.show', compact('film'));
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}