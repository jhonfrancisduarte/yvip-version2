<?php

namespace App\Livewire\Tables;

use App\Models\IpEvents;
use App\Models\IpPostProgramObligation;
use Livewire\Component;
use App\Models\User;
use App\Models\VolunteerExperience;
use Exception;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class IpEventsTable extends Component
{
    use WithPagination;
    public $deleteSkillsandCategories;
    public $openEditEvent;
    public $openAddEvent;
    public $popup_message;
    public $editEventId;
    public $deleteCategoryId;
    public $search;
    public $event_name;
    public $organizer_sponsor;
    public $start;
    public $end;
    public $qualifications = [''];

    public $deleteMessage;
    public $disableButton = "No";
    public $deleteEventId;
    public $openJoinRequestsTable;
    public $joinEventId;
    public $thisUserDetails;
    public $isParticipant;
    public $eventId;
    public $options;
    public $options2;
    public $file;
    public $ppoSubmisions;
    public $status;
    public $filterBy = 'start';
    public $selectedDate;
    public $joinNotif = false;
    public $participants = [];
    public $ipEvent;
    public $volunteerExperiences;
    public $groupedSkills;
    public $advocacyPlans = [];

    protected $rules = [
        'event_name' => 'required|min:2',
        'organizer_sponsor' => 'required|min:2',
        'start' => 'required|date',
        'end' => 'required|date',
        'qualifications' => 'required|array',
    ];

    public function addQualification(){
        $this->qualifications[] = '';
    }

    public function removeQualification($index){
        unset($this->qualifications[$index]);
    }

    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->when($this->status, function ($query) {
                return $query->where('ip_events.status', $this->status);
            })
            ->when($this->selectedDate, function ($query) {
                $dateColumn = ($this->filterBy == 'start') ? 'start' : 'end';
                $startDate = Carbon::parse($this->selectedDate)->startOfMonth();
                $endDate = Carbon::parse($this->selectedDate)->endOfMonth();
                return $query->whereBetween($dateColumn, [$startDate, $endDate]);
            })
            ->paginate(10);

        $joinRequestsData = [];
        $ipEvents->transform(function ($event) use (&$joinRequestsData) {
            $participantIds = explode(',', $event->participants);
            $disapprovedIds = explode(',', $event->disapproved);
            $participantData = [];
            $userId = auth()->user()->id;

            foreach ($participantIds as $participantId) {
                $participantId = trim($participantId);

                if (!empty($participantId)) {
                    $user = User::find($participantId);
                    $userData = $user->userData;

                    if ($userData) {
                        $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                        $participantData[] = [
                            'user_id' => $participantId,
                            'name' => $name,
                        ];
                    }
                }
            }

            $joinRequests = explode(',', $event->join_requests);
            $joinRequestsData[$event->id] = [];
            foreach ($joinRequests as $joinRequest) {
                $joinRequest = trim($joinRequest);

                if (!empty($joinRequest)) {
                    $this->joinNotif = true;
                    $user = User::find($joinRequest);
                    $userData = $user->userData;

                    if ($userData) {
                        $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                        $joinRequestsData[$event->id][] = [
                            'user_id' => $joinRequest,
                            'name' => $name,
                        ];
                    }
                }
            }

            $event->participantData = $participantData;
            $event->qualifications = explode(',', $event->qualifications);
            $event->hasJoined = in_array($userId, $joinRequests);
            $event->approved = in_array($userId, $participantIds);
            $event->disapprovedParticipants = in_array($userId, $disapprovedIds);

            $event->start = Carbon::parse($event->start)->format('d F, Y');
            $event->end = Carbon::parse($event->end)->subDay()->format('d F, Y');

            return $event;
        });

        return view('livewire.tables.ip-events-table', compact('ipEvents', 'joinRequestsData'));
    }

    public function createEvent(){
        try{
            $userId = Auth::user()->id;
            $currentDate = now();
            $status = '';
            if ($currentDate >= $this->start && $currentDate <= $this->end) {
                $status = 'Ongoing';
            } elseif ($currentDate > $this->end) {
                $status = 'Completed';
            } else {
                $status = 'Upcoming';
            }
            $this->validate();
            $event = IpEvents::create([
                'user_id' => $userId,
                'event_name' => $this->event_name,
                'organizer_sponsor' => $this->organizer_sponsor,
                'start' => $this->start,
                'end' => $this->end,
                'status' => $status,
                'qualifications' => implode(', ', $this->qualifications),
            ]);

            $this->popup_message = null;
            $this->popup_message = "IP event added successfully.";
            $this->openAddEvent = null;
            $this->resetForm();
        }catch(Exception $e){
            throw $e;
        }
    }

    private function resetForm(){
        $this->reset(['event_name', 'organizer_sponsor', 'start', 'end', 'qualifications']);
    }

    public function editEvent(){
        try{
            $event = IpEvents::find($this->editEventId);
            $userId = Auth::user()->id;
            if($event){
                $currentDate = now();
                $status = '';
                if ($currentDate >= $this->start && $currentDate <= $this->end) {
                    $status = 'Ongoing';
                } elseif ($currentDate > $this->end) {
                    $status = 'Completed';
                } else {
                    $status = 'Upcoming';
                }
                $this->validate();
                $event->update([
                    'user_id' => $userId,
                    'event_name' => $this->event_name,
                    'organizer_sponsor' => $this->organizer_sponsor,
                    'start' => $this->start,
                    'end' => $this->end,
                    'status' => $status,
                    'qualifications' => implode(', ', $this->newSkills),
                ]);

                $this->openEditEvent= null;
                $this->editEventId = null;
                $this->popup_message = null;
                $this->options = null;
                $this->popup_message = "IP event updated successfully.";
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function closePopup(){
        $this->popup_message = null;
        $this->options = null;
    }

    public function openAddForm(){

        if (!$this->openAddEvent) {
            $this->openAddEvent = true;
        }
    }

    public function closeAddForm(){
        $this->openAddEvent = null;
        $this->options = null;
        $this->resetValidation();
    }

    public function changeStatus($eventId, $status){
        try{
            $event = IpEvents::find($eventId);
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

    public function resetDateFilter(){
        $this->selectedDate = null;
    }

    public function openEditForm($eventId){
        try{
            $this->openEditEvent = true;
            $event = IpEvents::find($eventId);
            if($event){
                $this->event_name = $event->event_name;
                $this->organizer_sponsor = $event->organizer_sponsor;
                $this->qualifications = is_string($event->qualifications) ? explode(',', $event->qualifications) : [];
                $this->start = $event->start;
                $this->end = $event->end;
                $this->editEventId = $eventId;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function closeEditForm(){
        $this->openEditEvent = null;
        $this->editEventId = null;
        $this->qualifications = [''];
        $this->event_name = null;
        $this->organizer_sponsor = null;
        $this->start = null;
        $this->options = null;
        $this->end = null;
        $this->resetValidation();
    }

    public function deleteDialog($eventId){
        $this->deleteEventId = $eventId;
    }

    public function hideDeleteDialog(){
        $this->disableButton = "No";
        $this->deleteEventId = null;
        $this->closeEditForm();
    }

    public function deleteEvent(){
        if($this->deleteEventId){
            $event = IpEvents::find($this->deleteEventId);
            if ($event){
                $event->delete();
                $this->deleteMessage = 'Event deleted successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Event deletion unsuccessfully.';
                $this->disableButton = "Yes";
            }
        }
    }

    public function openJoinRequests($eventId){
        $this->openJoinRequestsTable = true;
        $this->joinEventId = $eventId;
    }

    public function closeJoinRequests(){
        $this->openJoinRequestsTable = null;
        $this->joinEventId = null;
        $this->options = null;
    }

    public function joinEvent($eventId){
        $userId = Auth::user()->id;
        $event = IpEvents::find($eventId);

        if ($event) {
            $joinRequests = explode(',', $event->join_requests);
            if (!in_array($userId, $joinRequests)) {
                $joinRequests[] = $userId;
                $event->join_requests = implode(',', $joinRequests);
                $event->save();
            }
        }
    }

    public function approveParticipant($userId){
        try{
            $user = User::where('id', $userId)->first();
            $event = IpEvents::find($this->joinEventId);
            if($event && $user){
                // Remove user ID from join_requests column
                $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                    return trim($value) !== (string) $userId;
                });
                $event->join_requests = implode(',', array_filter($joinRequests));

                // Add user ID to participants column
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
                $this->popup_message = "Participant approved successfully.";
                $this->dispatch('volunteer-request');
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function disapproveParticipant($userId){
        try{
            $event = IpEvents::find($this->joinEventId);
            if($event == null){
                $event = IpEvents::find($this->eventId);
            }

            if($event){
                // Remove user ID from join_requests column
                $joinRequests = array_filter(explode(',', $event->join_requests), function ($value) use ($userId) {
                    return trim($value) !== (string) $userId;
                });
                $event->join_requests = implode(',', array_filter($joinRequests));

                // Remove user ID from participants column
                $thisParticipants = array_filter(explode(',', $event->participants), function ($value) use ($userId) {
                    return trim($value) !== (string) $userId;
                });
                $event->participants = implode(',', array_filter($thisParticipants));

                // Add user ID to disapproved column
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
                $this->ipEvent = null;
                $this->popup_message = "Participant disapproved successfully.";
                $this->dispatch('volunteer-request');
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function showParticipantDetails($userId, $eventId){
        try{
            $user = User::where('id', $userId)->first();
            $event = IpEvents::find($eventId);
            if($user){
                if($event){
                    $this->eventId = $eventId;
                    $participantIds = explode(',', $event->participants);
                    $this->isParticipant = in_array($userId, $participantIds);
                }

                $this->thisUserDetails = User::where('users.id', $user->id)
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

    public function hideUserData(){
        $this->thisUserDetails = null;
        $this->eventId = null;
        $this->options = null;
        $this->closeParticipantsForm();
        $this->openJoinRequests($this->joinEventId);
    }

    public function toggleOptions($eventId){
        if($this->options){
            $this->options = null;
        }else{
            $this->options = $eventId;
        }
    }

    public function toggleOptions2($eventId){
        if($this->options2){
            $this->options2 = null;
        }else{
            $this->options2 = $eventId;
        }
    }

    public function toggleJoinStatus($eventId){
        $event = IpEvents::find($eventId);
        if($event){
            $event->update([
                'join_status' => !$event->join_status,
                'join_requests' => '',
            ]);

            $this->popup_message = null;
            $this->options = null;
            $this->popup_message = "Event join status updated successfully.";
        }
    }

    public function openPpoSubmissions($eventId){
        try{
            return redirect()->to('/post-program-obligations?event_id=' . $eventId);
        }catch(Exception $e){
            throw $e;
        }
    }
    
    public function closeSubmissionsTable(){
        $this->ppoSubmisions = null;
        $this->options = null;
    }

    public function viewParticipants($eventId){
        $ipEvent = IpEvents::find($eventId);
        $this->joinEventId = $ipEvent->id;
        if($ipEvent){
            $participantIds = explode(',', $ipEvent->participants);
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
            $this->ipEvent = $ipEvent;
            $this->isParticipant = true;
            $this->participants = $participantsData;
        }
    }

    public function closeParticipantsForm(){
        $this->ipEvent = null;
        $this->isParticipant = null;
        $this->participants = null;
        $this->options = null;
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

    public function exportParticipantsList($eventId){
        try{
            $event = IpEvents::find($eventId);
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

                $eventStart = Carbon::parse($event->start)->format('d F, Y');
                $eventEnd = Carbon::parse($event->end)->subDay()->format('d F, Y');
                $eventData = [
                    'event_name' => $event->event_name,
                    'event_type' => null,
                    'organizer_facilitator' => $event->organizer_sponsor,
                    'hours' => null,
                    'event_start' => $eventStart,
                    'event_end' => $eventEnd,
                    'participant_type' => "ip",
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
