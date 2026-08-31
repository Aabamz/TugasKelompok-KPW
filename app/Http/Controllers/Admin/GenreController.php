<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|max:45']);
        Genre::create($request->all());
<<<<<<< HEAD
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil ditambahkan');
=======
        return redirect()->route('genre.index')->with('success', 'Genre berhasil ditambahkan');
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate(['nama' => 'required|max:45']);
        $genre->update($request->all());
<<<<<<< HEAD
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil diupdate');
=======
        return redirect()->route('genre.index')->with('success', 'Genre berhasil diupdate');
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
<<<<<<< HEAD
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil dihapus');
=======
        return redirect()->route('genre.index')->with('success', 'Genre berhasil dihapus');
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
    }
}