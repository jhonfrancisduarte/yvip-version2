<?php

namespace App\Livewire\Tables;
use App\Models\IpEvents;
use Livewire\Component;
use App\Models\User;

class ParticipatedIpEventsTable extends Component
{
    public $search;
    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->get();
    
        $ipEvents->transform(function ($event) use (&$joinRequestsData) {
            $participantIds = explode(',', $event->participants);
            $userId = auth()->user()->id;

    
            $currentDate = now();
            if ($currentDate >= $event->start && $currentDate <= $event->end) {
                $event->status = 'Ongoing';
            } elseif ($currentDate > $event->end) {
                $event->status = 'Completed';
            } else {
                $event->status = 'Upcoming';
            }
    
            $event->approved = in_array($userId, $participantIds);

            return $event;
        });

        return view('livewire.tables.participated-ip-events-table',  compact('ipEvents'));
    }
}
