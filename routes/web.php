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

Route::middleware(['auth', 'user_role:sa,vs,vsa,ips'])->group(function (){
     //Private pages accessible to all relevant admin roles
     Route::get('/admin-dashboard', function () {
         return view('livewire.admin-dashboard');
     })->name('admin-dashboard');
 });

 Route::middleware(['auth', 'user_role:sa,vs,vsa'])->group(function () {
     // Private pages accessible only to admin users (super admin, volunteer secretariat and assistant)
     Route::get('/volunteer-dashboard', function () { return view('livewire.volunteer-dashboard'); })->name('volunteer-dashboard');
     Route::get('/volunteer-registration', function () { return view('livewire.volunteer-registration'); })->name('volunteer-registration');
     Route::get('/volunteers', function () { return view('livewire.volunteers'); })->name('volunteers');
     Route::get('/volunteer-hours', function () { return view('livewire.volunteer-hours'); })->name('volunteer-hours');
     Route::get('/volunteer-rewards', function () { return view('livewire.volunteer-rewards'); })->name('volunteer-rewards');
     Route::get('/volunteer-events-and-trainings', function () { return view('livewire.volunteer-events-and-trainings'); })->name('volunteer-events-and-trainings');
     Route::post('/volunteer-events-and-trainings', function () {
         // Handle POST request for volunteer events and trainings here
         return redirect()->back()->with('success', 'Event or training added successfully!');
     });
     Route::get('/volunteer-category', function () { return view('livewire.volunteer-category'); })->name('volunteer-category');
     Route::get('/volunteer-messages', function () { return view('livewire.volunteer-messages'); })->name('volunteer-messages');
});


Route::middleware(['auth', 'user_role:sa,ips'])->group(function (){
     // Private pages accessible only to admin users (super admin, ip secretariat)
     Route::get('/ip-dashboard', function () {return view('livewire.ip-dashboard');})->name('ip-dashboard');
     Route::get('/ip-registration', function () {return view('livewire.ip-registration');})->name('ip-registration');
     Route::get('/ip-beneficiaries', function () {return view('livewire.ip-beneficiaries');})->name('ip-beneficiaries');
     Route::get('/ip-validation', function () {return view('livewire.ip-validation');})->name('ip-validation');
     Route::get('/ip-events', function () {return view('livewire.ip-events');})->name('ip-events');
     Route::get('/ip-messages', function () {return view('livewire.ip-messages');})->name('ip-messages');
});

 



