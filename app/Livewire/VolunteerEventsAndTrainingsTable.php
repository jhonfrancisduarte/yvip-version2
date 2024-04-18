<?php

namespace App\Livewire;

use Livewire\Component;

class VolunteerEventsAndTrainingsTable extends Component
{
    public $showForm = false;
    public $showTags = false;
    public $eventName;
    public $organizer;
    public $eventDate; // Change from $date to $eventDate
    public $volunteerHours; // Change from $volunteeringHours to $volunteerHours
    public $selectedTags = [];

    public function render()
    {
        return view('livewire.volunteer-events-and-trainings-table')
            ->with('showTags', $this->showTags)
            ->with('selectedTags', $this->selectedTags);
    }

    public function submitForm()
    {
        // Handle form submission logic here
        // For example, save data to the database
        // Then close the form and reset form fields
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
