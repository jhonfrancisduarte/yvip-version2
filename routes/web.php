<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth'])->group(function () {
     // Routes that require authentication
     Route::get('/dashboard', function () {return view('livewire.dashboard');})->name('dashboard');
     Route::get('/my-category', function () {return view('livewire.my-category');})->name('my-category');
     Route::get('/events-and-trainings', function () {return view('livewire.events-and-trainings');})->name('events-and-trainings');
     Route::get('/my-participations', function () {return view('livewire.my-participations');})->name('my-participations');
});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration');
});

