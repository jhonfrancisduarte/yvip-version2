<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Login extends Component
{
    #[Rule('required|email')]
    public $email;
    #[Rule('required')]
    public $password;

    
    public function login(){
        // dd($this->all());

        $this->validate();
        
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            if ($user->user_role === 'yv' || $user->user_role === 'yip') {
                session(['user_role' => $user->user_role]); 
                return redirect()->intended('/dashboard');
            }
            elseif (in_array($user->user_role, ['sa', 'vs', 'vsa', 'ips'])) {
                session(['user_role' => $user->user_role]); 
                return redirect()->intended('/admin');
            }
        }

        $this->addError('email', 'Invalid credentials.');  
    }
    
    public function render(){
        return view('livewire.login');
    }
}
