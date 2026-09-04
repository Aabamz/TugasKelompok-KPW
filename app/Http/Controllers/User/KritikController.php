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

<<<<<<< HEAD
        $isReply = $request->filled('parent_id');

        $request->validate([
            'content'   => 'required|string',
            'point'     => $isReply ? 'nullable' : 'required|integer|min:1|max:5',
            'parent_id' => 'nullable|exists:kritik,id',
        ]);

        Kritik::create([
            'user_id'   => Auth::id(),
            'film_id'   => $filmId,
            'parent_id' => $request->parent_id,
            'content'   => $request->content,
            'point'     => $isReply ? 0 : $request->point,
        ]);

        return redirect()->back()->with('success', $isReply ? 'Balasan berhasil dikirim!' : 'Ulasan berhasil ditambahkan!');
=======
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
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}