<?php

namespace App\Livewire\Tables;
use App\Models\IpEvents;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipatedIpEventsTable extends Component
{
    use WithPagination;
    public $search;
    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->paginate(10);
    
        $ipEvents->transform(function ($event) use (&$joinRequestsData) {
            $participantIds = explode(',', $event->participants);
            $userId = auth()->user()->id;
            $event->approved = in_array($userId, $participantIds);

            return $event;
        });

        return view('livewire.tables.participated-ip-events-table',  compact('ipEvents'));
    }
}
