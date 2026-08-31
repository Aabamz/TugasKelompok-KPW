<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // Toggle: kalau belum follow -> follow, kalau sudah follow -> unfollow
    public function toggle(User $user)
    {
        $me = Auth::user();

        if ($me->id === $user->id) {
            return back()->with('error', 'Tidak bisa follow akun sendiri.');
        }

        if ($me->isFollowing($user)) {
            $me->following()->detach($user->id);
            $message = 'Berhenti mengikuti ' . $user->name;
        } else {
            $me->following()->attach($user->id);
            $message = 'Sekarang kamu mengikuti ' . $user->name;
        }

        return back()->with('success', $message);
    }
}
