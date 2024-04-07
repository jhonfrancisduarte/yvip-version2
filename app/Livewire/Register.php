<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $passport_number = "1253254252";
    public $first_name;
    public $last_name;
    public $middle_name;
    public $nickname;
    public $date_of_birth ="2024-04-01";
    public $civil_status;
    public $age;
    public $nationality;
    public $tel_number;
    public $mobile_number;
    public $email;
    public $blood_type;
    public $sex;
    public $permanent_address;
    public $residential_address;
    public $educational_background;
    public $status;
    public $nature_of_work;
    public $employer;
    public $profile_picture = "";
    public $name_of_school;
    public $course;
    public $organization_name;
    public $org_position;
    public $is_volunteer;
    public $is_ip_participant;
    public $user_role = "yip";
    public $password;
    public $c_password;

    // Define validation rules for each field
    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'middle_name' => 'required|min:2',
        'nickname' => 'min:2',
        'date_of_birth' => 'required|date',
        'civil_status' => 'required',
        'age' => 'required|numeric|min:1',
        'nationality' => 'required|min:2',
        'tel_number' => 'nullable|min:7',
        'mobile_number' => 'required|min:11',
        'email' => 'required|email|unique:users,email',
        'blood_type' => 'required',
        'sex' => 'required',
        'permanent_address' => 'required',
        'residential_address' => 'required',
        'educational_background' => 'required',
        'status' => 'required',
        'nature_of_work' => 'required|min:2',
        'employer' => 'required|min:2',
        'name_of_school' => 'required|min:2',
        'course' => 'required|min:2',
        'organization_name' => 'required|min:2',
        'org_position' => 'required|min:2',
        'is_volunteer' => 'required',
        'is_ip_participant' => 'required',
        'user_role' => 'required',
        'password' => 'required|min:6',
        'c_password' => 'required|same:password',
    ];

    public function mount(){
        $this->profile_picture = 'images/blank_profile_pic.png';
    }

    public function render(){
        return view('livewire.register');
    }

    public function create(){
        // dd($this->all());
        // $this->validate();
        // $validatedData = $this->validate();

        $user = User::create([
            'email' => $this->email,
            'password' => $this->password,
            'user_role' => $this->user_role,
        ]);
    

        $user->userData()->create([
            'user_id' => $user->id,
            'passport_number' => $this->passport_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'nickname' => $this->nickname,
            'date_of_birth' => $this->date_of_birth,
            'civil_status' => $this->civil_status,
            'age' => $this->age,
            'nationality' => $this->nationality,
            'tel_number' => $this->tel_number,
            'mobile_number' => $this->mobile_number,
            'blood_type' => $this->blood_type,
            'sex' => $this->sex,
            'permanent_address' => $this->permanent_address,
            'residential_address' => $this->residential_address,
            'educational_background' => $this->educational_background,
            'status' => $this->status,
            'nature_of_work' => $this->nature_of_work,
            'employer' => $this->employer,
            'profile_picture' => $this->profile_picture,
            'name_of_school' => $this->name_of_school,
            'course' => $this->course,
            'organization_name' => $this->organization_name,
            'org_position' => $this->org_position,
            'is_volunteer' => $this->is_volunteer,
            'is_ip_participant' => $this->is_ip_participant,
        ]);
        

        $this->reset();
    }

}
