<?php

namespace App\Livewire;

use App\Models\RewardClaim;
use App\Models\User;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SideNav extends Component
{
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function render(){
        $user = Auth::user();
        $volunteerHours = RewardClaim::where('user_id', $user->id)->first();
        $volunteerHours = $volunteerHours->total_hours;
        return view('livewire.side-nav',[
            'volunteerHours' => $volunteerHours,
        ]);
    }

}
