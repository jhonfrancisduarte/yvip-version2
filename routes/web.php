<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth'])->group(function () {
     // Private pages
     Route::get('/dashboard', function () {return view('livewire.dashboard');})->name('dashboard');
     Route::get('/my-category', function () {return view('livewire.my-category');})->name('my-category');
     Route::get('/events-and-trainings', function () {return view('livewire.events-and-trainings');})->name('events-and-trainings');
     Route::get('/my-participations', function () {return view('livewire.my-participations');})->name('my-participations');
     Route::get('/volunteering-hours', function () {return view('livewire.volunteering-hours');})->name('volunteering-hours');
     Route::get('/rewards', function () {return view('livewire.rewards');})->name('rewards');
     Route::get('/virtual-passport', function () {return view('livewire.virtual-passport');})->name('virtual-passport');
     Route::get('/volunteer-manual', function () {return view('livewire.volunteer-manual');})->name('volunteer-manual');
     Route::get('/leaderboard', function () {return view('livewire.leaderboard');})->name('leaderboard');
     Route::get('/messages', function () {return view('livewire.messages');})->name('messages');
});


// Public pages
Route::get('/', function () {return view('welcome');});
Route::get('/registration', function () {return view('registration');});

