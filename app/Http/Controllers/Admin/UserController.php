<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil daftar user beserta relasi profilnya
        $users = User::with('profile')->where('role', 'user')->get();
        return view('admin.user.index', compact('users'));
    }
}