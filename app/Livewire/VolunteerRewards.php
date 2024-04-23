<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rewards;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;

class VolunteerRewards extends Component
{
    public $rewards;
    public $openRewards;
    public $totalVolunteerHours;
    public $reward;

    public function mount()
    {
        $this->rewards = Rewards::all();
        $this->fetchTotalVolunteerHours();
    }
    public function render()
    {
        return view('livewire.volunteer-rewards');
    }

    public function seeRewards(){
        $this->openRewards = true;
    }

    public function closeRewards(){
        $this->openRewards = null;
    }

    private function fetchTotalVolunteerHours()
    {
        $user = Auth::user();
        $this->totalVolunteerHours = Volunteer::where('user_id', $user->id)->sum('volunteering_hours');

        if ($this->totalVolunteerHours < 8) {
            $this->reward = 'No Rewards';
        } elseif ($this->totalVolunteerHours >= 8 && $this->totalVolunteerHours < 100) {
            $this->reward = 'PYDP Pin/NYC Pin Badge';
        } elseif ($this->totalVolunteerHours >= 100 && $this->totalVolunteerHours < 200) {
            $this->reward = 'Tote bag';
        } elseif ($this->totalVolunteerHours >= 200 && $this->totalVolunteerHours < 500) {
            $this->reward = 'Tumbler';
        } else {
            $this->reward = 'Shirt or Jacket';
        }
    }
}
