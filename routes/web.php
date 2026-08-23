<?php
  
use Illuminate\Support\Facades\Route;

// Halaman tes untuk melihat tampilan Sidebar
Route::get('/', function () {
    return view('welcome');
<<<<<<< HEAD
});
=======
});
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
>>>>>>> 65428b412ef6e858be37c0bdf0882ba3899d2c01
