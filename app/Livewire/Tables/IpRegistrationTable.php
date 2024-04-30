<?php

namespace App\Livewire\Tables;
use App\Models\User;
use Livewire\Component;
use App\Mail\UserApprovalNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IpRegistrationTable extends Component
{
    public $selectedUserDetails;
    public $search;
    public $age_range;
    public $status;
    public $deleteRegistrantId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $popup_message;

    public function render(){
        $volunteers = User::where('user_role', 'yip')
            ->join('user_data', 'users.id', '=', 'user_data.user_id')
            ->select('users.email', 'users.active_status', 'user_data.*')
            ->search(trim($this->search))
            ->where('users.active_status', 0)
            ->paginate(10);

        return view('livewire.tables.ip-registration-table',[
            'volunteers' => $volunteers, 
        ]);
    }

    public function showUserData($userId){
        $this->selectedUserDetails = User::where('users.id', $userId)
                                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                                ->select('users.*', 'user_data.*')
                                ->first();
        $this->selectedUserDetails = $this->selectedUserDetails->getAttributes();
    }

    public function approveUser($userId){
        try{
            $admin = Auth::user()->email;
            $registrant = User::where('id', $userId)->first();
            if ($registrant){
                $registrant->update([
                    'active_status' => 1,
                ]);
                $this->popup_message = null;
                $this->popup_message = 'Registrant approved successfully.';
                Mail::to($registrant->email)->send(new UserApprovalNotification($registrant->name, $admin));
                $this->selectedUserDetails = null;
            }else{
                $this->popup_message = null;
                $this->popup_message = 'Registrant approved unsuccessfully.';
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function hideUserData(){
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function deleteDialog($userId){
        $this->deleteRegistrantId = $userId;
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteRegistrantId = null;
        $this->disableButton = "No";
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function deleteRegistrant($userId){
        try{
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->userData()->delete();
                $user->delete();
                $this->deleteMessage = 'Registrant disapproved successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Registrant disapproved unsuccessfully.';
                $this->disableButton = "Yes";
            }
            $this->deleteRegistrantId = null;
        }catch(Exception $e){
            throw $e;
        }
    }
}
