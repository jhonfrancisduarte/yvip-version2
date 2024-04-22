<?php

namespace App\Livewire\Tables;

use App\Models\IpEvents;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Rule;
use Exception;
use Illuminate\Support\Facades\Auth;

class IpEventsTable extends Component
{
    public $deleteSkillsandCategories;
    public $openEditEvent;
    public $openAddEvent;
    public $popup_message;
    public $editEventId;
    public $deleteCategoryId;
    public $search;
    #[Rule('required|min:2')]
    public $event_name;
    #[Rule('required|min:2')]
    public $organizer_sponsor;
    #[Rule('required')]
    public $start;
    #[Rule('required')]
    public $end;
    #[Rule('required')]
    public $newSkills = [''];

    public $deleteMessage;
    public $disableButton = "No";
    public $deleteEventId;
    public $openJoinRequestsTable;
    public $joinEventId;
    public $thisUserDetails;
    public $isParticipant;
    public $eventId;
    public $options;
    public $file;

    public function addSkill(){
        $this->newSkills[] = '';
    }

    public function removeSkill($index){
        unset($this->newSkills[$index]);
    }
    
    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->get();
    
        $joinRequestsData = [];
    
        $ipEvents->transform(function ($event) use (&$joinRequestsData) {
            $participantIds = explode(',', $event->participants);
            $disapprovedIds = explode(',', $event->disapproved);
            $participantData = [];
            $userId = auth()->user()->id;
    
            foreach ($participantIds as $participantId) {
                $participantId = trim($participantId);
    
                if (!empty($participantId)) {
                    $user = User::find($participantId);
                    $userData = $user->userData;
    
                    if ($userData) {
                        $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                        $participantData[] = [
                            'user_id' => $participantId,
                            'name' => $name,
                        ];
                    }
                }
            }
    
            // Fetch join_requests data for the current event
            $joinRequests = explode(',', $event->join_requests);
            $joinRequestsData[$event->id] = [];
            foreach ($joinRequests as $joinRequest) {
                $joinRequest = trim($joinRequest);
    
                if (!empty($joinRequest)) {
                    $user = User::find($joinRequest);
                    $userData = $user->userData;
    
                    if ($userData) {
                        $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                        $joinRequestsData[$event->id][] = [
                            'user_id' => $joinRequest,
                            'name' => $name,
                        ];
                    }
                }
            }
    
            $currentDate = now();
            if ($currentDate >= $event->start && $currentDate <= $event->end) {
                $event->status = 'Ongoing';
            } elseif ($currentDate > $event->end) {
                $event->status = 'Completed';
            } else {
                $event->status = 'Upcoming';
            }
    
            $event->participantData = $participantData;
            $event->qualifications = explode(',', $event->qualifications);
            $event->hasJoined = in_array($userId, $joinRequests);
            $event->approved = in_array($userId, $participantIds);
            $event->disapprovedParticipants = in_array($userId, $disapprovedIds);
    
            return $event;
        });
    
        return view('livewire.tables.ip-events-table', compact('ipEvents', 'joinRequestsData'));
    }

    public function createEvent(){
        try{
            $userId = Auth::user()->id;
            $event = IpEvents::create([
                'user_id' => $userId,
                'event_name' => $this->event_name,
                'organizer_sponsor' => $this->organizer_sponsor,
                'start' => $this->start,
                'end' => $this->end,
                'qualifications' => implode(', ', $this->newSkills),
            ]);

            $this->popup_message = null;
            $this->popup_message = "IP event added successfully.";
            $this->openAddEvent = null;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function editEvent(){
        $event = IpEvents::find($this->editEventId);
        $userId = Auth::user()->id;
        if($event){
            $event->update([
                'user_id' => $userId,
                'event_name' => $this->event_name,
                'organizer_sponsor' => $this->organizer_sponsor,
                'start' => $this->start,
                'end' => $this->end,
                'qualifications' => implode(', ', $this->newSkills),
            ]);

            $this->openEditEvent= null;
            $this->editEventId = null;
            $this->popup_message = null;
            $this->popup_message = "IP event updated successfully.";
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function openAddForm(){
        $this->openAddEvent = true;
    }

    public function closeAddForm(){
        $this->openAddEvent = null;
    }

    public function openEditForm($eventId){
        $this->openEditEvent = true;
        $event = IpEvents::find($eventId);
        if($event){
            $this->event_name = $event->event_name;
            $this->organizer_sponsor = $event->organizer_sponsor;
            $this->newSkills = is_string($event->qualifications) ? explode(',', $event->qualifications) : [];
            $this->start = $event->start;
            $this->end = $event->end;
            $this->editEventId = $eventId;
        }
    }

    public function closeEditForm(){
        $this->openEditEvent = null;
        $this->editEventId = null;
        $this->newSkills = [''];
        $this->event_name = null;
        $this->organizer_sponsor = null;
        $this->start = null;
        $this->end = null;
    }

    public function deleteDialog($eventId){
        $this->deleteEventId = $eventId;
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteEventId = null;
        $this->newSkills = [''];
        $this->disableButton = "No";
        $this->event_name = null;
        $this->organizer_sponsor = null;
        $this->start = null;
        $this->end = null;
    }

    public function deleteEvent(){
        if($this->deleteEventId){
            $event = IpEvents::find($this->deleteEventId);
            if ($event){
                $event->delete();
                $this->deleteMessage = 'Category and skills deleted successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Category and skills deletion unsuccessfully.';
                $this->disableButton = "Yes";
            }
        }
    }

    public function openJoinRequests($eventId){
        $this->openJoinRequestsTable = true;
        $this->joinEventId = $eventId;
    }

    public function closeJoinRequests(){
        $this->openJoinRequestsTable = null;
        $this->joinEventId = null;
    }

    public function joinEvent($eventId){
        $userId = Auth::user()->id;
        $event = IpEvents::find($eventId);

        if ($event) {
            $joinRequests = explode(',', $event->join_requests);
            if (!in_array($userId, $joinRequests)) {
                $joinRequests[] = $userId;
                $event->join_requests = implode(',', $joinRequests);
                $event->save();
            }
        }
    }

    public function approveParticipant($userId){
        $user = User::find($userId);
        $event = IpEvents::find($this->joinEventId);
        if($event && $user){
            // Remove user ID from join_requests column
            $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                return trim($value) !== (string) $userId;
            });
            $event->join_requests = implode(',', array_filter($joinRequests));

            // Add user ID to participants column
            $participants = explode(',', $event->participants);
            if (!in_array($userId, $participants)) {
                $participants[] = $userId;
                $event->participants = implode(',', $participants);
            }

            $event->save();

            $this->openJoinRequestsTable = null;
            $this->joinEventId = null;
            $this->popup_message = null;
            $this->thisUserDetails = null;
            $this->popup_message = "Participant approved successfully.";
        }
    }

    public function disapproveParticipant($userId){
        $user = User::find($userId);
        $event = IpEvents::find($this->joinEventId);
        if($event == null){
            $event = IpEvents::find($this->eventId);
        }

        if($event && $user){
            // Remove user ID from join_requests column
            $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                return trim($value) !== (string) $userId;
            });
            $event->join_requests = implode(',', array_filter($joinRequests));

            // Remove user ID from participants column
            $thisParticipants = array_filter(explode(',', $event->participants), function ($value) use ($userId) {
                return trim($value) !== (string) $userId;
            });
            $event->participants = implode(',', array_filter($thisParticipants));

            // Add user ID to disapproved column
            $participants = explode(',', $event->disapproved);
            if (!in_array($userId, $participants)) {
                $participants[] = $userId;
                $event->disapproved = implode(',', $participants);
            }

            $event->save();

            $this->openJoinRequestsTable = null;
            $this->joinEventId = null;
            $this->popup_message = null;
            $this->thisUserDetails = null;
            $this->popup_message = "Participant disapproved successfully.";
        }
    }

    public function showParticipantDetails($userId, $eventId){
        $user = User::find($userId);
        $event = IpEvents::find($eventId);
        if($user){
            if($event){
                $this->eventId = $eventId;
                $participantIds = explode(',', $event->participants);
                $this->isParticipant = in_array($userId, $participantIds);
            }
            
            $this->thisUserDetails = User::where('users.id', $userId)
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('users.email', 'users.active_status', 'user_data.*')
                ->first();
            $this->thisUserDetails = $this->thisUserDetails->getAttributes();
        }
    }

    public function hideUserData(){
        $this->thisUserDetails = null;
        $this->eventId = null;
    }

    public function toggleOptions($eventId){
        if($this->options){
            $this->options = null;
        }else{
            $this->options = $eventId;
        }
    }

    public function toggleJoinStatus($eventId){
        $event = IpEvents::find($eventId);
        if($event){
            $event->update([
                'join_status' => !$event->join_status,
                'join_requests' => '',
            ]);

            $this->popup_message = null;
            $this->options = null;
            $this->popup_message = "Event join status updated successfully.";
        }
    }
}
