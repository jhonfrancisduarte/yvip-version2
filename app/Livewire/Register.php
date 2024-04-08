<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public $passport_number = "1253254252";
    public $first_name;
    public $last_name;
    public $middle_name;
    public $nickname;
    public $date_of_birth;
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
    public $password;
    public $c_password;

    // Define validation rules for each field
    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'middle_name' => 'required|min:2',
        'nickname' => 'required|min:2',
        'date_of_birth' => 'required|date_format:Y-m-d',
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
        'is_volunteer' => 'required_without:is_ip_participant',
        'is_ip_participant' => 'required_without:is_volunteer',
        'password' => 'required|min:8',
        'c_password' => 'required|same:password',
    ];

    public function mount()
    {
        // Set default profile picture
        $this->profile_picture = 'images/blank_profile_pic.png';
    }

    public function render()
    {
        return view('livewire.register');
    }

    public function create()
    {
        $this->validate();

        if (!$this->is_volunteer && !$this->is_ip_participant) {
            $this->addError('is_volunteer', 'Please select at least one option.');
        }
    
        // Check if there are any validation errors
        $errors = $this->getErrorBag()->all();
    
        if (count($errors) > 0) {
            return;
        }

        $this->reset();
    }

    public function updatedStatus($value)
    {
        if ($value == 'Student') {
            $this->reset(['nature_of_work', 'employer']);
        } else if ($value == 'Professional') {
            $this->reset(['name_of_school', 'course']);
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