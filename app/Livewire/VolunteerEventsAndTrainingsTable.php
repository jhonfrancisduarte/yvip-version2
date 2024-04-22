<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;

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

    public function render()
    {
        $tags = ['Support', 'Logistics', 'Management', 'Highly Technical'];

        return view('livewire.volunteer-events-and-trainings-table', [
            'tags' => $tags,
        ]);
    }

    public function create()
    { 
        $event = VolunteerEventsAndTrainings::create([
            'event_type' => $this->eventType,
            'event_name' => $this->eventName,
            'organizer_facilitator' => $this->organizer,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'volunteer_hours' => $this->volunteerHours,
            'volunteer_category' => $this->volunteerCategory
        ]);
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
        $this->showForm = true;
    }

    public function closeEventForm(){
        $this->showForm = null;
    }

}
