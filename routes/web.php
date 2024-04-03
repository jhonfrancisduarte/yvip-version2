<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// Route::middleware(['auth'])->group(function () {
//     // Routes that require authentication
     Route::get('/dashboard', function () {return view('livewire.dashboard');})->name('dashboard');
//     // Add other authenticated routes here
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration');
});