<?php

namespace App\Livewire\Tables;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MyProfile extends Component
{
    public $popup_message;
    public function render(){
        $userId = Auth::user()->id;
        $user = User::where('users.id', $userId)
                    ->join('user_data', 'users.id', '=', 'user_data.user_id')
                    ->select('users.email', 'user_data.*')
                    ->first();

        return view('livewire.tables.my-profile', compact('user'));
    }
}
