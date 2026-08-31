<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9

class UserController extends Controller
{
    public function index()
    {
        // Mengambil daftar user beserta relasi profilnya
        $users = User::with('profile')->where('role', 'user')->get();
        return view('admin.user.index', compact('users'));
    }
<<<<<<< HEAD

    public function destroy(Request $request, User $user)
    {
        // Jaga-jaga: jangan sampai ada yang menghapus akun admin lewat sini
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Akun admin tidak bisa dihapus dari sini.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
=======
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
}