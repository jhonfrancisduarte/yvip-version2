<?php

namespace App\Livewire\Tables;
use App\Models\User;
use App\Models\UserData;
use Livewire\Component;
use App\Mail\UserApprovalNotification;
use App\Mail\UserDisapprovalNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class VolunteerRegistrationTable extends Component
{
    use WithPagination;
    public $selectedUserDetails;
    public $search;
    public $age_range;
    public $status;
    public $deleteRegistrantId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $popup_message;
    public $approving;
    public $advocacyPlans = [];
    public $otherDocs = [];
    public $expandedRows = [];

    public function render(){
        $volunteers = User::where('user_role', 'yv')
                        ->join('user_data', 'users.id', '=', 'user_data.user_id')
                        ->select('users.email', 'users.active_status', 'user_data.*')
                        ->search(trim($this->search))
                        ->where('users.active_status', 0)
                        ->paginate(5);

        return view('livewire.tables.volunteer-registration-table',[
            'volunteers' => $volunteers, 
        ]);
    }

    public function toggleRow($volunteerId){
        if (in_array($volunteerId, $this->expandedRows)) {
            $this->expandedRows = [];
        } else {
            $this->expandedRows = [$volunteerId];
        }

        $this->showUserData($volunteerId);
    }

    public function showUserData($userId){
        $selectedUserDetails = UserData::where('user_data.id', $userId)
                                        ->join('users', 'users.id', '=', 'user_data.user_id')
                                        ->select('users.user_role', 'users.email', 'user_data.*')
                                        ->first();
        $this->advocacyPlans = explode(', ', $selectedUserDetails->advocacy_plans);
        $this->otherDocs = explode(', ', $selectedUserDetails->other_document);
        $this->selectedUserDetails = $selectedUserDetails->getAttributes();
    }

    public function approveUser($userId){
        try{
            $this->approving = true;
            $admin = Auth::user()->email;
            $registrant = User::where('id', $userId)->first();
            if ($registrant){
                $registrant->update([
                    'active_status' => 1,
                ]);
                $mailed = Mail::to($registrant->email)->send(new UserApprovalNotification($registrant->name, $admin));
                if($mailed){
                    $this->approving = null;
                    $this->popup_message = null;
                    $this->popup_message = 'Registrant approved successfully.';
                    $this->selectedUserDetails = null;
                }else{
                    $this->approving = null;
                    $this->popup_message = null;
                    $this->popup_message = 'Failed to send approve mail.';
                    $this->selectedUserDetails = null;
                }
            }else{
                $this->approving = null;
                $this->popup_message = null;
                $this->popup_message = 'Registrant approved unsuccessful.';
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

}
