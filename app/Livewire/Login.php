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
    public $showPassword = false;
    public $remember = false;

    public function login(){
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $user = Auth::user();
            if($user->active_status === 1 || $user->active_status === 3){
                if (($user->user_role === 'yv' || $user->user_role === 'yip')) {
                    session(['user_role' => $user->user_role]);
                    return redirect()->intended('/dashboard');
                }
                elseif (($user->user_role === 'sa')) {
                    session(['user_role' => $user->user_role]);
                    return redirect()->intended('/admin-dashboard');
                }
                elseif (($user->user_role === 'ips')) {
                    session(['user_role' => $user->user_role]);
                    return redirect()->intended('/ip-announcements');
                }
                elseif (in_array($user->user_role, ['vs', 'vsa'])) {
                    session(['user_role' => $user->user_role]);
                    return redirect()->intended('/volunteer-announcements');
                }
            }elseif($user->active_status === 0){
                $this->addError('status', 'Your account has not been approved yet!');
            }else{
                $this->addError('login', 'Invalid credentials.');
            }
        }else{
            $this->addError('login', 'Invalid credentials.');
        }
    }

    public function render(){
        return view('livewire.login');
    }

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }
}
