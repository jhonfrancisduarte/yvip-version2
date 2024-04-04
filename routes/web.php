<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth'])->group(function () {
     // Routes that require authentication
     Route::get('/dashboard', function () {return view('livewire.dashboard');})->name('dashboard');
});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration');
});

