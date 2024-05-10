<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IpPostProgramObligation;
use App\Models\IpEvents;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostProgramObligationSubmissionsTable extends Component
{
    use WithPagination;
    public $search;
    public $popup_message;

    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
                    ->select('users.name', 'ip_events.*')
                    ->search(trim($this->search))
                    ->orderBy('ip_events.created_at', 'desc')
                    ->paginate(10);

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
}
