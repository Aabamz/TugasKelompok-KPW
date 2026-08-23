<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route untuk Fitur Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Halaman tes untuk melihat tampilan Sidebar
Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\InvoiceController;

Route::middleware('auth')->group(function () {
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
});
use App\Http\Controllers\CalendarController;

Route::middleware('auth')->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
});
use App\Http\Controllers\PricingController;

Route::middleware('auth')->group(function () {
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');
});