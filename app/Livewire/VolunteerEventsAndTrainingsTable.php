<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;
use App\Models\User;
use Illuminate\Validation\Rule;
use Exception;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class VolunteerEventsAndTrainingsTable extends Component
{
    #[Rule('required')]
    public $eventType;

    #[Rule('required|min:2')]
    public $eventName;

    #[Rule('required|min:2')]
    public $organizer;

    #[Rule('required|date')]
    public $startDate;

    #[Rule('required|date')]
    public $endDate;

    #[Rule('required|integer')]
    public $volunteerHours;

    #[Rule('required')]
    public $volunteerCategory;

    #[Rule('required')]
    public $selectedTags = [];

    public $showForm;
    public $showTags = false;
    public $createdEvent;

    public $popup_message;

    public $insideSettingsButtonsShow = false;

    public $showEditDeleteButtons = false;

    public $selectedEventId;

    public $eventId;

    public $openEditEvent = false;
    public $editEventId;

    public $deleteEventId;
    public $deleteMessage;
    public $disableButton = "No";

    public $options;

    public $openJoinRequestsTable = false;
    public $joinRequestsData = [];
    public $joinEventId = null;

    public $disapproved = false;

    public $eventStatus;
    public $participant;
    public $joinRequests;

    public $selectedStatus;

    public $search = '';

    protected $listeners = ['updateEndDateMin' => 'setEndDateMin'];

    public function render(){
        $query = VolunteerEventsAndTrainings::query();

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        $events = VolunteerEventsAndTrainings::all();

        $tags = ['Support', 'Logistics', 'Management', 'Highly Technical'];

        return view('livewire.volunteer-events-and-trainings-table', [
            'events' => $events,
            'tags' => $tags,
        ]);
    }

    public function create(){ 
        $userId = Auth::user()->id;
        $event = VolunteerEventsAndTrainings::create([
            'user_id' => $userId,
            'event_type' => $this->eventType,
            'event_name' => $this->eventName,
            'organizer_facilitator' => $this->organizer,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'volunteer_hours' => $this->volunteerHours,
            'volunteer_category' => implode(', ', $this->selectedTags),
        ]);

        $this->popup_message = null;
        $this->popup_message = "Event added successfully.";

        $this->createdEvent = $event;
        $this->resetForm();
    }

    public function resetForm(){
        $this->eventType = null;
        $this->eventName = null;
        $this->organizer = null;
        $this->startDate = null;
        $this->endDate = null;
        $this->volunteerHours = null;
        $this->selectedTags = [];
    }

    public function toggleTag($tag){
        if (!in_array($tag, $this->selectedTags)) {
            $this->selectedTags[] = $tag;
        } else {
            $key = array_search($tag, $this->selectedTags);
            unset($this->selectedTags[$key]);
        }
        $this->volunteerCategory = implode(', ', $this->selectedTags);
    }
    
    public function toggleSettings($eventId){
        if ($this->selectedEventId === $eventId) {
            $this->showEditDeleteButtons = !$this->showEditDeleteButtons;
        } else {
            $this->selectedEventId = $eventId;
            $this->showEditDeleteButtons = true;
        }
    }

    public function eventForm(){
        $this->showForm = true;
    }
  
    public function closeEventForm(){
        $this->showForm = null;
    }

    public function setEndDateMin($startDate){
        $this->endDate = null;
        $this->endDateMin = $startDate;
    }
    
    public function openEditForm($eventId){
        $this->openEditEvent = true;
        $event = VolunteerEventsAndTrainings::find($eventId);
        if($event){
            $this->eventType = $event->event_type;
            $this->eventName = $event->event_name;
            $this->organizer = $event->organizer_facilitator;
            $this->startDate = $event->start_date;
            $this->endDate = $event->end_date;
            $this->volunteerHours = $event->volunteer_hours;
            $this->volunteerCategory = $event->volunteer_category;
            $this->selectedTags = explode(', ', $event->volunteer_category);
            $this->editEventId = $eventId;
            
        }
    }

    public function editEvent(){
            $userId = Auth::user()->id;
            $event = VolunteerEventsAndTrainings::find($this->editEventId);
            if ($event) {
                $event->update([
                    'event_type' => $this->eventType,
                    'event_name' => $this->eventName,
                    'organizer_facilitator' => $this->organizer,
                    'start_date' => $this->startDate,
                    'end_date' => $this->endDate,
                    'volunteer_hours' => $this->volunteerHours,
                    'volunteer_category' => implode(', ', $this->selectedTags),
                    'participant' => $this->participant,
                    'join_requests' => $this->joinRequests,
                    'disapproved' => $this->disapproved
                ]);
  
                $this->popup_message = "Event updated successfully.";
                $this->closeEditForm();
            }
        
    }
    
    public function closeEditForm(){
        $this->openEditEvent = null;
        $this->editEventId = null;
        $this->selectedTags = [];
        $this->eventType = null;
        $this->eventName = null;
        $this->organizer = null;
        $this->startDate = null;
        $this->endDate = null;
        $this->volunteerHours = null;
    }
    
    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteEventId = null;
        $this->selectedTags = [];
        $this->disableButton = "No";
        $this->eventType = null;
        $this->eventName = null;
        $this->organizer = null;
        $this->startDate = null;
        $this->endDate = null;
    }

    public function deleteDialog($eventId){
        $this->deleteEventId = $eventId;
    }
    
    public function deleteEvent(){
        if($this->deleteEventId){
            $event = VolunteerEventsAndTrainings::find($this->deleteEventId);
            if ($event){
                $event->delete();
                $this->deleteMessage = 'Event deleted successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Event deletion unsuccessful.';
                $this->disableButton = "Yes";
            }
        }
    }

    public function openJoinRequests($eventId){
        $this->joinEventId = $eventId;

        $event = VolunteerEventsAndTrainings::find($eventId);
    
        if ($event) {
            $joinRequests = explode(',', $event->join_requests);
    
            $joinRequestsData = [];
    
            foreach ($joinRequests as $userId) {
                $user = User::find($userId);
    
                if ($user) {
                    $joinRequestsData[] = [
                        'user_id' => $user->id,
                        'name' => $user->name,
                    ];
                }
            }
    
            $this->joinRequestsData[$eventId] = $joinRequestsData;
        }
    
        $this->openJoinRequestsTable = true;
    }

    public function closeJoinRequests(){
        $this->openJoinRequestsTable = null;
        $this->joinEventId = null;
        $this->options = null;
    }

    public function joinEvent($eventId){
        $userId = Auth::user()->id;
        $event = VolunteerEventsAndTrainings::find($eventId);

        if ($event) {
            $participants = explode(',', $event->participants);
            $joinRequests = explode(',', $event->join_requests);
            $disapprovedParticipants = explode(',', $event->disapproved);

            if (in_array($userId, $participants)) {
            } elseif (in_array($userId, $disapprovedParticipants)) {
                $this->disapproved = true;
            } else {
                $joinRequests[] = $userId;
                $event->join_requests = implode(',', $joinRequests);
                $event->save();
            }
        }
    } 

    public function mount(){
        $this->joinRequestsData = $this->fetchJoinRequestsData();
    }

    private function fetchJoinRequestsData(){
        $events = VolunteerEventsAndTrainings::all();
        $joinRequestsData = [];

        foreach ($events as $event) {
            $joinRequests = explode(',', $event->join_requests);

            $eventJoinRequestsData = [];

            foreach ($joinRequests as $userId) {
                $user = User::find($userId);

                if ($user) {
                    $eventJoinRequestsData[] = [
                        'user_id' => $user->id,
                        'name' => $user->name,
                    ];
                }
            }

            $joinRequestsData[$event->id] = $eventJoinRequestsData;
        }

        return $joinRequestsData;
    }

    public function approveParticipant($userId){
        $user = User::find($userId);
        $event = VolunteerEventsAndTrainings::find($this->joinEventId);
        if($event && $user){

            $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                return trim($value) !== (string) $userId;
            });
            $event->join_requests = implode(',', array_filter($joinRequests));

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
            $this->options = null;
            $this->popup_message = "Participant approved successfully.";
        }
    }

    public function disapproveParticipant($userId){
        $user = User::find($userId);
        $event = VolunteerEventsAndTrainings::find($this->joinEventId);
        if($event == null){
            $event = VolunteerEventsAndTrainings::find($this->eventId);
        }

        if($event && $user){
            $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                return trim($value) !== (string) $userId;
            });
            $event->join_requests = implode(',', array_filter($joinRequests));

            $thisParticipants = array_filter(explode(',', $event->participants), function ($value) use ($userId) {
                return trim($value) !== (string) $userId;
            });
            $event->participants = implode(',', array_filter($thisParticipants));

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
            $this->options = null;
            $this->popup_message = "Participant disapproved successfully.";
        }
    }

    public function toggleJoinStatus($eventId){
        $event = VolunteerEventsAndTrainings::find($eventId);

        if ($event) {
            \Log::info('Current join_status: ' . $event->join_status);
    
            $event->join_status = $event->join_status == 0 ? 1 : 0;
            $event->save();
    
            \Log::info('Updated join_status: ' . $event->join_status);
    
            return redirect()->back()->with('message', 'Join status updated successfully.');
        }
    }    

    public function showParticipantDetails($userId, $eventId){
        $user = User::find($userId);
        $event = VolunteerEventsAndTrainings::find($eventId);
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

    public function closePopup(){
        $this->popup_message = null;
    }

    public function filterEvents(){
        $search = $this->search;

        $this->events = $this->events->filter(function ($event) use ($search) {
            return Str::contains($event->event_name, $search) ||
                Str::contains($event->organizer_facilitator, $search) ||
                Str::contains($event->event_type, $search);
        });
    }
}
