<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    public $passport_num = "1253254252";
    #[Rule('required|min:2')]
    public $first_name;
    #[Rule('required|min:2')]
    public $last_name;
    #[Rule('required|min:2')]
    public $middle_name;
    #[Rule('required|min:2')]
    public $nick_name;
    #[Rule('required')]
    public $birthday;
    #[Rule('required')]
    public $civil_status;
    #[Rule('required|min:1')]
    public $age;
    #[Rule('required|min:2')]
    public $nationality;
    #[Rule('min:7')]
    public $tel_number;
    #[Rule('required|min:11')]
    public $mobile_number;
    #[Rule('required|email')]
    public $email;
    #[Rule('required')]
    public $blood_type;
    #[Rule('required')]
    public $sex;
    #[Rule('required')]
    public $permanent_add;
    #[Rule('required')]
    public $residential_add;
    #[Rule('required')]
    public $educ_background;
    #[Rule('required')]
    public $status;
    #[Rule('required|min:2')]
    public $nature_of_work;
    public $employer;
    public $school;
    public $course;
    public $organization_name;
    public $position;
    #[Rule('required')]
    public $is_volunteer;
    #[Rule('required')]
    public $is_ip_participant;
    #[Rule('required')]
    public $volunteer_or_participant;
    #[Rule('required|min:8')]
    public $password;
    #[Rule('required|min:8')]
    public $c_password;

    public function submit(){
        
    }

}
