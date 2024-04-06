<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SideNav extends Component
{
    public $selectedNavItem = 'announcements';

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function render(){
        return view('livewire.side-nav');
    }
}
