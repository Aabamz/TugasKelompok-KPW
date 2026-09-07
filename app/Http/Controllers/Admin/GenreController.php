<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $query = Genre::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $genres = $query->orderBy('nama')->get();
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:45',
        ], [
            'nama.required' => 'Nama genre wajib diisi.',
            'nama.min' => 'Nama genre minimal 3 huruf.',
            'nama.max' => 'Nama genre maksimal 45 huruf.',
        ]);
        Genre::create($request->all());
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil ditambahkan');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'nama' => 'required|min:3|max:45',
        ], [
            'nama.required' => 'Nama genre wajib diisi.',
            'nama.min' => 'Nama genre minimal 3 huruf.',
            'nama.max' => 'Nama genre maksimal 45 huruf.',
        ]);
        $genre->update($request->all());
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil diupdate');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil dihapus');
    }
}