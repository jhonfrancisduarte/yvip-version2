<?php

namespace App\Livewire;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\User;
use App\Models\PhilippineProvinces;
use App\Models\PhilippineCities;
use Illuminate\Support\Str;

class Register extends Component
{
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
    public $permanent_selectedProvince;
    public $permanent_selectedCity;
    public $p_street_barangay;
    public $residential_selectedProvince;
    public $residential_selectedCity;
    public $r_street_barangay;
    public $educational_background;
    public $status;
    public $nature_of_work;
    public $employer;
    public $profile_picture = 'images/blank_profile_pic.png';
    public $name_of_school;
    public $course;
    public $is_org_member = 'no';
    public $organization_name;
    public $org_position;
    public $is_volunteer = true;
    public $is_ip_participant;
    public $user_role = "yv";
    public $password;
    public $c_password;
    public $provinces;
    public $pcities;
    public $rcities;
    public $permanent_cities;
    public $residential_cities;

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'middle_name' => 'required|min:2',
        'date_of_birth' => 'required|date',
        'civil_status' => 'required',
        'age' => 'required|numeric',
        'nationality' => 'required',
        'mobile_number' => ['required', 'regex:/^\+639\d{9}$|^\d{11}$/'],
        'blood_type' => 'required|max:4|min:1',
        'sex' => 'required',
        'permanent_selectedProvince' => 'required',
        'permanent_selectedCity' => 'required',
        'p_street_barangay' => 'required',
        'residential_selectedProvince' => 'required',
        'residential_selectedCity' => 'required',
        'r_street_barangay' => 'required',
        'educational_background' => 'required',
        'status' => 'required|min:2',
        'is_volunteer' => 'required',
        'password' => 'required|min:8',
        'c_password' => 'required|same:password',
    ];

    public function mount(){
        $this->getProvicesAndCities();
    }

    public function getProvicesAndCities(){
        $this->provinces = PhilippineProvinces::all();
        $this->pcities = collect();
        $this->rcities = collect();
    }

    protected $messages = [
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters long.',
        'c_password.required' => 'The password confirmation field is required.',
        'c_password.same' => 'The password confirmation does not match the password.',
    ];

    public function onBlurEmail (){
        $this->validate([
            'email' => 'required|email|unique:users,email'
        ]);
    }

    public function render(){
        if ($this->permanent_selectedProvince != null) {
            $provinceCode = PhilippineProvinces::where('province_description', $this->permanent_selectedProvince)
                            ->select('province_code')->first();
            $provinceCode = $provinceCode->getAttributes();
            $this->pcities = PhilippineCities::where('province_code', $provinceCode['province_code'])->get();
        }

        if ($this->residential_selectedProvince != null) {
            $provinceCode = PhilippineProvinces::where('province_description', $this->residential_selectedProvince)
                            ->select('province_code')->first();
            $provinceCode = $provinceCode->getAttributes();
            $this->rcities = PhilippineCities::where('province_code', $provinceCode['province_code'])->get();
        }

        return view('livewire.register',[
            'pcities' => $this->pcities,
            'rcities' => $this->rcities,
        ]);
    }

    public function create(){
        try {
            $this->permanent_selectedProvince = Str::ucfirst(Str::lower($this->permanent_selectedProvince));
            $this->permanent_selectedCity = Str::ucfirst(Str::lower($this->permanent_selectedCity));
            $this->residential_selectedProvince = Str::ucfirst(Str::lower($this->residential_selectedProvince));
            $this->residential_selectedCity = Str::ucfirst(Str::lower($this->residential_selectedCity));

            $this->validate();

            if (!$this->isPasswordComplex($this->password)) {
                $this->addError('password', 'The password must contain at least one uppercase letter, one number, and one special character.');
                return;
            }

            if($this->is_ip_participant === true){
                $this->user_role = "yip";
            }

            $passportNumber = 'YP' . date('Y') . $this->generateUserId();

            $user = User::create([
                'id' => Str::uuid(),
                'email' => $this->email,
                'password' => $this->password,
                'user_role' => $this->user_role,
                'name' => $this->first_name . " " . $this->middle_name . " " . $this->last_name,
            ]);

            $user->rewardClaim()->create([
                'user_id' => $user->id,
            ]);

            $user->userData()->create([
                'id' => Str::uuid(),
                'user_id' => $user->id,
                'passport_number' => $passportNumber,
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
                'permanent_selectedProvince' => $this->permanent_selectedProvince,
                'permanent_selectedCity' => $this->permanent_selectedCity,
                'p_street_barangay' => $this->p_street_barangay,
                'residential_selectedProvince' => $this->residential_selectedProvince,
                'residential_selectedCity' => $this->residential_selectedCity,
                'r_street_barangay' => $this->r_street_barangay,
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
            session()->flash('successMessage', 'Successfully Registered! Please Wait for admin activation!');
            return redirect('/registered');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function isPasswordComplex($password){
        $containsUppercase = preg_match('/[A-Z]/', $password);
        $containsNumber = preg_match('/\d/', $password);
        $containsSpecialChar = preg_match('/[^A-Za-z0-9]/', $password); // Changed regex to include special characters
        return $containsUppercase && $containsNumber && $containsSpecialChar;
    }

    private function generateUserId() {
        // $latestUserData = UserData::latest()->first();
        // $nextUserId = $latestUserData ? $latestUserData->user_id + 1 : 1;
        $nextUserId = mt_rand(10000, 99999);
        return strval($nextUserId);
        // return str_pad($nextUserId, 5, '0', STR_PAD_LEFT);
    }
}
