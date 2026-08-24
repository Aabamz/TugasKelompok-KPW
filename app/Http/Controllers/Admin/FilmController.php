<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('genre')->get();
        return view('admin.film.index', compact('films'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.film.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|max:45',
            'ringkasan' => 'required',
            'tahun'     => 'required|numeric',
            'poster'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre_id'  => 'required|exists:genre,id',
        ]);

        // Upload Gambar Poster
        $posterPath = $request->file('poster')->store('posters', 'public');

        Film::create([
            'judul'     => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun'     => $request->tahun,
            'poster'    => $posterPath,
            'genre_id'  => $request->genre_id,
        ]);

        return redirect()->route('film.index')->with('success', 'Film berhasil ditambahkan');
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('admin.film.edit', compact('film', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul'     => 'required|max:45',
            'ringkasan' => 'required',
            'tahun'     => 'required|numeric',
            'poster'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre_id'  => 'required|exists:genre,id',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'tahun', 'genre_id']);

        if ($request->hasFile('poster')) {
            // Hapus poster lama
            if ($film->poster && Storage::disk('public')->exists($film->poster)) {
                Storage::disk('public')->delete($film->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $film->update($data);

        return redirect()->route('film.index')->with('success', 'Film berhasil diupdate');
    }

    public function destroy(Film $film)
    {
        if ($film->poster && Storage::disk('public')->exists($film->poster)) {
            Storage::disk('public')->delete($film->poster);
        }
        $film->delete();

        return redirect()->route('film.index')->with('success', 'Film berhasil dihapus');
    }
}