<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class IpApplicationTable extends Component
{
    
    public $popup_message;
    public function render()
    {
        $user = Auth::user();
        $users = User::where('id', $user->id)->first();
        $ipRegRequested = $users->ip_reg;
        return view('livewire.tables.ip-application-table', [
            'ipRegRequested' => $ipRegRequested,
        ]);
    }

    public function registerForIp(){
        try{
            $user = Auth::user();
            if($user){
                $users = User::where('id', $user->id)->first();
                $users->update([
                    'ip_reg' => 1,
                ]);
                $this->popup_message = 'IP Application Sent';
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

}
