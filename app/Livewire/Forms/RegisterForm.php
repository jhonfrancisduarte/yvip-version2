<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Rule;


class RegisterForm extends Form
{
    public $passport_number = "1253254252";
    #[Rule('required|min:2')]
    public $first_name;

    #[Rule('required|min:2')]
    public $last_name;


    public $middle_name;
    public $nickname;

    #[Rule('required')]
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

    #[Rule(['required', 'email'])]
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

    #[Rule('required')]
    public $nature_of_work;

    #[Rule('required')]
    public $employer;


    public $profile_picture = "";

    #[Rule('required')]
    public $name_of_school;

    #[Rule('required')]
    public $course;


    public $organization_name;

    public $org_option;
    public $org_position;

    #[Rule('required')]
    public $is_volunteer=false;


    public $is_ip_participant=false;
    public $user_role = "yip";

    public $password;
    public $c_password;

    public function submit(){

    }

}
