<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\User;
use App\Models\IpPostProgramObligation;
use App\Models\IpEvents;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class PostProgramObligationTable extends Component
{
    use WithFileUploads;
    public $search;
    public $popup_message;
    public $file;
    public $link;
    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->get();
    
        $ipEvents->transform(function ($event) use (&$joinRequestsData) {
            $participantIds = explode(',', $event->participants);
            $userId = auth()->user()->id;

    
            $currentDate = now();
            if ($currentDate >= $event->start && $currentDate <= $event->end) {
                $event->status = 'Ongoing';
            } elseif ($currentDate > $event->end) {
                $event->status = 'Completed';
            } else {
                $event->status = 'Upcoming';
            }
    
            $event->approved = in_array($userId, $participantIds);

            return $event;
        });
        
        $userId = auth()->user()->id;
        $ppoFiles = IpPostProgramObligation::where('user_id', $userId)->get();

        return view('livewire.tables.post-program-obligation-table',  compact('ipEvents', 'ppoFiles'));
    }

    public function uploadPostProgramObligation($eventId){
        $userId = Auth::user()->id;
        $event = IpEvents::find($eventId);
        if($userId && $event){
            
            if($this->file && $this->link){
                $this->addError('chooseOne', 'Choose only 1 way of file submission.');
                return;
            }

            $ppo = IpPostProgramObligation::create([
                'event_id' => $event->id,
                'user_id' => $userId,
                'file_paths' => '',
                'file_links' => '',
            ]);


            if ($this->file) {
                $filePath = $this->file->storeAs('postProgramObligations', $this->file->getClientOriginalName(), 'public_uploads');
                $filePath = "uploads/" . $filePath;
                $ppo->update(['file_paths' => $filePath]);
            }

            if ($this->link) {
                $ppo->update(['file_links' => $this->link]);
            }

            $this->popup_message = null;
            $this->popup_message = "File uploaded successfully.";
        }
    }
}
