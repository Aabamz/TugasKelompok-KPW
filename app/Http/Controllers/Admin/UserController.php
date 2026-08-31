<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil daftar user beserta relasi profilnya
        $users = User::with('profile')->where('role', 'user')->get();
        return view('admin.user.index', compact('users'));
    }

    public function destroy(Request $request, User $user)
    {
        // Jaga-jaga: jangan sampai ada yang menghapus akun admin lewat sini
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Akun admin tidak bisa dihapus dari sini.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}