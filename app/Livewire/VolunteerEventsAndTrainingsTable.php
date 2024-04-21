<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VolunteerEventsAndTrainingsTable as VolunteerEvent;

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

    public $showForm = false;
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
    $validatedData = $this->validate([
        'eventType' => 'required',
        'eventName' => 'required|min:2',
        'organizer' => 'required|min:2',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'volunteerHours' => 'required|integer',
        'volunteerCategory' => 'required',
    ]);

    $event = new VolunteerEvent();
    $event->event_type = $validatedData['eventType'];
    $event->event_name = $validatedData['eventName'];
    $event->organizer_facilitator = $validatedData['organizer'];
    $event->start_date = Carbon::createFromFormat('Y-m-d', $validatedData['startDate']);
    $event->end_date = Carbon::createFromFormat('Y-m-d', $validatedData['endDate']);
    $event->volunteer_hours = $validatedData['volunteerHours'];
    $event->volunteer_category = $validatedData['volunteerCategory'];
    $event->save();

    session()->flash('message', 'Posted Successfully!');

    $this->dispatchBrowserEvent('close-modal');
    $this->reset(['eventType', 'eventName', 'organizer', 'startDate', 'endDate', 'volunteerHours', 'volunteerCategory', 'selectedTags']);
    $this->emit('eventAdded');
    $this->emit('modalClosed');
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

}
