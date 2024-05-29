<?php

namespace App\Livewire\Tables;

use Illuminate\Support\Facades\Auth;
use App\Models\PastIpEvent;
use App\Models\User;
use Carbon\Carbon;
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
    public $userName;
    public $users;
    public $approvedEventId;
    public $approveEventId;
    public $searchQuery; // Added for search functionality
    public $status = '';
    public $addedPastEventNames;
    public $event;
    public $category;
    public $filterBy = 'start';
    public $selectedDate;

    protected $listeners = ['deleteEventConfirmed'];

    public function mount()
    {
        $this->users = User::where('user_role', 'yip')->get();
        $pastEvents = PastIpEvent::all();
        $this->addedPastEventNames = $pastEvents->pluck('event_name');
    }

    public function render()
    {
        $query = PastIpEvent::leftJoin('users', 'past_ip_events.user_id', '=', 'users.id')
            ->select('past_ip_events.*', 'users.name as user_name')
            ->search(trim($this->searchQuery))
            ->when($this->status !== '', function ($query) {
                return $query->where('past_ip_events.confirmed', $this->status);
            })
            ->when($this->event, function ($query) {
                return $query->where('past_ip_events.event_name', $this->event);
            })
            ->when($this->category, function ($query) {
                return $query->where('past_ip_events.sponsor_category', $this->category);
            })
            ->when($this->selectedDate, function ($query) {
                $dateColumn = ($this->filterBy == 'start') ? 'start' : 'end';
                $startDate = Carbon::parse($this->selectedDate)->startOfMonth();
                $endDate = Carbon::parse($this->selectedDate)->endOfMonth();
                return $query->whereBetween($dateColumn, [$startDate, $endDate]);
            })
            ->orderByDesc('past_ip_events.created_at')
            ->paginate(10);

        return view('livewire.tables.admin-ip-validation', [
            'pastIpEvents' => $query,
        ]);

    }

    public function resetDateFilter(){
        $this->selectedDate = null;
    }


    public function openAddEventModal()
    {
        $this->editEventId = null;
        $this->openAddEvent = true;
        $this->resetValidation();
    }

    public function closeAddEventModal()
    {
        $this->openAddEvent = false;
        $this->resetForm();
    }

    public function openApproveEvent($eventId){
        $this->approveEventId = $eventId;
    }

    public function cancelApproval(){
        $this->approveEventId = null;
    }


    public function saveEvent()
    {
        $this->validate([
            'userId' => 'required', // Add validation for user ID
            'eventName' => 'required|string|max:255',
            'organizerSponsor' => 'required|string|max:255',
            'sponsorCategory' => 'required|string',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date|after_or_equal:dateStart',
        ], [
            'userId.required' => 'The user field is required.', // Custom error message for user ID
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
        $this->userName = User::where('id', $this->userId)->first();
        $this->userName = $this->userName->name;
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

    public function approveEvent(){
        $event = PastIpEvent::findOrFail($this->approveEventId);
        if($event){
            $event->confirmed = true;
            $event->save();
            session()->flash('message', 'Event approved successfully!');
    
            $this->dispatch('ip-validation-counter');
        }
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
            'confirmed' => true,
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

    public function search()
    {
        $this->resetPage(); // Reset pagination when performing a new search
        $this->render(); // Render the component to reflect the new search results
    }

}
