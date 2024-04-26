<?php

namespace App\Livewire\Tables;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\admin;
use Illuminate\Support\Facades\Log;

class AdminTable extends Component{
    public $selectedUserDetails;
    public $search;
    public $deleteAdminId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $popup_message;
    public $openAddAdminForm;

    #[Rule('required|min:2')]
    public $first_name;
    #[Rule('required|min:2')]
    public $middle_name;
    #[Rule('required|min:2')]
    public $last_name;
    #[Rule('required|email')]
    public $email;
    #[Rule('required')]
    public $position;
    public $password;
    public $c_password;
    public $profile_picture = "";

    public $admin_position = "";

    protected $rules = [
        'password' => 'required|min:8',
        'c_password' => 'required|same:password',

    ];

    public function mount(){
        $this->profile_picture = 'images/blank_profile_pic.png';
    }

    public function create(){
        sleep(2);
        DB::beginTransaction();
        try {
            $this->validate();
            if (!$this->isPasswordComplex($this->password)) {
                $this->addError('password', 'The password must contain at least one uppercase letter, one number, and one special character.');
                return;
            }
            $user = User::create([
                'email' => $this->email,
                'password' => $this->password,
                'user_role' => $this->position,
                'name' => $this->first_name . " " . $this->middle_name . " " . $this->last_name,
                'active_status' => 1,
            ]);

            admin::create([
                'user_id' => $user->id,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'profile_picture' => $this->profile_picture,
            ]);

            DB::commit();
            $this->reset();
            $this->popup_message = null;
            $this->popup_message = 'Admin registered successfully.';
        } catch (\Exception $e){
            throw $e;
            $this->popup_message = 'Failed to register admin. Please try again.';
            Log::error('Error occurred while registering admin: ' . $e->getMessage());
        }
    }

    public function render(){
        $admins = User::whereIn('user_role', ['sa', 'vs', 'vsa', 'ips'])
            ->join('admin', 'users.id', '=', 'admin.user_id')
            ->select('users.email', 'users.active_status', 'users.user_role', 'admin.*')
            ->search2(trim($this->search))
            ->when($this->admin_position, function ($query) {
                return $query->where('users.user_role', $this->admin_position);
            })
            ->get();

        return view('livewire.tables.admin-table', [
            'admins' => $admins, 
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
        $user = User::find($userId);
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
}
