<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $passport_number = "1253254252";
    #[Rule('required|min:2')]
    public $first_name;

    #[Rule('required|min:2')]
    public $last_name;

    
    public $middle_name;
    public $nickname;


    public $date_of_birth ="2024-04-01";

    #[Rule('required')]
    public $civil_status;

    #[Rule('required')]
    public $age;

    #[Rule('required')]
    public $nationality;

    
    public $tel_number;

    #[Rule(['required', 'regex:/^\+639\d{9}$|^\d{11}$/'])]
    public $mobile_number;

    #[Rule(['required', 'email',])]
    public $email;
    
    public $blood_type;

    #[Rule('required')]
    public $sex;

    #[Rule('required')]
    public $permanent_address;

    #[Rule('required')]
    public $residential_address;

    #[Rule('required')]
    public $educational_background;

    #[Rule('required')]
    public $status;


    public $nature_of_work;


    public $employer;


    public $profile_picture = "";


    public $name_of_school;


    public $course;

    public $organization_name;

    public $org_position;

    #[Rule('required')]
    public $is_volunteer=false;


    public $is_ip_participant=false;
    public $user_role = "yip";



    public $password;
    public $c_password;


    protected $rules = [
        'password' => 'required|min:8',
        'c_password' => 'required|same:password',
    ];

    protected $messages = [
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters long.',
        'c_password.required' => 'The password confirmation field is required.',
        'c_password.same' => 'The password confirmation does not match the password.',
    ];

    public function mount(){
        $this->profile_picture = 'images/blank_profile_pic.png';
    }

    

    public function render(){
        return view('livewire.register');
    }

    public function create(){
        //dd($this->all());
        try {
        if (!$this->isPasswordComplex($this->password)) {
            $this->addError('password', 'The password must contain at least one uppercase letter, one number, and one special character.');
            return;
        }
        $this->validate();
        

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
        request()->session()->flash('success',__('Successfully Registered! Wait for admin confirmation'));
        



        $this->reset();
    } catch (\Exception $e) {
        
        \Log::error('Error creating user: ' . $e->getMessage());
        
        throw $e;
    }
}
    private function isPasswordComplex($password){


    $containsUppercase = preg_match('/[A-Z]/', $password);
    $containsNumber = preg_match('/\d/', $password);
    $containsSpecialChar = preg_match('/[^A-Za-z0-9]/', $password); // Changed regex to include special characters
    return $containsUppercase && $containsNumber && $containsSpecialChar;
}

}
