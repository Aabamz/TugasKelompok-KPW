<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\CastController;
use App\Http\Controllers\Admin\PeranController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\KatalogController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\KritikController;
use App\Http\Controllers\User\FollowController;

// 1. Guest Routes (Tanpa Auth)
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// 2. Authenticated Routes (Bisa Diakses Admin & User Biasa)
Route::middleware('auth')->group(function () {
    // Dashboard / Katalog Film
    Route::get('/dashboard', [KatalogController::class, 'index'])->name('dashboard');
    Route::get('/film/{id}', [KatalogController::class, 'show'])->name('film.detail');
    Route::post('/film/{id}/kritik', [KritikController::class, 'store'])->name('kritik.store');

    // Profile User
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [UserProfileController::class, 'view'])->name('profile.view');
    Route::post('/profile/{user}/follow', [FollowController::class, 'toggle'])->name('profile.follow');

    // Menu Opsional
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');
    Route::delete('/settings/account', [SettingsController::class, 'destroyAccount'])->name('settings.destroy-account');
});

// 3. Admin Routes (Khusus Role Admin)
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('genre', GenreController::class)->except('show');
    Route::resource('cast', CastController::class)->except('show');
    Route::resource('peran', PeranController::class)->except('show');
    Route::resource('film', FilmController::class)->except('show');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});