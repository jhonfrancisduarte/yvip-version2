<?php

namespace App\Livewire\Tables;

use Illuminate\Support\Facades\Auth;
use App\Models\PastIpEvent;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminIpValidation extends Component
{
    use WithPagination;

    public $openAddEvent = false;
    public $eventName;
    public $organizerSponsor;
    public $sponsorCategory;
    public $dateStart;
    public $dateEnd;
    public $editEventId;
    public $deleteEventId;
    public $confirmingDelete = false;
    public $userId;
    public $users;
    public $approvedEventId;

    protected $listeners = ['deleteEventConfirmed'];

    public function mount()
    {
        $this->users = User::where('user_role', 'yip')->get();
    }

    public function render()
    {
        $pastIpEvents = PastIpEvent::with('user')->paginate(5);

        return view('livewire.tables.admin-ip-validation', [
            'pastIpEvents' => $pastIpEvents,
        ]);
    }

    public function openAddEventModal()
    {
        $this->editEventId = null;
        $this->openAddEvent = true;

        // Reset validation errors
        $this->resetValidation();
    }

    public function closeAddEventModal()
    {
        $this->openAddEvent = false;
        $this->resetForm();
    }

    public function saveEvent()
    {
        $this->validate([
            'eventName' => 'required|string|max:255',
            'organizerSponsor' => 'required|string|max:255',
            'sponsorCategory' => 'required|string',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date|after_or_equal:dateStart',
        ], [
            'eventName.required' => 'The event name is required.',
            'organizerSponsor.required' => 'The organizer/sponsor is required.',
            'sponsorCategory.required' => 'The sponsor category is required.',
            'dateEnd.after_or_equal' => 'The end date must be after or equal to the start date.'
        ]);

        if ($this->editEventId) {
            $this->updateEvent();
        } else {
            $this->createEvent();
        }
    }

    public function editEvent($eventId)
    {
        $this->editEventId = $eventId;
        $event = PastIpEvent::findOrFail($eventId);
        $this->userId = $event->user_id;
        $this->eventName = $event->event_name;
        $this->organizerSponsor = $event->organizer_sponsor;
        $this->sponsorCategory = $event->sponsor_category;
        $this->dateStart = $event->start;
        $this->dateEnd = $event->end;
        $this->openAddEvent = true;
        $this->resetValidation();
    }

    public function deleteEvent($eventId)
    {
        $this->deleteEventId = $eventId;
        $this->confirmingDelete = true;
    }

    public function confirmDelete()
    {
        if ($this->deleteEventId) {
            PastIpEvent::findOrFail($this->deleteEventId)->delete();
            $this->deleteEventId = null;
        }
        $this->confirmingDelete = false;
    }

    public function approveEvent($eventId)
{
    $event = PastIpEvent::findOrFail($eventId);
    $event->confirmed = true; // Set the 'confirmed' field to true
    $event->save(); // Save the changes to the database

    // Flash a success message
    session()->flash('message', 'Event approved successfully!');
}


    private function createEvent()
    {
        PastIpEvent::create([
            'user_id' => $this->userId,
            'event_name' => $this->eventName,
            'organizer_sponsor' => $this->organizerSponsor,
            'sponsor_category' => $this->sponsorCategory,
            'start' => $this->dateStart,
            'end' => $this->dateEnd,
        ]);

        $this->openAddEvent = false;
        $this->resetForm();
    }

    private function updateEvent()
    {
        if ($this->editEventId) {
            $event = PastIpEvent::findOrFail($this->editEventId);
            $event->update([
                'user_id' => $this->userId,
                'event_name' => $this->eventName,
                'organizer_sponsor' => $this->organizerSponsor,
                'sponsor_category' => $this->sponsorCategory,
                'start' => $this->dateStart,
                'end' => $this->dateEnd,
            ]);
            $this->openAddEvent = false;
            $this->resetForm();
        }
    }

    private function resetForm()
    {
        $this->reset(['eventName', 'organizerSponsor', 'sponsorCategory', 'dateStart', 'dateEnd', 'userId']);
    }
}
