<?php

namespace App\Livewire\Tables;
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
use DateTime;
use Illuminate\Support\Facades\Session;
class MyProfile extends Component
{
    use WithFileUploads;
    public $popup_message;
    #[Rule('required')]
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
        if ($this->selectedProvince != null) {
            $provinceCode = PhilippineProvinces::where('province_description', $this->selectedProvince)
                            ->select('province_code')->first();
            $provinceCode = $provinceCode->getAttributes();
            $this->cities = PhilippineCities::where('province_code', $provinceCode['province_code'])->get();
        }

        $userId = Auth::user()->id;
        $user = User::where('users.id', $userId)
            ->join('user_data', 'users.id', '=', 'user_data.user_id')
            ->select('users.email', 'user_data.*', DB::raw("DATE_FORMAT(user_data.date_of_birth, '%d %M, %Y') as formatted_date_of_birth"))
            ->first();


        return view('livewire.tables.my-profile', [
            'user' => $user,
            'cities' => $this->cities,
        ]);
    }

    public function mount(){
        $this->getProvicesAndCities();
    }

    public function getProvicesAndCities(){
        $this->provinces = PhilippineProvinces::all();
        $this->cities = collect();
    }

    public function editProfilePic($id){
        try{
            $user = User::find($id);
    
            if ($user->userData->profile_picture && $user->userData->profile_picture !== 'images/blank_profile_pic.png') {
                $pathToDelete = $user->userData->profile_picture;
                $pathToDelete = str_replace('uploads', '', $pathToDelete);
                if (Storage::disk('public_uploads')->exists($pathToDelete)) {
                    Storage::disk('public_uploads')->delete($pathToDelete);
                }
            }                            
    
            if($this->profile_picture){
                $imageName = $this->profile_picture->getClientOriginalName();
                $imagePath = $this->profile_picture->storeAs('profilePics', $imageName, 'public_uploads');
                $imagePath = "uploads/" . $imagePath;
                $user->userData()->update(['profile_picture' => $imagePath]);
            }
            $this->popup_message = null;
            $this->popup_message = 'Profile picture updated successfully.';
            $this->profile_picture = null;
            $this->openEditProfile = null;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function opedEditProfileForm(){
        $this->openEditProfile = true;
    }

    public function closeEditProfileForm(){
        $this->openEditProfile = null;
        $this->profile_picture = null;
        $this->toBeEdited = null;
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function openEditMyInfo(){
        $this->myInfo = null;
        $this->editMyInfo = true;
    }

    public function closeEditMyInfo(){
        $this->myInfo = true;
        $this->editMyInfo = null;
    }

    public function closeEditThis(){
        $this->toBeEdited = null;
    }

    public function editThis($data){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if ($user && $user->userData){
            if($data === "email"){
                $columnValue = $user->{$data};
                $this->thisData = $columnValue;
            }
            elseif($data === "password"){
            }
            else{
                $columnValue = $user->userData->get([$data])->pluck($data)->first();
                $this->thisData = $columnValue;
            }
            $this->toBeEdited = $data;
            $this->formattedData = str_replace('_', ' ', $data);
        }
    }

    public function updateInfo($info){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if($user){
            if($info === "status"){
                $user->userData()->update([
                    $info => $this->thisData,
                ]);
                if($this->thisData === "Professional"){
                    $user->userData()->update([
                        'nature_of_work' => $this->nature_of_work,
                        'employer' => $this->employer,
                        'name_of_school' => null,
                        'course' => null,
                    ]);
                }   
                elseif($this->thisData === "Student"){
                    $user->userData()->update([
                        'nature_of_work' => null,
                        'employer' => null,
                        'name_of_school' => $this->name_of_school,
                        'course' => $this->course,
                    ]);
                } 
                $this->popup_message = null;
                $this->popup_message =  'Status updated successfully.';  
            }
            elseif($info === "permanent_selectedProvince"){
                $this->selectedProvince = Str::ucfirst(Str::lower($this->selectedProvince));
                $this->selectedCity = Str::ucfirst(Str::lower($this->selectedCity));
                $this->p_street_barangay = Str::ucfirst(Str::lower($this->p_street_barangay));
                $user->userData()->update([
                    'permanent_selectedProvince' => $this->selectedProvince,
                    'permanent_selectedCity' => $this->selectedCity,
                    'p_street_barangay' => $this->p_street_barangay,
                ]);
                $this->popup_message = null;
                $this->popup_message =  'Permanent address updated successfully.';
            }
            elseif($info === "residential_selectedProvince"){
                $this->selectedProvince = Str::ucfirst(Str::lower($this->selectedProvince));
                $this->selectedCity = Str::ucfirst(Str::lower($this->selectedCity));
                $this->p_street_barangay = Str::ucfirst(Str::lower($this->p_street_barangay));
                $user->userData()->update([
                    'residential_selectedProvince' => $this->selectedProvince,
                    'residential_selectedCity' => $this->selectedCity,
                    'r_street_barangay' => $this->p_street_barangay,
                ]);
                $this->popup_message = null;
                $this->popup_message =  'Residential address updated successfully.';
            }
            elseif($info === "email"){
                $user->update([
                    $info => $this->thisData,
                ]);
                $this->popup_message = null;
                $this->popup_message =  'Email updated successfully.';
            }
            elseif($info === "password"){       
                if ($this->isPasswordComplex($this->new_password) === false) {
                    $this->addError('new_password', 'The password must contain at least one uppercase letter, one number, and one special character.');
                    return;
                }

                if ($this->new_password !== $this->c_new_pass) {
                    $this->addError('new_password', 'The new password do not match.');
                    return;
                }

                if (!Hash::check($this->password, Auth::user()->password)) {
                    $this->addError('new_password', 'The current password is incorrect.');
                    return;
                }

                $user->update([
                    'password' => Hash::make($this->new_password),
                ]);
                $this->popup_message = null;
                $this->popup_message =  'Password updated successfully.';
            }
            else{
                $user->userData()->update([
                    $info => $this->thisData,
                ]);
                $this->popup_message = null;
                $this->popup_message =  $this->formattedData . ' updated successfully.';
            }
            $this->toBeEdited = null;
            $this->thisData = null;
            $this->selectedProvince = null;
            $this->selectedCity =  null;
            $this->p_street_barangay = null;
            $this->nature_of_work = null;
            $this->employer = null;
            $this->name_of_school = null;
            $this->course = null;
        }
    }

    public function deleteAccount(){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if($user){
            // soft deletion
            $user->update([
                'active_status' => 2,
            ]);
            Auth::logout();
            Session::flush();
            return redirect('/');
        }
    }

    public function deleteDialog(){
        $this->deleteAccDialog = true;
    }

    public function hideDeleteDialog(){
        $this->deleteAccDialog = null;
    }

    private function isPasswordComplex($password){
        $containsUppercase = preg_match('/[A-Z]/', $password);
        $containsNumber = preg_match('/\d/', $password);
        $containsSpecialChar = preg_match('/[^A-Za-z0-9]/', $password);
        return $containsUppercase && $containsNumber && $containsSpecialChar;
    }
}
