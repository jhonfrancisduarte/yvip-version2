<?php

namespace App\Livewire;

use App\Models\Categories;
use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;
use App\Models\User;
use Illuminate\Validation\Rule;
use Exception;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class VolunteerEventsAndTrainingsTable extends Component
{
    use WithPagination;
    public $eventType;

    public $eventName;

    public $organizer;

    public $startDate;

    public $endDate;

    public $volunteerHours;

    public $selectedTags = [];

    public $showForm;
    public $showTags = false;
    public $createdEvent;
    public $thisUserDetails;
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

    public $disapproved = false;

    public $eventStatus;
    public $participant;
    public $isParticipant;
    public $joinRequests;
    public $endDateMin;
    public $selectedStatus;
    public $category;
    public $participants = [];
    public $volunteerEvent;
    public $options2;
    public $filterBy = 'start';
    public $selectedDate;
    public $search;

    protected $listeners = ['updateEndDateMin' => 'setEndDateMin'];

    protected $rules = [
        'eventType' => 'required',
        'eventName' => 'required|min:2',
        'organizer' => 'required|min:2',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'volunteerHours' => 'required|integer',
        'selectedTags' => 'required|array',
    ];

    public function render(){
        $categories = Categories::all();

        $events = VolunteerEventsAndTrainings::orderBy('created_at', 'desc')
                ->search(trim($this->search))
                ->when($this->selectedStatus, function ($query) {
                    return $query->where('status', $this->selectedStatus);
                })
                ->when($this->selectedDate, function ($query) {
                    $dateColumn = ($this->filterBy == 'start') ? 'start_date' : 'end_date';
                    $startDate = Carbon::parse($this->selectedDate)->startOfMonth();
                    $endDate = Carbon::parse($this->selectedDate)->endOfMonth();
                    return $query->whereBetween($dateColumn, [$startDate, $endDate]);
                })
                ->paginate(10);

        $this->joinRequestsData = $this->fetchJoinRequestsData();

        return view('livewire.volunteer-events-and-trainings-table', [
            'events' => $events,
            'categories' => $categories,
        ]);
    }

    public function resetDateFilter(){
        $this->selectedDate = null;
    }

    public function create(){
        try{
            $this->validate();
            $userId = Auth::user()->id;
            $currentDate = now();
            $status = '';
            if ($currentDate >= $this->startDate && $currentDate <= $this->endDate) {
                $status = 'Ongoing';
            } elseif ($currentDate > $this->endDate) {
                $status = 'Completed';
            } else {
                $status = 'Upcoming';
            }

            $event = VolunteerEventsAndTrainings::create([
                'user_id' => $userId,
                'event_type' => $this->eventType,
                'event_name' => $this->eventName,
                'organizer_facilitator' => $this->organizer,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'status' => $status,
                'volunteer_hours' => $this->volunteerHours,
                'volunteer_category' => implode(', ', $this->selectedTags),
            ]);
    
            $this->popup_message = null;
            $this->popup_message = "Event added successfully.";
            $this->showForm = null;
            $this->options = null;
            $this->options2 = null;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function resetForm(){
        $this->eventType = null;
        $this->eventName = null;
        $this->organizer = null;
        $this->startDate = null;
        $this->endDate = null;
        $this->volunteerHours = null;
        $this->selectedTags = [];
    }

    public function addTag(){
        if ($this->category && !in_array($this->category, $this->selectedTags)) {
            $this->selectedTags[] = $this->category;
        }
    }

    public function removeTag($tag){
        $this->selectedTags = array_diff($this->selectedTags, [$tag]);
    }
    public function toggleSettings($eventId){
        if ($this->selectedEventId) {
            $this->selectedEventId = null;
        } else {
            $this->selectedEventId = $eventId;
        }
    }

    public function eventForm(){
        $this->showForm = true;
    }
  
    public function closeEventForm(){
        $this->showForm = null;
        $this->resetValidation();
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
            $this->selectedTags = explode(', ', $event->volunteer_category);
            $this->editEventId = $eventId;
        }
    }

    public function editEvent(){
        try{
            $userId = Auth::user()->id;
            $currentDate = now();
            $status = '';
            if ($currentDate >= $this->startDate && $currentDate <= $this->endDate) {
                $status = 'Ongoing';
            } elseif ($currentDate > $this->endDate) {
                $status = 'Completed';
            } else {
                $status = 'Upcoming';
            }

            $event = VolunteerEventsAndTrainings::find($this->editEventId);
            if ($event) {
                $event->update([
                    'event_type' => $this->eventType,
                    'event_name' => $this->eventName,
                    'organizer_facilitator' => $this->organizer,
                    'start_date' => $this->startDate,
                    'end_date' => $this->endDate,
                    'status' => $status,
                    'volunteer_hours' => $this->volunteerHours,
                    'volunteer_category' => implode(', ', $this->selectedTags),
                    'participant' => $this->participant,
                    'join_requests' => $this->joinRequests,
                    'disapproved' => $this->disapproved
                ]);
  
                $this->popup_message = "Event updated successfully.";
                $this->closeEditForm();
            }
        }catch(Exception $e){
            throw $e;
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
        $this->options = null;
        $this->options2 = null;
        $this->selectedEventId = null;
        $this->resetValidation();
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
        try{
            if($this->deleteEventId){
                $event = VolunteerEventsAndTrainings::find($this->deleteEventId);
                if ($event){
                    $event->delete();
                    $this->deleteMessage = 'Event deleted successfully.';
                    $this->disableButton = "Yes";
                }
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function openJoinRequests($eventId){
        $this->joinEventId = $eventId;

        $event = VolunteerEventsAndTrainings::find($eventId);
    
        if ($event) {
            $joinRequests = explode(',', $event->join_requests);
    
            $joinRequestsData = [];
    
            foreach ($joinRequests as $userId) {
                $user = User::find($userId);
    
                if ($user) {
                    $joinRequestsData[] = [
                        'user_id' => $user->id,
                        'name' => $user->name,
                    ];
                }
            }
    
            $this->joinRequestsData[$eventId] = $joinRequestsData;
        }
    
        $this->openJoinRequestsTable = true;
    }

    public function closeJoinRequests(){
        $this->openJoinRequestsTable = null;
        $this->joinEventId = null;
        $this->options = null;
    }

    public function joinEvent($eventId){
        try{
            $userId = Auth::user()->id;
            $event = VolunteerEventsAndTrainings::find($eventId);
    
            if ($event) {
                $participants = explode(',', $event->participants);
                $joinRequests = explode(',', $event->join_requests);
                $disapprovedParticipants = explode(',', $event->disapproved);
    
                if (in_array($userId, $participants)) {
                } elseif (in_array($userId, $disapprovedParticipants)) {
                    $this->disapproved = true;
                } else {
                    $joinRequests[] = $userId;
                    $event->join_requests = implode(',', $joinRequests);
                    $event->save();
                }
            }
            $this->dispatch('volunteer-request');
        }catch(Exception $e){
            throw $e;
        }
    } 

    private function fetchJoinRequestsData(){
        $events = VolunteerEventsAndTrainings::all();
        $joinRequestsData = [];

        foreach ($events as $event) {
            $joinRequests = explode(',', $event->join_requests);

            $eventJoinRequestsData = [];

            foreach ($joinRequests as $userId) {
                $user = User::find($userId);

                if ($user) {
                    $eventJoinRequestsData[] = [
                        'user_id' => $user->id,
                        'name' => $user->name,
                    ];
                }
            }

            $joinRequestsData[$event->id] = $eventJoinRequestsData;
        }

        return $joinRequestsData;
    }

    public function approveParticipant($userId){
        try{  
            $user = User::where('id', $userId)->first();
            $event = VolunteerEventsAndTrainings::find($this->joinEventId);
            if($event && $user){
    
                $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                    return trim($value) !== (string) $userId;
                });
                $event->join_requests = implode(',', array_filter($joinRequests));
    
                $participants = explode(',', $event->participants);
                if (!in_array($userId, $participants)) {
                    $participants[] = $userId;
                    $event->participants = implode(',', $participants);
                }
    
                $event->save();
    
                $this->openJoinRequestsTable = null;
                $this->joinEventId = null;
                $this->popup_message = null;
                $this->thisUserDetails = null;
                $this->options = null;
                $this->selectedEventId = null;
                $this->popup_message = "Participant approved successfully.";
                $this->dispatch('volunteer-request');
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function disapproveParticipant($userId){
        try{
            $user = User::where('id', $userId)->first();
            $event = VolunteerEventsAndTrainings::find($this->joinEventId);
            if($event == null){
                $event = VolunteerEventsAndTrainings::find($this->eventId);
            }
    
            if($event && $user){
                $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                    return trim($value) !== (string) $userId;
                });
                $event->join_requests = implode(',', array_filter($joinRequests));
    
                $thisParticipants = array_filter(explode(',', $event->participants), function ($value) use ($userId) {
                    return trim($value) !== (string) $userId;
                });
                $event->participants = implode(',', array_filter($thisParticipants));
    
                $participants = explode(',', $event->disapproved);
                if (!in_array($userId, $participants)) {
                    $participants[] = $userId;
                    $event->disapproved = implode(',', $participants);
                }
    
                $event->save();
    
                $this->openJoinRequestsTable = null;
                $this->joinEventId = null;
                $this->popup_message = null;
                $this->thisUserDetails = null;
                $this->options = null;
                $this->volunteerEvent = null;
                $this->selectedEventId = null;
                $this->popup_message = "Participant disapproved successfully.";
                $this->dispatch('volunteer-request');
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function toggleJoinStatus($eventId){
        $event = VolunteerEventsAndTrainings::find($eventId);

        if ($event) {
            $event->join_status = $event->join_status == 0 ? 1 : 0;
            $event->save();
            return redirect()->back()->with('message', 'Join status updated successfully.');
        }
    }    

    public function showParticipantDetails($userId, $eventId){
        try{
            $user = User::where('id', $userId)->first();
            $event = VolunteerEventsAndTrainings::find($eventId);
            if($user){
                if($event){
                    $this->eventId = $eventId;
                    $participantIds = explode(',', $event->participants);
                    $this->isParticipant = in_array($userId, $participantIds);
                }
                
                $this->thisUserDetails = User::where('users.id', $userId)
                    ->join('user_data', 'users.id', '=', 'user_data.user_id')
                    ->select('users.email', 'users.active_status', 'user_data.*')
                    ->first();
                $this->thisUserDetails = $this->thisUserDetails->getAttributes();
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function viewParticipants($eventId){
        $event = VolunteerEventsAndTrainings::find($eventId);
        $this->joinEventId = $event->id;
        if($event){
            $participantIds = explode(',', $event->participants);
            $participantsData = [];
            foreach ($participantIds as $participantId) {
                $participantId = trim($participantId);
    
                if (!empty($participantId)){
                    $user = User::find($participantId);
    
                    if ($user) {
                        $userData = $user->userData;
    
                        if ($userData) {
                            $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                            $participantsData[] = [
                                'id' => $participantId,
                                'name' => $name,
                            ];
                        }
                    }
                }
            }
            $this->volunteerEvent = $event;
            $this->isParticipant = true;
            $this->participants = $participantsData;
        }
    }
    
    public function closeParticipantsForm(){
        $this->volunteerEvent = null;
        $this->isParticipant = null;
        $this->participants = null;
        $this->selectedEventId = null;
    }

    public function hideUserData(){
        $this->thisUserDetails = null;
        $this->eventId = null;
        $this->options = null;
        $this->closeParticipantsForm();
    }

    public function changeStatus($eventId, $status){
        try{
            $event = VolunteerEventsAndTrainings::find($eventId);
            if($event){
                $event->update([
                    'status' => $status,
                ]);
    
                $this->popup_message = null;
                $this->popup_message = "Status updated successfully.";
                $this->options2 = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function toggleOptions2($eventId){
        if($this->options2){
            $this->options2 = null;
        }else{
            $this->options2 = $eventId;
        }
    }
}
