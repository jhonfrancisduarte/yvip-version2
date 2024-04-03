<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        return view('livewire.dashboard');
    }
}
