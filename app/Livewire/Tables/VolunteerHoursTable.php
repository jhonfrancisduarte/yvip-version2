<?php

namespace App\Livewire\Tables;

use App\Models\RewardClaim;
use App\Models\User;
use App\Models\VolunteerCategory;
use App\Models\VolunteerExperience;
use App\Models\VolunteerSkills;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VolunteerHoursTable extends Component
{
    use WithPagination;

    public $selectedUserDetails;
    public $qrCodeUrl;
    public $search;
    public $sortDirection = 'desc';
    public $volunteerSkills;
    public $volunteerCategories;
    public $volunteerExperiences;
    public$volunteerHours;
    public $groupedSkills;
    public $hours;

    public function render(){
        $query = RewardClaim::with('user')
                            ->leftJoin('users', 'reward_claim.user_id', '=', 'users.id')
                            ->select('reward_claim.*', 'users.name')
                            ->when($this->hours, function ($query) {
                                return $query->where('reward_claim.total_hours', $this->hours);
                            })
                            ->search(trim($this->search))
                            ->orderBy('reward_claim.total_hours', $this->sortDirection)
                            ->paginate(10);
                

        return view('livewire.tables.volunteer-hours-table', [
            'userHours' => $query,
        ]);
    }

    public function showUserData($userId){
        $selectedUserDetails = User::where('users.id', $userId)
                                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                                ->select('users.email', 'users.user_role', 'users.active_status', 'user_data.*')
                                ->first();
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

    public function hideUserData(){
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function toggleSortDirection(){
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function getSkillsAndCategory($userId){
        try{
            $user = User::where('id', $userId)->first();
            if($user){
                $this->volunteerHours = RewardClaim::where('user_id', $user->id)->first();
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
