<?php

namespace App\Livewire\Tables;

use App\Models\IpEvents;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Rule;
use Exception;
use Illuminate\Support\Facades\Auth;

class IpEventsTable extends Component
{
    public $deleteSkillsandCategories;
    public $openEditSkillsAndCategories;
    public $openAddEvent;
    public $popup_message;
    public $editCategoryId;
    public $deleteCategoryId;
    public $search;
    #[Rule('required|min:2')]
    public $event_name;
    #[Rule('required|min:2')]
    public $organizer_sponsor;
    #[Rule('required')]
    public $start;
    #[Rule('required')]
    public $end;
    #[Rule('required')]
    public $newSkills = [''];

    public function addSkill(){
        $this->newSkills[] = '';
    }

    public function removeSkill($index){
        unset($this->newSkills[$index]);
    }
    
    public function render(){
        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->search(trim($this->search))
            ->get();

        
        $ipEvents->transform(function ($event) {
            $participantIds = explode(',', $event->participants);
            $participantData = [];

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

            $event->participantData = $participantData;
            $event->qualifications = explode(',', $event->qualifications);
            return $event;
        });

        return view('livewire.tables.ip-events-table', compact('ipEvents'));
    }

    public function createEvent(){
        try{
            $userId = Auth::user()->id;
            $event = IpEvents::create([
                'user_id' => $userId,
                'event_name' => $this->event_name,
                'organizer_sponsor' => $this->organizer_sponsor,
                'start' => $this->start,
                'end' => $this->end,
                'qualifications' => implode(', ', $this->newSkills),
            ]);

            $this->popup_message = null;
            $this->popup_message = "Category and skills added successfully.";
        }catch(Exception $e){
            throw $e;
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function openAddForm(){
        $this->openAddEvent = true;
    }

    public function closeAddForm(){
        $this->openAddEvent = null;
    }
}
