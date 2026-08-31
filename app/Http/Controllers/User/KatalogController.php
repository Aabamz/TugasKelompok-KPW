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
        $query = Film::with('genre')->withAvg('kritik', 'point')->withCount('kritik');

        // Fitur Pencarian Film
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $films = $query->latest()->get();

        return view('dashboard', compact('films'));
    }

    // Menampilkan Detail Film
    public function show($id)
    {
        $film = Film::with(['genre', 'peran.cast', 'kritik.user'])->findOrFail($id);

        return view('user.katalog.show', compact('film'));
    }
}