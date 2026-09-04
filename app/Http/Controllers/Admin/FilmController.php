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
        $films = Film::with('genre')->withAvg('kritik', 'point')->withCount('kritik')->get();
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
            'video'     => 'nullable|file|mimes:mp4,mov,avi,webm|max:51200',
            'genre_id'  => 'required|exists:genre,id',
        ]);

        // Upload Gambar Poster
        $posterPath = $request->file('poster')->store('posters', 'public');

        // Upload Video (opsional)
        $videoPath = $request->hasFile('video')
            ? $request->file('video')->store('videos', 'public')
            : null;

        Film::create([
            'judul'     => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun'     => $request->tahun,
            'poster'    => $posterPath,
            'video'     => $videoPath,
            'genre_id'  => $request->genre_id,
        ]);

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil ditambahkan');
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
            'video'     => 'nullable|file|mimes:mp4,mov,avi,webm|max:51200',
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

        if ($request->hasFile('video')) {
            // Hapus video lama
            if ($film->video && Storage::disk('public')->exists($film->video)) {
                Storage::disk('public')->delete($film->video);
            }
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        $film->update($data);

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil diupdate');
    }

    public function destroy(Film $film)
    {
        if ($film->poster && Storage::disk('public')->exists($film->poster)) {
            Storage::disk('public')->delete($film->poster);
        }
        if ($film->video && Storage::disk('public')->exists($film->video)) {
            Storage::disk('public')->delete($film->video);
        }
        $film->delete();

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil dihapus');
    }
}