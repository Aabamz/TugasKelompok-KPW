<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Dipanggil AJAX oleh navbar buat update lonceng notifikasi
    public function data()
    {
        $user = Auth::user();
        $unread = $user->unreadNotifications;

        $dropdown = view('user.notification.dropdown', [
            'notifications' => $unread->take(5),
        ])->render();

        return response()->json([
            'label'       => $unread->count(),
            'label_color' => 'danger',
            'dropdown'    => $dropdown,
        ]);
    }

    // Halaman daftar semua notifikasi
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(15);

        // Tandai semua sudah dibaca begitu halaman ini dibuka
        $user->unreadNotifications->markAsRead();

        return view('user.notification.index', compact('notifications'));
    }
}
