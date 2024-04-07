<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAdmin extends Component
{
    public $first_name = "Francis";
    public $last_name = "Ausa";
    public $middle_name = "Duarte";
    public $email = "jhonfrancisduarte123452gmail.com";
    public $profile_picture = "";
    public $password = "123456@";
    public $user_role = "sa";

    public function mount()
    {
        // Set default profile picture
        $this->profile_picture = 'images/blank_profile_pic.png';
    }

    public function create(){
        $user = User::create([
            'email' => $this->email,
            'password' => $this->password,
            'user_role' => $this->user_role,
        ]);
    
        admin::create([
            'user_id' => $user->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'profile_picture' => $this->profile_picture,
        ]);
    }
    public function render()
    {
        return view('livewire.register-admin');
    }
}
