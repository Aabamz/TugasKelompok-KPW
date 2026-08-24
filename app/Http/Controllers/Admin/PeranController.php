<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peran;
use App\Models\Film;
use App\Models\Cast;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    public function index()
    {
        $perans = Peran::with(['film', 'cast'])->get();
        return view('admin.peran.index', compact('perans'));
    }

    public function create()
    {
        $films = Film::all();
        $casts = Cast::all();
        return view('admin.peran.create', compact('films', 'casts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:film,id',
            'cast_id' => 'required|exists:cast,id',
            'nama'    => 'required|max:45',
        ]);
        Peran::create($request->all());
        return redirect()->route('peran.index')->with('success', 'Peran berhasil ditambahkan');
    }

    public function edit(Peran $peran)
    {
        $films = Film::all();
        $casts = Cast::all();
        return view('admin.peran.edit', compact('peran', 'films', 'casts'));
    }

    public function update(Request $request, Peran $peran)
    {
        $request->validate([
            'film_id' => 'required|exists:film,id',
            'cast_id' => 'required|exists:cast,id',
            'nama'    => 'required|max:45',
        ]);
        $peran->update($request->all());
        return redirect()->route('peran.index')->with('success', 'Peran berhasil diupdate');
    }

    public function destroy(Peran $peran)
    {
        $peran->delete();
        return redirect()->route('peran.index')->with('success', 'Peran berhasil dihapus');
    }
}