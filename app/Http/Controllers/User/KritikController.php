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
    }

    public function destroy(Kritik $kritik)
    {
        $user = Auth::user();

        // Hanya pemilik komentar atau admin yang boleh menghapus
        if ($kritik->user_id !== $user->id && !$user->isAdmin()) {
            abort(403, 'Kamu tidak diizinkan menghapus komentar ini.');
        }

        $kritik->delete(); // Balasan di bawahnya ikut terhapus otomatis (cascade)

        return redirect()->back()->with('success', $kritik->parent_id ? 'Balasan dihapus.' : 'Ulasan dihapus.');
    }
}