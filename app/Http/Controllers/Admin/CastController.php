<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::all();
        return view('admin.cast.index', compact('casts'));
    }

    public function create()
    {
        return view('admin.cast.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:45',
            'umur' => 'required|numeric',
            'bio'  => 'required',
        ]);
        Cast::create($request->all());
        return redirect()->route('admin.cast.index')->with('success', 'Cast berhasil ditambahkan');
    }

    public function edit(Cast $cast)
    {
        return view('admin.cast.edit', compact('cast'));
    }

    public function update(Request $request, Cast $cast)
    {
        $request->validate([
            'nama' => 'required|max:45',
            'umur' => 'required|numeric',
            'bio'  => 'required',
        ]);
        $cast->update($request->all());
        return redirect()->route('admin.cast.index')->with('success', 'Cast berhasil diupdate');
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();
        return redirect()->route('admin.cast.index')->with('success', 'Cast berhasil dihapus');
    }
}