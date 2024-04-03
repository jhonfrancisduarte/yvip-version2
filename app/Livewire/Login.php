<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Login extends Component
{
    #[Rule('required|email')]
    public $email = "";
    
    #[Rule('required|min:8')]
    public $password = "";

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication successful
            return redirect()->intended('/dashboard');
        } else {
            // Authentication failed
            $this->addError('email', 'Invalid credentials.');
        }
    }
}
