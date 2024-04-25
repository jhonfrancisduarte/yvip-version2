<?php

namespace App\Livewire\Tables;

use Illuminate\Support\Facades\Auth;
use App\Models\PastIpEvent;
use Livewire\Component;

class PastIpParticipatedEventsTable extends Component
{
    public $openAddEvent = false;
    public $eventName;
    public $organizerSponsor;
    public $sponsorCategory;
    public $dateStart;
    public $dateEnd;
    public $editEventId;
    public $deleteEventId;
    public $confirmingDelete = false; // Add this property to control the delete confirmation modal

    protected $listeners = ['deleteEventConfirmed'];

    public function render()
    {
        $pastIpEvents = PastIpEvent::all();

        return view('livewire.tables.past-ip-participated-events-table', [
            'pastIpEvents' => $pastIpEvents,
        ]);
    }

    public function openAddEventModal()
    {
        $this->editEventId = null; // Reset editEventId when opening the modal to ensure it's treated as adding a new event
        $this->openAddEvent = true;
    }

    public function closeAddEventModal()
    {
        $this->openAddEvent = false;
        $this->resetForm();
    }

    public function saveEvent()
    {
        // Validate the form fields with custom error messages
        $this->validate([
            'eventName' => 'required|string|max:255', // Added max length validation
            'organizerSponsor' => 'required|string|max:255', // Added max length validation
            'sponsorCategory' => 'required|string', // Added string validation
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date|after_or_equal:dateStart',
        ], [
            'eventName.required' => 'The event name is required.',
            'organizerSponsor.required' => 'The organizer/sponsor is required.',
            'sponsorCategory.required' => 'The sponsor category is required.',
            'dateEnd.after_or_equal' => 'The end date must be after or equal to the start date.'
        ]);

        // Save or update the event based on whether editEventId is set
        if ($this->editEventId) {
            $this->updateEvent();
        } else {
            $this->createEvent();
        }
    }

    public function editEvent($eventId)
    {
        $this->editEventId = $eventId;
        // Fetch the event data and set it to the form fields for editing
        $event = PastIpEvent::findOrFail($eventId);
        $this->eventName = $event->event_name;
        $this->organizerSponsor = $event->organizer_sponsor;
        $this->sponsorCategory = $event->sponsor_category;
        $this->dateStart = $event->start;
        $this->dateEnd = $event->end;
        // Open the modal for editing
        $this->openAddEvent = true;
    }

    public function deleteEvent($eventId)
    {
        $this->deleteEventId = $eventId;
        // Set a flag to confirm deletion
        $this->confirmingDelete = true;
    }

    public function confirmDelete()
    {
        // Delete the event
        if ($this->deleteEventId) {
            PastIpEvent::findOrFail($this->deleteEventId)->delete();
            $this->deleteEventId = null;
        }
        // Reset the flag to hide the confirmation modal
        $this->confirmingDelete = false;
    }

    private function createEvent()
    {
        // Save the event to the database
        PastIpEvent::create([
            'user_id' => Auth::id(), // Use Auth::id() to get the authenticated user's ID
            'event_name' => $this->eventName,
            'organizer_sponsor' => $this->organizerSponsor,
            'sponsor_category' => $this->sponsorCategory,
            'start' => $this->dateStart,
            'end' => $this->dateEnd,
        ]);

        // Close the modal after saving
        $this->openAddEvent = false;

        // Reset form fields
        $this->resetForm();
    }

    private function updateEvent()
    {
        // Update the event in the database
        if ($this->editEventId) {
            $event = PastIpEvent::findOrFail($this->editEventId);
            $event->update([
                'event_name' => $this->eventName,
                'organizer_sponsor' => $this->organizerSponsor,
                'sponsor_category' => $this->sponsorCategory,
                'start' => $this->dateStart,
                'end' => $this->dateEnd,
            ]);
            // Close the modal after updating
            $this->openAddEvent = false;

            // Reset form fields
            $this->resetForm();
        }
    }

    private function resetForm()
    {
        // Reset form fields
        $this->reset(['eventName', 'organizerSponsor', 'sponsorCategory', 'dateStart', 'dateEnd']);
    }
}
