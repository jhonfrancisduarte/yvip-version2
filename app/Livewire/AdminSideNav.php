<?php

namespace App\Livewire;
use App\Models\IpEvents;
use App\Models\VolunteerRewards;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\PastIpEvent;
use App\Models\VolunteerEventsAndTrainings;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\ClaimRequest;
use App\Models\VolunteerHours;
use Exception;

class AdminSideNav extends Component
{
    public $confirmedEventsCount;
    public $joinRequests = 0;
    public $volunteerRegs;
    public $volunteerJoinRequests;
    public $ipRegs;
    public $claimRequests;
    public $unassignedParticipantsCount = 0;

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
    public function mount()
    {
        $this->confirmedEventsCount = PastIpEvent::where('confirmed', false)->count();
        $volunteers = User::where('user_role', 'yv')
                                    ->where('active_status', 0)
                                    ->get();
        $ips = User::where('user_role', 'yip')
                                    ->where('active_status', 0)
                                    ->get();
        $this->volunteerRegs = count($volunteers);
        $this->ipRegs = count($ips);
        $this->getJoinRequests();
        $this->getJoinRequestsVolunteer();
        $this->getHoursUngrantedParticipants();
        $this->claimRequests = VolunteerRewards::where('request_status', 1)
                                ->where('claim_status', 0)
                                ->get();
        $this->claimRequests = count($this->claimRequests);
    }

    #[On('ip-validation-counter')]
    #[On('volunteer-request')]
    #[On('claim-request')]
    public function counter(){
        $this->confirmedEventsCount = PastIpEvent::where('confirmed', false)->count();
        $volunteers = User::where('user_role', 'yv')
                                    ->where('active_status', 0)
                                    ->get();
        $ips = User::where('user_role', 'yip')
                                    ->where('active_status', 0)
                                    ->get();
        $this->volunteerRegs = count($volunteers);
        $this->ipRegs = count($ips);
        $this->getJoinRequests();
        $this->getJoinRequestsVolunteer();
        $this->getHoursUngrantedParticipants();
        $this->claimRequests = VolunteerRewards::where('request_status', 1)
                                ->where('claim_status', 0)
                                ->get();
        $this->claimRequests = count($this->claimRequests);
    }

    public function getJoinRequests(){
        $totalJoinRequests = 0;
        $ipEvents = IpEvents::all();

        $ipEvents->transform(function ($event) use (&$totalJoinRequests) {
            $joinRequests = explode(',', $event->join_requests);
            foreach ($joinRequests as $joinRequest) {
                if (!empty($joinRequest)) {
                    $totalJoinRequests ++;
                }
            }

            return $event;
        });

        $this->joinRequests = $totalJoinRequests;
    }

    public function getJoinRequestsVolunteer(){
        $totalJoinRequests = 0;
        $volunteerEvents = VolunteerEventsAndTrainings::all();

        $volunteerEvents->transform(function ($event) use (&$totalJoinRequests) {
            $joinRequests = explode(',', $event->join_requests);
            foreach ($joinRequests as $joinRequest) {
                if (!empty($joinRequest)) {
                    $totalJoinRequests ++;
                }
            }

            return $event;
        });

        $this->volunteerJoinRequests = $totalJoinRequests;
    }

    public function getHoursUngrantedParticipants(){
        try{
            $events = VolunteerEventsAndTrainings::all();
            foreach ($events as $event) {
                if($event->status === 'Completed'){
                    $participantIds = array_map('trim', explode(',', $event->participants));
                    $participants = explode(',', $event->participants);
                    $totalParticipants = count($participants) - 1;
                    $volunteerHours = VolunteerHours::where('event_id', $event->id)
                                                    ->whereIn('user_id', $participantIds)
                                                    ->get();
        
                    // Get the participant IDs that have volunteer hours
                    $participantsWithHours = $volunteerHours->pluck('user_id')->unique()->toArray();
        
                    // Count the participants without hours
                    if($totalParticipants > 0){
                        $this->unassignedParticipantsCount += $totalParticipants - count($participantsWithHours);
                    }
                }
            }
        }catch(Exception $e){
            throw $e;
        }
    }


    public function render(){
        return view('livewire.admin-side-nav', [
            'confirmedEventsCount' => $this->confirmedEventsCount,
            'joinRequests' => $this->joinRequests,
            'volunteerRegs' => $this->volunteerRegs,
            'volunteerJoinRequests' => $this->volunteerJoinRequests,
            'ipRegs' => $this->ipRegs,
            'unassignedParticipantsCount' => $this->unassignedParticipantsCount,
        ]);
    }
}
