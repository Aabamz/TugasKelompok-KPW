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
<<<<<<< HEAD
        return redirect()->route('admin.cast.index')->with('success', 'Cast berhasil ditambahkan');
=======
        return redirect()->route('cast.index')->with('success', 'Cast berhasil ditambahkan');
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
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
<<<<<<< HEAD
        return redirect()->route('admin.cast.index')->with('success', 'Cast berhasil diupdate');
=======
        return redirect()->route('cast.index')->with('success', 'Cast berhasil diupdate');
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();
<<<<<<< HEAD
        return redirect()->route('admin.cast.index')->with('success', 'Cast berhasil dihapus');
=======
        return redirect()->route('cast.index')->with('success', 'Cast berhasil dihapus');
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}