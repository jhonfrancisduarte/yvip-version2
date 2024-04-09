<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public $passport_number = "1253254252";

    #[Rule('required|min:2')]
    public $first_name;

    #[Rule('required|min:2')]
    public $last_name;
    #[Rule('required|min:2')]
    public $middle_name;
    public $nickname;
<<<<<<< HEAD
    public $date_of_birth ="2024-04-01";
=======

    #[Rule('required')]
    public $date_of_birth;

    #[Rule('required')]
>>>>>>> 82cb7890469033fd69ab61c0d5753f25ebcb4905
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
    public $is_volunteer;
    public $is_ip_participant;
    public $user_role = "yv";

    public $password;

    public $c_password;


    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'middle_name' => 'required|min:2',
        'nickname' => 'required|min:2',
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

    

    public function render()
    {
        return view('livewire.register');
    }

    public function create(){
<<<<<<< HEAD
        // dd($this->all());
        // $this->validate();
        User::create($this->all());
        $this->reset();
    }

    public function updatedStatus($value)
    {
        if ($value == 'Student') {
            $this->reset(['nature_of_work', 'employer']);
        } else if ($value == 'Professional') {
            $this->reset(['name_of_school', 'course']);
=======
        try {
            // dd($this->all());
            $this->validate();
            if (!$this->isPasswordComplex($this->password)) {
                $this->addError('password', 'The password must contain at least one uppercase letter, one number, and one special character.');
                return;
            }

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
            session(['success' => 'Successfully Registered! Wait for admin confirmation']); 
            // $this->reset();
        } catch (\Exception $e) {
            session(['unsuccessful' => 'Registration failed! ' . $e ]);
            throw $e;
>>>>>>> 82cb7890469033fd69ab61c0d5753f25ebcb4905
        }
    }

    public function updatedDateOfBirth($value)
{
    $parsedDate = Carbon::createFromFormat(['Y-m-d', 'd/m/Y', 'm/d/Y'], $value);
    
    if ($parsedDate) {
        $formattedDate = $parsedDate->format('Y-m-d');
        $this->date_of_birth = $formattedDate;
    } else {
        $this->date_of_birth = null;
        $this->addError('date_of_birth', 'Invalid date format.');
    }
}

}