<?php

namespace App\Livewire;

use App\Models\RewardClaim;
use Livewire\Component;
use App\Models\UserData;

class VolunteerLeaderboard extends Component
{
    public $totalHoursPerUser;

    public function mount()
    {
        $this->totalHoursPerUser = RewardClaim::select('user_id', 'total_hours as total_volunteer_hours')
            ->get();

        foreach ($this->totalHoursPerUser as $record) {
            $userData = UserData::where('user_id', $record->user_id)->first();
            $record->fullname = $userData ? $userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name : '';
            $record->profile_picture = $userData ? $userData->profile_picture : '';
            $record->user_id = $userData ? $userData->user_id : '';
        }

        $this->totalHoursPerUser = $this->totalHoursPerUser->sortByDesc('total_volunteer_hours')->values()->all();
    }

    public function render()
    {
        return view('livewire.volunteer-leaderboard', [
            'totalHoursPerUser' => $this->totalHoursPerUser,
        ]);
    }
}