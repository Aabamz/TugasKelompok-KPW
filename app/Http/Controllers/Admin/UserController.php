<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021

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
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
}