<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kritik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KritikController extends Controller
{
    public function store(Request $request, $filmId)
    {
        // Aturan: Admin tidak boleh memberikan kritik
        if (Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'Administrator tidak diizinkan memberi ulasan.');
        }

        $request->validate([
            'content' => 'required|string',
            'point'   => 'required|integer|min:1|max:5',
        ]);

        Kritik::create([
            'user_id' => Auth::id(),
            'film_id' => $filmId,
            'content' => $request->content,
            'point'   => $request->point,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}