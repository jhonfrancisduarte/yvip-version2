<?php

namespace App\Livewire;
use App\Models\IpEvents;
use App\Models\admin;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\PastIpEvent;
use App\Models\VolunteerEventsAndTrainings;

use App\Models\User;

class AdminSideNav extends Component
{
    public $confirmedEventsCount;
    public $joinRequests = 0;
    public $volunteerRegs;
    public $volunteerJoinRequests;
    public $ipRegs;

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
    }


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

    public function render()
    {
        return view('livewire.admin-side-nav', [
            'confirmedEventsCount' => $this->confirmedEventsCount,
            'joinRequests' => $this->joinRequests,
            'volunteerRegs' => $this->volunteerRegs,
            'volunteerJoinRequests' => $this->volunteerJoinRequests,
            'ipRegs' => $this->ipRegs,
        ]);
    }
}
