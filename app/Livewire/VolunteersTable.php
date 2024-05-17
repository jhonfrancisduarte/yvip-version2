<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\PhilippineProvinces;
use App\Models\PhilippineCities;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use App\Models\VolunteerSkills;
use App\Models\VolunteerCategory;
use App\Models\VolunteerExperience;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VolunteersTable extends Component
{
    use WithPagination;
    public $selectedUserDetails;
    public $search;
    public $age_range;
    public $civil_status;
    public $deleteVolunteerId;
    public $deactVolunteerId;
    public $reactivateVolunteerId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $provinces;
    public $cities;
    public $selectedProvince;
    public $selectedCity;
    public $active_status = 1;
    public $qrCodeUrl;
    public $volunteerSkills;
    public $volunteerCategories;
    public $volunteerExperiences;
    public $groupedSkills;
    public $advocacy;
    public $advocacyPlans = [];
    
    public $otherDocs = [];

    public function render(){
        if ($this->selectedProvince != null) {
            $provinceCode = PhilippineProvinces::where('province_description', $this->selectedProvince)
                            ->select('province_code')->first();
            $provinceCode = $provinceCode->getAttributes();
            $this->cities = PhilippineCities::where('province_code', $provinceCode['province_code'])->get();
        }

        $volunteers = User::where('user_role', 'yv')
                ->orWhere('user_role', 'yip')
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('users.email', 'users.active_status', 'user_data.*')
                ->search(trim($this->search))
                ->when($this->active_status, function ($query) {
                    return $query->where('users.active_status', $this->active_status);
                })
                ->when($this->age_range, function ($query) {
                    return $query->where('user_data.age', $this->age_range);
                })
                ->when($this->civil_status, function ($query) {
                    return $query->where('user_data.civil_status', $this->civil_status);
                })
                ->when($this->selectedProvince, function ($query) {
                    return $query->where('user_data.permanent_selectedProvince', $this->selectedProvince);
                })
                ->when($this->selectedCity, function ($query) {
                    return $query->where('user_data.permanent_selectedCity', $this->selectedCity);
                })
                ->when($this->advocacy, function ($query) {
                    return $query->where('user_data.advocacy_plans', 'LIKE', '%' . $this->advocacy . '%');
                })
                ->paginate(10);

        $deactivatedVolunteers = User::where('user_role', 'yv')
                ->where('users.active_status', 2)
                ->get();

        $ageRange = User::where('user_role', 'yv')
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('user_data.age')
                ->orderBy('user_data.age', 'asc')
                ->get();

        $volunteers->transform(function ($volunteer){
            $volunteer->advocacy_plans = explode(', ', $volunteer->advocacy_plans);
            return $volunteer;
        });

        return view('livewire.volunteers-table', [
            'volunteers' => $volunteers,
            'deactivatedVolunteers' => $deactivatedVolunteers, 
            'ageRange' => $ageRange, 
            'cities' => $this->cities
        ]);
    }

    public function showUserData($userId){
        $selectedUserDetails = User::where('users.id', $userId)
                                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                                ->select('users.email', 'users.user_role', 'users.active_status', 'user_data.*')
                                ->first();
        $this->advocacyPlans = explode(', ', $selectedUserDetails->advocacy_plans);
        $this->otherDocs = explode(', ', $selectedUserDetails->other_document);
        $this->selectedUserDetails = $selectedUserDetails->getAttributes();
        $details = [
            'Passport No.' => $selectedUserDetails->passport_number,
            'Name' => $selectedUserDetails->first_name . ' ' . $selectedUserDetails->last_name,
            'Nationality' => $selectedUserDetails->nationality,
            'Date of Birth' => $selectedUserDetails->date_of_birth,
        ];

        $text = '';
        foreach ($details as $key => $value) {
            $text .= "$key: $value\n";
        }

        $this->qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . urlencode($text);
        $this->getSkillsAndCategory($userId);
    }

    public function deleteVolunteer($userId){
        try{
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->userData()->delete();
                $user->delete();
                $this->deleteMessage = 'Volunteer deleted successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Volunteer deletion unsuccessfully.';
                $this->disableButton = "Yes";
            }
            $this->deleteVolunteerId = null;
            if($this->selectedUserDetails != null){
                $this->selectedUserDetails = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function hideUserData(){
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function deactDialog($userId){
        $this->deactVolunteerId = $userId;
    }

    public function deleteDialog($userId){
        $this->deleteVolunteerId = $userId;
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteVolunteerId = null;
        $this->deactVolunteerId = null;
        $this->reactivateVolunteerId = null;
        $this->disableButton = "No";
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function mount(){
        $this->getProvicesAndCities();
    }

    public function getProvicesAndCities(){
        $this->provinces = PhilippineProvinces::all();
        $this->cities = collect();
    }

    public function exportToPdf(){
        try{
            $userDetails = $this->selectedUserDetails;
            $pdf = Pdf::loadView('pdf.volunteers-pdf', ['userDetails' => $userDetails]);
            $pdf->setPaper('A4', 'portrait');
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, $userDetails['first_name'] . $userDetails['last_name'] . '_YV.pdf');
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deactivatedAccounts(){
        if($this->active_status == 2){
            $this->active_status = 1;
        }else{
            $this->active_status = 2;
        }
    }

    public function reactivateVolunteer($userId){
        try{
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->update([
                    'active_status' => 1,
                ]);
                $this->deleteMessage = 'Activated successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Activated unsuccessfully.';
                $this->disableButton = "Yes";
            }

            if($this->selectedUserDetails != null){
                $this->selectedUserDetails = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deactivateVolunteer($userId){
        try{
            $user = User::where('id', $userId)->first();
            if ($user){
                $user->update([
                    'active_status' => 2,
                ]);
                $this->deleteMessage = 'Deactivated successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Deactivated unsuccessfully.';
                $this->disableButton = "Yes";
            }

            if($this->selectedUserDetails != null){
                $this->selectedUserDetails = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function reactivateDialog($userId){
        $this->reactivateVolunteerId = $userId;
    }

    public function hideReactivateDialog(){
        $this->deleteMessage = null;
        $this->reactivateVolunteerId = null;
        $this->disableButton = "No";
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function getSkillsAndCategory($userId){
        try{
            $user = User::where('id', $userId)->first();
            if($user){
                $this->volunteerSkills = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->first();
                $this->volunteerCategories = VolunteerCategory::where('user_id', $user->id)->pluck('category_name')->first();
                $this->volunteerExperiences = VolunteerExperience::where('user_id', $user->id)->get();
                $selectedSkillIds = Cache::get("user_{$userId}_selected_skill_ids", []);
                $selectedSkillsWithCategories = DB::table('all_skills')
                    ->whereIn('all_skills.id', $selectedSkillIds)
                    ->join('all_categories', 'all_skills.category_id', '=', 'all_categories.id')
                    ->select('all_skills.*', 'all_categories.all_categories_name')
                    ->get();

                $this->groupedSkills = $selectedSkillsWithCategories->groupBy('all_categories_name');
            }
        }catch(Exception $e){
            throw $e;        
        }
    }

}
