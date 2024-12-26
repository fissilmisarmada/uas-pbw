<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home'); // Mengarahkan ke file resources/views/home.blade.php
})->name('home');

// Rute untuk halaman Tentang Kami
Route::get('/about', function () {
    return view('about'); // Mengarahkan ke file resources/views/about.blade.php
})->name('about');

// Rute untuk halaman Pengajuan Rental
Route::get('/rental-request', [RentalController::class, 'showRequestForm'])->name('rental.request');
Route::post('/rental-submit', [RentalController::class, 'submit'])->name('rental.submit'); // Pengajuan rental

// Rute untuk logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('fissilmi/login');
})->name('logout');
