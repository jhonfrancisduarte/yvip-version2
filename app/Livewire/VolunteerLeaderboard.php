<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Volunteer;
use App\Models\UserData;
use Illuminate\Support\Facades\DB;

class VolunteerLeaderboard extends Component
{
    public $totalHoursPerUser;

    public function mount()
    {
        $this->totalHoursPerUser = Volunteer::select('user_id', \DB::raw('SUM(volunteering_hours) as total_volunteer_hours'))
        ->groupBy('user_id')
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
