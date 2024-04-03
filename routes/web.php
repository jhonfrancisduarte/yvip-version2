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

<<<<<<< HEAD
Route::get('/dashboard', function () {
    return view('userdashboard');
});

Route::get('/my-category', function () {
    return view('userdashboard');
});

Route::get('/events-and-trainings', function () {
    return view('userdashboard');
});

Route::get('/my-participations', function () {
    return view('userdashboard');
});

Route::get('/my-volunteering-hours', function () {
    return view('userdashboard');
});

Route::get('/my-rewards', function () {
    return view('userdashboard');
});

Route::get('/my-virtual-passport', function () {
    return view('userdashboard');
});

Route::get('/volunteer-manual', function () {
    return view('userdashboard');
});

Route::get('/leaderboard', function () {
    return view('userdashboard');
});

Route::get('/my-messages', function () {
    return view('userdashboard');
});

Route::get('/logout', function () {
    return view('userdashboard');
});
=======
>>>>>>> origin/master
