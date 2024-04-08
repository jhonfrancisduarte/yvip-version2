<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class VolunteersTable extends Component
{
    use WithPagination;
    public $selectedUserDetails;
    public $search;
    public $age_range;
    public $civil_status;
    public $deleteVolunteerId;

    public function render(){
        $volunteers = User::where('user_role', 'yv')
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('users.*', 'user_data.*')
                ->search(trim($this->search))
                ->when($this->age_range, function ($query) {
                    return $query->where('user_data.age', $this->age_range);
                })
                ->when($this->civil_status, function ($query) {
                    return $query->where('user_data.civil_status', $this->civil_status);
                })
                ->get();

        $ageRange = User::where('user_role', 'yv')
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('user_data.age')
                ->orderBy('user_data.age', 'asc')
                ->get();

        return view('livewire.volunteers-table', compact('volunteers', 'ageRange'));
    }

    public function showUserData($userId){
        $this->selectedUserDetails = User::join('user_data', 'users.id', '=', 'user_data.user_id')
                                    ->where('users.id', $userId)
                                    ->select('users.*', 'user_data.*')
                                    ->first();
    }

    public function deleteVolunteer($userId){
        $user = User::find($userId);
        if ($user){
            $user->userData()->delete();
            $user->delete();
        }
    }

    public function hideUserData(){
        $this->selectedUserDetails = null;
    }

    public function deleteDialog($userId){
        $this->deleteVolunteerId = $userId;
    }

    public function hideDeleteDialog(){
        $this->deleteVolunteerId = null;
    }
}
