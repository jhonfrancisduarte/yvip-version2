<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Exception;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\PhilippineProvinces;
use App\Models\PhilippineCities;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminProfileTable extends Component
{
    use WithFileUploads;
    public $popup_message;
    public $profile_picture;
    public $openEditProfile;
    public $myInfo = true;
    public $editMyInfo;
    public $toBeEdited;
    public $formattedData;
    public $value;
    #[Rule('required|min:2|max:100')]
    public $thisData;
    public $name_of_school;
    public $course;
    public $nature_of_work;
    public $employer;
    #[Rule('required')]
    public $selectedProvince;
    #[Rule('required')]
    public $selectedCity;
    #[Rule('required|min:2')]
    public $p_street_barangay;
    public $provinces;
    public $cities;
    #[Rule('required|min:8')]
    public $password;
    #[Rule('required|min:8')]
    public $new_password;
    #[Rule('required|min:8')]
    public $c_new_pass;
    public $deleteAccDialog;

    protected $rules = [
        'password' => 'required|min:8',
        'new_password' => 'required|min:8',
        'c_new_pass' => 'required|same:new_password',

    ];

    public function render(){
        $userId = Auth::user()->id;
        $user = User::where('users.id', $userId)
            ->join('admin', 'users.id', '=', 'admin.user_id')
            ->select('users.email', 'admin.*')
            ->first();
        
        return view('livewire.admin.admin-profile-table',[
            'user' => $user,
        ]);
    }

    public function openEditMyInfo(){
        $this->myInfo = null;
        $this->editMyInfo = true;
    }

    public function closeEditMyInfo(){
        $this->myInfo = true;
        $this->editMyInfo = null;
    }

    public function editThis($data){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if ($user && $user->admin){
            if($data === "email"){
                $columnValue = $user->{$data};
                $this->thisData = $columnValue;
            }
            elseif($data === "password"){
            }
            else{
                $columnValue = $user->admin->get([$data])->pluck($data)->first();
                $this->thisData = $columnValue;
            }
            $this->toBeEdited = $data;
            $this->formattedData = str_replace('_', ' ', $data);
        }
    }

}
