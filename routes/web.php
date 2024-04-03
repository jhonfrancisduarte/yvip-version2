<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration');
});

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
