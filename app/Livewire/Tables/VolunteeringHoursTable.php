<?php

namespace App\Livewire\Tables;

use App\Models\Rewards;
use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class VolunteeringHoursTable extends Component
{
    use WithPagination;
    public $search;

    public function render(){
        $volunteerEventsAndTrainings = VolunteerEventsAndTrainings::join('users', 'users.id', '=', 'volunteer_events_and_trainings.user_id')
            ->select('users.name', 'volunteer_events_and_trainings.*')
            ->search(trim($this->search))
            ->orderBy('volunteer_events_and_trainings.created_at', 'desc')
            ->paginate(10);

        $volunteerEventsAndTrainings->transform(function ($event) {
            $participantIds = explode(',', $event->participants);
            $userId = auth()->user()->id;

            $event->approved = in_array($userId, $participantIds);

            return $event;
        });

        $totalHours = $this->getTotalVolunteeringHours();
        $rewardMatrix = Rewards::orderBy('number_of_hours', 'desc')->pluck('number_of_hours')->toArray();

        return view('livewire.tables.volunteering-hours-table', [
            'volunteerEventsAndTrainings' => $volunteerEventsAndTrainings,
            'totalHours' => $totalHours,
            'rewardMatrix' => $rewardMatrix,
        ]);
    }

    private function getTotalVolunteeringHours(){
        $user = Auth::user();
        return $user->rewardClaim->total_hours;
    }
}
