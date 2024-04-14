<?php

use App\Livewire\VolunteersTable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

// Public pages
Route::get('/', function () {return view('welcome');});
Route::get('/registration', function () {return view('registration');});

// Unauthorized redirect page
Route::view('/unauthorized', 'unauthorized')->name('unauthorized');

Route::middleware(['auth', 'user_role:yv,yip'])->group(function (){
     // Private pages accessible to all relevant user roles
     Route::get('/dashboard', function () {
         return view('livewire.dashboard');
     })->name('dashboard');
     Route::get('/profile', function () {
         return view('livewire.profile');
     })->name('profile');
 });

Route::middleware(['auth', 'user_role:yv'])->group(function () {
     // Private pages accessible only to users (youth volunteer)
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

Route::middleware(['auth', 'user_role:yip'])->group(function () {
     // Private pages accessible only to users (ip beneficiaries)
     Route::get('/ip-events', function () {return view('livewire.ip-events');})->name('ip-events');
     Route::get('/past-ip-participated-events', function () {return view('livewire.past-ip-participated-events');})->name('past-ip-participated-events');
     Route::get('/ip-participated-events', function () {return view('livewire.ip-participated-events');})->name('ip-participated-events');
     Route::get('/ip-passport', function () {return view('livewire.ip-passport');})->name('ip-passport');
     Route::get('/post-program-obligation', function () {return view('livewire.post-program-obligation');})->name('post-program-obligation');
});