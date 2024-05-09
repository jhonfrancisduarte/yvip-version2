<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IpPostProgramObligation;
use App\Models\IpEvents;
use Exception;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class PostProgramObligationTable extends Component
{
    use WithFileUploads, WithPagination;
    public $search;
    public $popup_message;
    public $file;
    public $link;
    public $thisPpoId;
    public $postProgramEvaluationReports = [];

    protected $rules = [
        'link' => 'required|min:2',
    ];

    public function render()
    {
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->orderBy('ip_events.created_at', 'desc')
            ->paginate(10);

        $ipEvents->transform(function ($event) {
            $participantIds = explode(',', $event->participants);
            $userId = auth()->user()->id;

            $event->approved = in_array($userId, $participantIds);

            return $event;
        });

        $userId = auth()->user()->id;
        $ppoFiles = IpPostProgramObligation::where('user_id', $userId)->get();

        return view('livewire.tables.post-program-obligation-table', compact('ipEvents', 'ppoFiles'));
    }

    public function savePostProgramEvaluationReports($eventId)
    {
        $files = $this->postProgramEvaluationReports[$eventId] ?? [];

        foreach ($files as $file) {
            $fileName = $file->store('post_program_evaluation_reports');

            IpPostProgramObligation::create([
                'user_id' => Auth::id(),
                'event_id' => $eventId,
                'file_paths' => $fileName,
            ]);
        }

        $this->reset('postProgramEvaluationReports');
    }

    public function closePopup()
    {
        $this->popup_message = null;
    }
}
