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
    public $link;
    public $thisPpoId;
    public $file;
    public $file_for = [];
    public $isHasUploadedFile;
    public $hasFileLink;
    protected $rules = [
        'file' => 'required|file|max:10240',
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
        $this->isHasUploadedFile = $this->hasUploadedFile();
        $this->hasFileLink = $this->hasFilesLink();

        return view('livewire.tables.post-program-obligation-table',  compact('ipEvents', 'ppoFiles'));
    }

    public function uploadPostProgramObligation($eventId){
        try{
            $this->thisPpoId = $eventId;
            $userId = Auth::user()->id;
            $event = IpEvents::find($eventId);
            if($userId && $event){
                
                if($this->file && $this->link){
                    $this->addError("file_for.$event->id", 'Choose only 1 way of file submission.');
                    return;
                }

                if($this->link === null){
                    if(!$this->file_for){
                        $this->addError("file_for.$event->id", 'Please select an option in the dropdown!');
                        return;
                    }

                    $saveTo = '';
                    switch($this->file_for[$event->id]){
                        case "pper":
                            $saveTo = 'post_program_eval_report';
                            break;
                        case "pb":
                            $saveTo = 'policy_brief';
                            break;
                        case "gtr":
                            $saveTo = 'group_terminal_report';
                            break;
                        case "vw":
                            $saveTo = 'volunteer_work';
                            break;
                        case "ap":
                            $saveTo = 'advocacy_plan';
                            break;
                        default:
                            break;
                    }

                    $ppo = IpPostProgramObligation::where('user_id', $userId)
                                                ->where('event_id', $event->id)
                                                ->first();
                    if($ppo){
                        if ($this->file) {
                            $filePath = $this->file->storeAs('postProgramObligationFiles/' . $saveTo , $this->file->getClientOriginalName(), 'public_uploads');
                            $filePath = "uploads/" . $filePath;

                            $alreadySubmitted = $ppo->{$saveTo};
                            if(!$alreadySubmitted){
                                $ppo->update([
                                    $saveTo => $filePath,
                                ]);
                            }else{
                                $this->addError("file_for.$event->id", 'You already submitted a file for this Post-Program Obligation!');
                                return;
                            }
                        }
                    }else{
                        $ppo = IpPostProgramObligation::create([
                            'event_id' => $event->id,
                            'user_id' => $userId,
                            'post_program_eval_report' => '',
                            'policy_brief' => '',
                            'group_terminal_report' => '',
                            'volunteer_work' => '',
                            'advocacy_plan' => '',
                            'files_link' => '',
                        ]);

                        if ($this->file) {
                            $filePath = $this->file->storeAs('postProgramObligationFiles/' . $saveTo , $this->file->getClientOriginalName(), 'public_uploads');
                            $filePath = "uploads/" . $filePath;
                            $ppo->update([
                                $saveTo => $filePath,
                            ]);
                        }
                    } 
                }else{
                    $ppo = IpPostProgramObligation::create([
                        'event_id' => $event->id,
                        'user_id' => $userId,
                        'post_program_eval_report' => '',
                        'policy_brief' => '',
                        'group_terminal_report' => '',
                        'volunteer_work' => '',
                        'advocacy_plan' => '',
                        'files_link' => '',
                    ]);

                    if ($this->link) {
                        $ppo->update(['files_link' => $this->link]);
                    }
                }
           
                $this->popup_message = null;
                $this->popup_message = "File uploaded successfully.";
                $this->thisPpoId = null;
                $this->file = null;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function hasUploadedFile(){
        try{
            $userId = auth()->user()->id;
            $ppoFiles = IpPostProgramObligation::where('user_id', $userId)->first();
            if($ppoFiles){
                return $ppoFiles->post_program_eval_report && 
                        $ppoFiles->policy_brief && 
                        $ppoFiles->group_terminal_report &&
                        $ppoFiles->volunteer_work &&
                        $ppoFiles->advocacy_plan;
            }else{
                return false;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function hasFilesLink(){
        try{
            $userId = auth()->user()->id;
            $ppoFiles = IpPostProgramObligation::where('user_id', $userId)->first();
            if($ppoFiles){
                return $ppoFiles->files_link;
            }else{
                return false;
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
