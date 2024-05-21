<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\RewardClaim;
use Livewire\Component;
use App\Models\VolunteerEventsAndTrainings;
use App\Models\User;
use App\Models\VolunteerExperience;
use App\Models\VolunteerHours;
use Exception;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
    
    public $volunteerExperiences;
    public $groupedSkills;
    public $hours = [];
    public $advocacyPlans = [];
    public $type;
    public $hoursUngrantedParticipants = [];


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

        $events->transform(function ($event) {
            $event->start_date = Carbon::parse($event->start_date)->format('d F, Y');
            $event->end_date = Carbon::parse($event->end_date)->subDay()->format('d F, Y');

            return $event;
        });

        $this->joinRequestsData = $this->fetchJoinRequestsData();

        $this->getHoursUngrantedParticipants();

        return view('livewire.volunteer-events-and-trainings-table', [
            'events' => $events,
            'categories' => $categories,
        ]);
    }

    public function getHoursUngrantedParticipants(){
        try{
            $events = VolunteerEventsAndTrainings::all();
            foreach ($events as $event) {
                if($event->status === 'Completed'){
                    $participantIds = array_map('trim', explode(',', $event->participants));
                    $participants = explode(',', $event->participants);
                    $totalParticipants = count($participants) - 1;
                    $volunteerHours = VolunteerHours::where('event_id', $event->id)
                                                    ->whereIn('user_id', $participantIds)
                                                    ->get();
        
                    // Get the participant IDs that have volunteer hours
                    $participantsWithHours = $volunteerHours->pluck('user_id')->unique()->toArray();
        
                    // Count the participants without hours
                    if($totalParticipants > 0){
                        $unassignedParticipantsCount = $totalParticipants - count($participantsWithHours);
                        $this->hoursUngrantedParticipants[$event->id] = $unassignedParticipantsCount;
                    }else{
                        $unassignedParticipantsCount = 0;
                        $this->hoursUngrantedParticipants[$event->id] = $unassignedParticipantsCount;
                    }
                }else{
                    $this->hoursUngrantedParticipants[$event->id] = 0;
                }
            }
        }catch(Exception $e){
            throw $e;
        }
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
                        'name' => $user->userData->first_name . ' ' . $user->userData->middle_name . ' ' . $user->userData->last_name,
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
                $this->advocacyPlans = explode(', ',  $this->thisUserDetails->advocacy_plans);
                $this->thisUserDetails = $this->thisUserDetails->getAttributes();
                $this->getSkillsAndCategory($userId);
                $this->openJoinRequestsTable = null;
                $this->options = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function viewParticipants($eventId, $type){
        $this->type = $type;
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
                            $isGranted = null;
                            $hoursGranted = VolunteerHours::where('user_id', $participantId)
                                                      ->where('event_id', $eventId)
                                                      ->first();
                            if($hoursGranted){
                                $isGranted = $hoursGranted->volunteering_hours;
                            }
                            
                            $participantsData[] = [
                                'id' => $participantId,
                                'name' => $name,
                                'hoursGranted' => $isGranted,
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
    }

    public function changeStatus($eventId, $status){
        try {
            $event = VolunteerEventsAndTrainings::find($eventId);
            if ($event) {
                $event->update([
                    'status' => $status,
                ]);
    
                $this->popup_message = null;
                $this->popup_message = "Status updated successfully.";
                $this->options2 = null;
            }else{
                $this->popup_message = null;
                $this->popup_message = "Status update unsuccessfully.";
                $this->options2 = null;
            }
        } catch (Exception $e) {
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

    public function getSkillsAndCategory($userId){
        try{
            $user = User::where('id', $userId)->first();
            if($user){
                $this->volunteerExperiences = VolunteerExperience::where('user_id', $user->id)->get();
                $selectedSkillIds = Cache::get("user_{$userId}_selected_skill_ids", []);
                $selectedSkillsWithCategories = DB::table('all_skills')
                    ->whereIn('all_skills.id', $selectedSkillIds)
                    ->join('all_categories', 'all_skills.category_id', '=', 'all_categories.id')
                    ->select('all_skills.*', 'all_categories.all_categories_name')
                    ->get();

                $this->groupedSkills = $selectedSkillsWithCategories->groupBy('all_categories_name');
            }
        }catch(Exception $e){
            throw $e;        
        }
    }

    public function grantHours($userId, $eventId){
        try {
            $user = User::where('id', $userId)->first();
            $event = VolunteerEventsAndTrainings::find($eventId);
    
            if ($user) {
                $this->validate([
                    "hours.$userId" => 'required|numeric|min:1',
                ]);
    
                $submittedHours = $this->hours[$userId];
                if ($submittedHours > $event->volunteer_hours) {
                    $this->addError("hours.$userId", 'Invalid number of hours.');
                    return;
                }
    
                $rewardClaim = $user->rewardClaim;
                if ($rewardClaim) {
                    $totalHours = $rewardClaim->total_hours + $submittedHours;
                    $claimableHours = $totalHours - $rewardClaim->total_claimed_hours;
                    $rewardClaim->update([
                        'total_hours' => $totalHours,
                        'claimable_hours' => $claimableHours,
                    ]);
                } else {
                    RewardClaim::create([
                        'user_id' => $user->id,
                        'total_hours' => $submittedHours,
                        'claimable_hours' => $event->volunteer_hours,
                    ]);
                }
    
                VolunteerHours::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'volunteering_hours' => $submittedHours,
                ]);
    
                $this->resetValidation("hours.$userId");
                $this->reset("hours.$userId");

                $this->popup_message = "Status updated successfully.";
                $this->options2 = null;
                $this->viewParticipants($event->id, 'grant');
            } else {
                $this->popup_message = "Status update unsuccessfully.";
                $this->options2 = null;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function exportParticipantsList($eventId){
        try{
            $event = VolunteerEventsAndTrainings::find($eventId);
            if($event){
                $participantIds = explode(',', $event->participants);
                $participantData = [];
                foreach ($participantIds as $participantId) {
                    $participantId = trim($participantId);
        
                    if (!empty($participantId)){
                        $user = User::find($participantId);
        
                        if ($user) {
                            $userData = $user->userData;
        
                            if ($userData) {
                                $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                                $passportNumber = $userData->passport_number;  
                                
                                $participantData[] = [
                                    'name' => $name,
                                    'passport_number' => $passportNumber,
                                ];
                            }
                        }
                    }
                }

                $eventStart = Carbon::parse($event->start_date)->format('d F, Y');
                $eventEnd = Carbon::parse($event->end_date)->subDay()->format('d F, Y');
                $eventData = [
                    'event_name' => $event->event_name,
                    'event_type' => $event->event_type,
                    'organizer_facilitator' => $event->organizer_facilitator,
                    'hours' => $event->volunteer_hours,
                    'event_start' => $eventStart,
                    'event_end' => $eventEnd,
                    'participant_type' => "yv",
                ];
    
                $pdf = Pdf::loadView('pdf.participants-pdf', [
                    'participantData' => $participantData,
                    'eventData' => $eventData,
                ]);
                $pdf->setPaper('A4', 'portrait');
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, $event->event_name . '_participants.pdf');
            }
        }catch(Exception $e){
            throw $e;
        }
    }
    
}
