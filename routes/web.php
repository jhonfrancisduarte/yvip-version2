<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Routes that require authentication
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    // Add other authenticated routes here
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration');
});

// Route::get('/dashboard', function () {
//     return view('userdashboard');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
