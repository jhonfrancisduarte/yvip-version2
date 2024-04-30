<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Exception;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AdminProfileTable extends Component
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
            ->select('users.email', 'users.user_role', 'admin.*')
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

    public function closeEditThis(){
        $this->toBeEdited = null;
    }

    public function closeEditProfileForm(){
        $this->openEditProfile = null;
        $this->profile_picture = null;
        $this->toBeEdited = null;
    }

    public function updateInfo($info){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if($user){
            if($info === "email"){
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
                $user->admin()->update([
                    $info => $this->thisData,
                ]);
                $this->popup_message = null;
                $this->popup_message =  $this->formattedData . ' updated successfully.';
            }
            $this->toBeEdited = null;
            $this->thisData = null;
        }

    }

    public function closePopup(){
        $this->popup_message = null;
    }
    public function opedEditProfileForm(){
        $this->openEditProfile = true;
    }

    public function editProfilePic($id){
        try{
            $user = User::where('id', $id)->first();
    
            $pathToDelete = $user->admin->profile_picture;
            $pathToDelete = str_replace('uploads', '', $pathToDelete);
            if (Storage::disk('public_uploads')->exists($pathToDelete)) {
                Storage::disk('public_uploads')->delete($pathToDelete);
            }                         
    
            if($this->profile_picture){
                $imageName = $this->profile_picture->getClientOriginalName();
                $imagePath = $this->profile_picture->storeAs('profilePics', $imageName, 'public_uploads');
                $imagePath = "uploads/" . $imagePath;
                $user->admin()->update(['profile_picture' => $imagePath]);
            }
            $this->popup_message = null;
            $this->popup_message = 'Profile picture updated successfully.';
            $this->profile_picture = null;
            $this->openEditProfile = null;
        }catch(Exception $e){
            throw $e;
        }
    }

    private function isPasswordComplex($password){
        $containsUppercase = preg_match('/[A-Z]/', $password);
        $containsNumber = preg_match('/\d/', $password);
        $containsSpecialChar = preg_match('/[^A-Za-z0-9]/', $password);
        return $containsUppercase && $containsNumber && $containsSpecialChar;
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

}
