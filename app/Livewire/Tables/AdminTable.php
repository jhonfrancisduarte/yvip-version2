<?php

namespace App\Livewire\Tables;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\admin;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class AdminTable extends Component{
    public $selectedUserDetails;
    public $search;
    public $deleteAdminId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $popup_message;
    public $openAddAdminForm;
    public $reactivateAdminId;

    #[Rule('required|min:2')]
    public $first_name;
    public $middle_name;
    #[Rule('required|min:2')]
    public $last_name;
    #[Rule('required|email')]
    public $email;
    #[Rule('required')]
    public $position;
    public $password;
    public $c_password;
    public $profile_picture = 'images/blank_profile_pic.png';
    public $active_status = 1;
    public $admin_position = "";

    protected $rules = [
        'password' => 'required|min:8',
        'c_password' => 'required|same:password',

    ];

    public function create(){
        try {
            $this->validate();
            if (!$this->isPasswordComplex($this->password)) {
                $this->addError('password', 'The password must contain at least one uppercase letter, one number, and one special character.');
                return;
            }
            $user = User::create([
                'id' => Str::uuid(),
                'email' => $this->email,
                'password' => $this->password,
                'user_role' => $this->position,
                'name' => $this->first_name . " " . $this->middle_name . " " . $this->last_name,
                'active_status' => 1,
            ]);

            admin::create([
                'id' => Str::uuid(),
                'user_id' => $user->id,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'profile_picture' => $this->profile_picture,
            ]);

            $this->reset();
            $this->popup_message = null;
            $this->popup_message = 'Admin registered successfully.';
            $this->resetForm();
        } catch (Exception $e){
            throw $e;
        }
    }

    private function resetForm(){
        $this->reset(['first_name', 'middle_name', 'last_name', 'profile_picture', 'position', 'email', 'password', 'c_password']);
    }

    public function render(){
        $admins = User::whereIn('user_role', ['sa', 'vs', 'vsa', 'ips'])
            ->join('admin', 'users.id', '=', 'admin.user_id')
            ->select('users.email', 'users.active_status', 'users.user_role', 'admin.*')
            ->search2(trim($this->search))
            ->when($this->active_status, function ($query) {
                return $query->where('users.active_status', $this->active_status);
            })
            ->when($this->admin_position, function ($query) {
                return $query->where('users.user_role', $this->admin_position);
            })
            ->paginate(10);

        $deactivatedAdmins = User::whereIn('user_role', ['sa', 'vs', 'vsa', 'ips'])
            ->where('users.active_status', 2)
            ->paginate(10);

        return view('livewire.tables.admin-table', [
            'admins' => $admins, 
            'deactivatedAdmins' => $deactivatedAdmins, 
        ]);
    }

    public function openAddForm(){
        $this->openAddAdminForm = true;
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function closeAddForm(){
        $this->openAddAdminForm = null;
        $this->first_name = null;
        $this->middle_name = null;
        $this->last_name = null;
        $this->email = null;
        $this->position = null;
        $this->password = null;
        $this->c_password = null;
    }

    private function isPasswordComplex($password){
        $containsUppercase = preg_match('/[A-Z]/', $password);
        $containsNumber = preg_match('/\d/', $password);
        $containsSpecialChar = preg_match('/[^A-Za-z0-9]/', $password);
        return $containsUppercase && $containsNumber && $containsSpecialChar;
    }

    public function deleteDialog($adminId){
        $this->deleteAdminId = $adminId;
        $this->selectedUserDetails = null;
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteAdminId = null;
        $this->disableButton = "No";
    }

    public function deleteAdmin($userId){
        try{
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->update([
                    'active_status' => 2,
                ]);
                $this->deleteMessage = 'Admin deactivated successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Admin deactivated unsuccessfully.';
                $this->disableButton = "Yes";
            }

            if($this->selectedUserDetails != null){
                $this->selectedUserDetails = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function showUserData($userId){
        $this->selectedUserDetails = User::where('users.id', $userId)
                                ->join('admin', 'users.id', '=', 'admin.user_id')
                                ->select('users.email', 'users.user_role','admin.*')
                                ->first();
        $this->selectedUserDetails = $this->selectedUserDetails->getAttributes();
    }

    public function hideUserData(){
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function deactivatedAccounts(){
        if($this->active_status == 2){
            $this->active_status = 1;
        }else{
            $this->active_status = 2;
        }
    }

    public function reactivateVolunteer($userId){
        try{
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->update([
                    'active_status' => 1,
                ]);
                $this->deleteMessage = 'Activated successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Activated unsuccessfully.';
                $this->disableButton = "Yes";
            }

            if($this->selectedUserDetails != null){
                $this->selectedUserDetails = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function reactivateDialog($userId){
        $this->reactivateAdminId = $userId;
    }

    public function hideReactivateDialog(){
        $this->deleteMessage = null;
        $this->reactivateAdminId = null;
        $this->disableButton = "No";
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }
}
