<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
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

        // Filter Genre
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Urutan tampilan
        switch ($request->input('sort', 'terbaru')) {
            case 'populer':
                $query->orderByDesc('ulasan_utama_avg_point');
                break;
            case 'terlama':
                $query->oldest();
                break;
            default: // terbaru
                $query->latest();
                break;
        }

        $films = $query->get();

        // Data buat dropdown filter
        $genres = Genre::orderBy('nama')->get();
        $tahunList = Film::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');

        // Tandai film mana yang sudah di-wishlist user yang login
        $wishlistedIds = $request->user()->wishlists()->pluck('film.id')->toArray();

        return view('dashboard', compact('films', 'wishlistedIds', 'genres', 'tahunList'));
    }

    // Menampilkan Detail Film
    public function show(Request $request, $id)
    {
        $sortUlasan = $request->input('sort_ulasan', 'terbaru');

        $film = Film::with([
            'genre',
            'peran.cast',
            'kritik' => fn ($q) => $q->whereNull('parent_id')->with(['user', 'replies']),
        ])->withCount('wishlistedBy')->findOrFail($id);
        $isWishlisted = auth()->user()->hasWishlisted($film);

        return view('user.katalog.show', compact('film', 'isWishlisted', 'sortUlasan'));
    }

    // Dipanggil AJAX (polling) untuk refresh daftar ulasan tanpa reload halaman
    public function comments(Request $request, $id)
    {
        $sortUlasan = $request->input('sort_ulasan', 'terbaru');

        $film = Film::with([
            'kritik' => fn ($q) => $q->whereNull('parent_id')->with(['user', 'replies']),
        ])->findOrFail($id);

        return view('user.katalog.partials.comments', compact('film', 'sortUlasan'));
    }
}