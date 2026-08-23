<?php

use Illuminate\Support\Facades\Route;

// Halaman tes untuk melihat tampilan Sidebar
Route::get('/', function () {
    return view('welcome');
});