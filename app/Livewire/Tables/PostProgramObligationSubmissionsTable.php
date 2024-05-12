<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IpPostProgramObligation;
use App\Models\IpEvents;
use App\Models\User;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PostProgramObligationSubmissionsTable extends Component
{
    use WithPagination;
    public $search;
    public $popup_message;
    public $eventId;
    public $filterBy = 'start';
    public $selectedDate;

    public function mount(){
        $this->eventId = request()->query('event_id');
    }

    public function render(){
        if($this->eventId){
            $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
                                ->where('ip_events.id', $this->eventId)
                                ->select('users.name', 'ip_events.*')
                                ->when($this->selectedDate, function ($query) {
                                    $dateColumn = ($this->filterBy == 'start') ? 'start' : 'end';
                                    $startDate = Carbon::parse($this->selectedDate)->startOfMonth();
                                    $endDate = Carbon::parse($this->selectedDate)->endOfMonth();
                                    return $query->whereBetween($dateColumn, [$startDate, $endDate]);
                                })
                                ->search(trim($this->search))
                                ->orderBy('ip_events.created_at', 'desc')
                                ->paginate(10);
        }else{
            $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
                        ->select('users.name', 'ip_events.*')
                        ->search(trim($this->search))
                        ->when($this->selectedDate, function ($query) {
                            $dateColumn = ($this->filterBy == 'start') ? 'start' : 'end';
                            $startDate = Carbon::parse($this->selectedDate)->startOfMonth();
                            $endDate = Carbon::parse($this->selectedDate)->endOfMonth();
                            return $query->whereBetween($dateColumn, [$startDate, $endDate]);
                        })
                        ->orderBy('ip_events.created_at', 'desc')
                        ->paginate(10);
        }

        $ipEvents->transform(function ($event) {
            $participantIds = explode(',', $event->participants);

            $participantsData = [];

            foreach($participantIds as $userId){
                $ppo = IpPostProgramObligation::where('user_id', $userId)
                                                ->where('event_id', $event->id)
                                                ->first();
                $user = User::where('id', $userId)->first();
                if($user){
                    if($ppo){
                        $participantsData[] = [
                            'name' => $user->name,
                            'files_link' => $ppo->files_link,
                            'post_program_eval_report' => $ppo->post_program_eval_report,
                            'policy_brief' => $ppo->policy_brief,
                            'group_terminal_report' => $ppo->group_terminal_report,
                            'volunteer_work' => $ppo->volunteer_work,
                            'advocacy_plan' => $ppo->advocacy_plan,
                        ];
                    }else{                 
                        $participantsData[] = [
                            'name' => $user->name,
                            'files_link' => '',
                            'post_program_eval_report' => '',
                            'policy_brief' => '',
                            'group_terminal_report' => '',
                            'volunteer_work' => '',
                            'advocacy_plan' => '',
                        ];
                    }
                }
            }
    
            $event->participantsData = $participantsData;
            $event->start = Carbon::parse($event->start)->format('d F, Y');
            $event->end = Carbon::parse($event->end)->subDay()->format('d F, Y');

            return $event;
        });

        return view('livewire.tables.post-program-obligation-submissions-table', compact('ipEvents'));
    }

    public function resetDateFilter(){
        $this->selectedDate = null;
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
