<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;
use Illuminate\Validation\Rule;

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


    protected $listeners = ['updateEndDateMin' => 'setEndDateMin'];

    public function render(){
        $events = VolunteerEventsAndTrainings::all();

        $tags = ['Support', 'Logistics', 'Management', 'Highly Technical'];

        return view('livewire.volunteer-events-and-trainings-table', [
            'events' => $events,
            'tags' => $tags,
        ]);
    }

    public function create(){ 
        $event = VolunteerEventsAndTrainings::create([
            'event_type' => $this->eventType,
            'event_name' => $this->eventName,
            'organizer_facilitator' => $this->organizer,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'volunteer_hours' => $this->volunteerHours,
            'volunteer_category' => implode(', ', $this->selectedTags),
            'event_status' => $this->eventStatus,
            'participant' => $this->participant,
            'join_requests' => $this->joinRequests,
            'disapproved' => $this->disapproved
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
        $this->eventStatus = null;
        $this->participant = null;
        $this->joinRequests = null;
        $this->disapproved = null;
    }

    public function toggleTag($tag){
        if (in_array($tag, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tag]);
        } else {
            $this->selectedTags[] = $tag;
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

    public function eventForm($userId){
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
            $this->eventStatus = $event->event_status;
            $this->participant = $event->participant;
            $this->joinRequests = $event->join_requests;
            $this->disapproved = $event->disapproved;
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
                    'event_status' => $this->evenStatus,
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
        $this->eventStatus = null;
        $this->participant = null;
        $this->joinRequests = null;
        $this->disapproved = null;
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
        $this->openJoinRequestsTable = true;
        $this->joinEventId = $eventId;
        $event = VolunteerEventsAndTrainings::find($eventId);

        if ($event) {
        $joinRequests = explode(',', $event->join_requests);

        $this->joinRequestsData = $joinRequests;
        }
    }

    public function closeJoinRequests(){
        $this->openJoinRequestsTable = false;
        $this->joinEventId = null;
        $this->joinRequestsData = [];
        $this->options = null;
    }

    public function joinEvent($eventId){
        $userId = Auth::user()->id;
        $event = VolunteerEventsAndTrainings::find($eventId);

        if ($event) {
            $joinRequests = explode(',', $event->join_requests);
            if (!in_array($userId, $joinRequests)) {
                $joinRequests[] = $userId;
                $event->join_requests = implode(',', $joinRequests);
                $event->save();
            }
        }
    }

    public function toggleJoinStatus($eventId){
        $event = VolunteerEventsAndTrainings::find($eventId);
        if($event){
            $event->update([
                'join_status' => !$event->join_status,
                'join_requests' => '',
            ]);

            $this->popup_message = null;
            $this->options = null;
            $this->popup_message = "Event Status Updated Successfully.";
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }
}
