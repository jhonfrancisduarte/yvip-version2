<?php

namespace App\Livewire;

use Livewire\Component;

class VolunteerEventsAndTrainingsTable extends Component
{
    public $showForm = false;
    public $showTags = false;
    public $eventName;
    public $organizer;
    public $eventDate;
    public $volunteerHours;
    public $eventType;
    public $volunteerCategory;
    public $selectedTags = [];

    public function render()
    {
        return view('livewire.volunteer-events-and-trainings-table')
            ->with('showTags', $this->showTags)
            ->with('selectedTags', $this->selectedTags);
    }

    public function submitForm()
    {
        // Validate form input
        $validatedData = $this->validate([
            'eventType' => 'required',
            'eventName' => 'required',
            'organizer' => 'required',
            'eventDate' => 'required|date',
            'volunteerHours' => 'required|integer',
            'volunteerCategory' => 'required|array',
            // Add validation rules for other form fields as needed
        ]);
    
        // Save data to the database
        $event = new VolunteerEventsAndTrainings();
        $event->event_type = $this->eventType;
        $event->event_name = $this->eventName;
        $event->organizer_facilitator = $this->organizer;
        $event->event_date = $this->eventDate;
        $event->volunteer_hours = $this->volunteerHours;
        $event->volunteer_category = json_encode($this->volunteerCategory); // Convert selected categories to JSON
        // Add other fields as needed
        $event->save();
    
        // Close the form and reset form fields
        $this->resetForm();
    }    

    public function toggleTagsVisibility()
    {
        $this->showTags = !$this->showTags;
    }

    public function toggleTag($tag)
    {
        if (in_array($tag, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tag]);
        } else {
            $this->selectedTags[] = $tag;
        }
    }

    private function resetForm()
    {
        $this->eventName = '';
        $this->organizer = '';
        $this->eventDate = '';
        $this->volunteerHours = '';
        $this->selectedTags = [];
        $this->showForm = false;
    }
}
