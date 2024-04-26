<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;
use Illuminate\Validation\Rule;

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

    protected $listeners = ['updateEndDateMin' => 'setEndDateMin'];

    public function render()
    {
        $events = VolunteerEventsAndTrainings::all();

        $tags = ['Support', 'Logistics', 'Management', 'Highly Technical'];

        return view('livewire.volunteer-events-and-trainings-table', [
            'events' => $events,
            'tags' => $tags,
        ]);
    }

    public function create()
    { 
            dd($this->all());

            $event = VolunteerEventsAndTrainings::create([
                'event_type' => $this->eventType,
                'event_name' => $this->eventName,
                'organizer_facilitator' => $this->organizer,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'volunteer_hours' => $this->volunteerHours,
                'volunteer_category' => implode(', ', $this->selectedTags)
            ]);

            $this->popup_message = null;
            $this->popup_message = "Event added successfully.";

            $this->createdEvent = $event;
    }

    public function toggleTag($tag)
    {
        if (in_array($tag, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tag]);
        } else {
            $this->selectedTags[] = $tag;
        }
        $this->volunteerCategory = implode(', ', $this->selectedTags);
    }    

    public function eventForm($userId){
        $this->showForm = true;}
  
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
    
    public function deleteDialog($eventId){
        $this->deleteEventId = $eventId;
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

    public function toggleSettings($eventId)
    {
        if ($this->selectedEventId === $eventId) {
            $this->insideSettingsButtonsShow = !$this->insideSettingsButtonsShow;
        }else {
            $this->selectedEventId = $eventId;
            $this->insideSettingsButtonsShow = true;
        }
    }

    public function hideInsideSettingsButtons(){
        $this->insideSettingsButtonsShown = false;
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

    public function closePopup()
    {
        $this->popup_message = null;
    }
}
