<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event; // Import the Event model

class MyParticipations extends Component
{
    public $events;

    public function mount()
    {
        // Fetch all events from the Event model
        $this->events = Event::all();
    }

    public function render()
    {
        return view('livewire.my-participations');
    }
}