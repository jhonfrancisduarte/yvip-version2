<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IpPostProgramObligation;
use App\Models\IpEvents;
use Exception;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostProgramObligationTable extends Component
{
    use WithFileUploads, WithPagination;
    public $search;
    public $popup_message;
    public $files;
    public $link;
    public $thisPpoId;

    protected $rules = [
        'files.*' => 'required|file|max:10240',
        'link' => 'required|min:2',
    ];

    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->paginate(10);

        $ipEvents->transform(function ($event) {
            $participantIds = explode(',', $event->participants);
            $userId = auth()->user()->id;

            $event->approved = in_array($userId, $participantIds);
            $event->start = Carbon::parse($event->start)->format('d F, Y');
            $event->end = Carbon::parse($event->end)->subDay()->format('d F, Y');

            return $event;
        });

        $userId = auth()->user()->id;
        $ppoFiles = IpPostProgramObligation::where('user_id', $userId)->get();

        return view('livewire.tables.post-program-obligation-table',  compact('ipEvents', 'ppoFiles'));
    }

    public function uploadPostProgramObligation($eventId){
        try{
            $this->thisPpoId = $eventId;
            $userId = Auth::user()->id;
            $event = IpEvents::find($eventId);
            if($userId && $event){


                $ppos = [];

                foreach ($this->files as $file) {
                    $ppo = IpPostProgramObligation::create([
                        'event_id' => $event->id,
                        'user_id' => $userId,
                        'file_paths' => '',
                        'file_links' => '',
                    ]);

                    $filePath = $file->storeAs('postProgramObligations', $file->getClientOriginalName(), 'public_uploads');
                    $filePath = "uploads/" . $filePath;
                    $ppo->update(['file_paths' => $filePath]);

                    $ppos[] = $ppo;
                }

                $this->popup_message = null;
                $this->popup_message = "Files uploaded successfully.";
                $this->thisPpoId = null;
                $this->files = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deleteFile($fileId)
    {
        $file = IpPostProgramObligation::find($fileId);
        if ($file) {

            if (file_exists(public_path($file->file_paths))) {
                unlink(public_path($file->file_paths));
            }

            $file->delete();
            $this->popup_message = "File deleted successfully.";
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }
}
