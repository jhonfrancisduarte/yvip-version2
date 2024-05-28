<?php

namespace App\Livewire\Tables;
use App\Models\User;
use Livewire\Component;
use App\Mail\UserApprovalNotification;
use App\Mail\UserDisapprovalNotification;
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
    public $redflagRegistrantId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $popup_message;
    public $approving;
    public $advocacyPlans = [];
    public $otherDocs = [];

    public function render(){
        $volunteersYip = User::where('user_role', 'yip')
            ->join('user_data', 'users.id', '=', 'user_data.user_id')
            ->select('users.email', 'users.active_status', 'user_data.*')
            ->where('users.active_status', 0);

        $volunteersYv = User::where('user_role', 'yv')
            ->join('user_data', 'users.id', '=', 'user_data.user_id')
            ->select('users.email', 'users.active_status', 'user_data.*')
            ->where('users.active_status', 1)
            ->where('users.ip_reg', 1);

        $volunteers = $volunteersYip->union($volunteersYv)
            ->search(trim($this->search))
            ->paginate(10);

   

        return view('livewire.tables.ip-registration-table',[
            'volunteers' => $volunteers, 
        ]);
    }

    public function showUserData($userId){
        $selectedUserDetails = User::where('users.id', $userId)
                                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                                ->select('users.*', 'user_data.*')
                                ->first();
        $this->advocacyPlans = explode(', ', $selectedUserDetails->advocacy_plans);
        $this->otherDocs = explode(', ', $selectedUserDetails->other_document);
        $this->selectedUserDetails = $selectedUserDetails->getAttributes();
    }

    public function approveUser($userId){
        try{
            $admin = Auth::user()->email;
            $registrant = User::where('id', $userId)->first();
            if ($registrant){
                if($registrant->user_role === 'yv'){
                    $registrant->update([
                        'user_role' => 'yip',
                    ]);
                }else{
                    $registrant->update([
                        'active_status' => 1,
                    ]);
                }
              
                $mailed = Mail::to($registrant->email)->send(new UserApprovalNotification($registrant->name, $admin));
                if($mailed){
                    $this->popup_message = null;
                    $this->popup_message = 'Registrant approved successfully.';
                    $this->selectedUserDetails = null;
                }else{
                    $this->popup_message = null;
                    $this->popup_message = 'Failed to send approve mail.';
                    $this->selectedUserDetails = null;
                }
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
        $this->redflagRegistrantId = null;
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
            $admin = Auth::user()->email;
            $user = User::where('id', $userId)->first();
            if ($user){
                $mailed = Mail::to($user->email)->send(new UserDisapprovalNotification($user->name, $admin));
                if($mailed){
                    $user->userData()->delete();
                    $user->delete();
                    $this->deleteMessage = 'Registrant disapproved successfully.';
                    $this->disableButton = "Yes";
                }else{
                    $this->deleteMessage = 'Registrant disapproved unsuccessful.';
                    $this->disableButton = "Yes";
                }
            }else{
                $this->deleteMessage = 'Registrant disapproved unsuccessful.';
                $this->disableButton = "Yes";
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function redflagDialog($userId){
        $this->redflagRegistrantId = $userId;
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function redflagRegistrant($userId){
        try{ 
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->update([
                    'active_status' => 3,
                ]);
                $this->deleteMessage = 'Registrant red flagged successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Registrant red flagged unsuccessful.';
                $this->disableButton = "Yes";
            }
        }catch(Exception $e){
            throw $e;
        }
    }
}
