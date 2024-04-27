<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PhilippineProvinces;
use App\Models\PhilippineCities;
class IpbsTable extends Component
{
    use WithPagination;
    public $selectedUserDetails;
    public $search;
    public $age_range;
    public $civil_status;
    public $deleteVolunteerId;
    public $disableButton = "No";
    public $deleteMessage;
    public $userDetails;
    public $reactivateVolunteerId;
    public $provinces;
    public $cities;
    public $selectedProvince;
    public $selectedCity;
    public $active_status = 1;

    public function showUserData($userId){
        $this->selectedUserDetails = User::where('users.id', $userId)
                                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                                ->select('users.email', 'users.user_role', 'users.active_status', 'user_data.*')
                                ->first();
        $this->selectedUserDetails = $this->selectedUserDetails->getAttributes();
    }

    public function deleteVolunteer($userId){
        $user = User::find($userId);
        if ($user){
            $user->userData()->delete();
            $user->delete();
            $this->deleteMessage = 'Volunteer deleted successfully.';
            $this->disableButton = "Yes";
        }else{
            $this->deleteMessage = 'Volunteer deletion unsuccessfully.';
            $this->disableButton = "Yes";
        }
        $this->deleteVolunteerId = null;
    }

    public function hideUserData(){
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function deleteDialog($userId){
        $this->deleteVolunteerId = $userId;
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteVolunteerId = null;
        $this->disableButton = "No";
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function mount(){
        $this->getProvicesAndCities();
    }

    public function getProvicesAndCities(){
        $this->provinces = PhilippineProvinces::all();
        $this->cities = collect();
    }

    public function exportToPdf(){
        $userDetails = $this->selectedUserDetails;
        $pdf = Pdf::loadView('pdf.volunteers-pdf', ['userDetails' => $userDetails]);
        $pdf->setPaper('A4', 'portrait');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $userDetails['first_name'] . $userDetails['last_name'] . '_IP.pdf');
    }
    public function render(){
        if ($this->selectedProvince != null) {
            $provinceCode = PhilippineProvinces::where('province_description', $this->selectedProvince)
                            ->select('province_code')->first();
            $provinceCode = $provinceCode->getAttributes();
            $this->cities = PhilippineCities::where('province_code', $provinceCode['province_code'])->get();
        }

        $volunteers = User::where('user_role', 'yip')
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('users.email', 'users.active_status', 'user_data.*')
                ->search(trim($this->search))
                ->when($this->age_range, function ($query) {
                    return $query->where('user_data.age', $this->age_range);
                })
                ->when($this->active_status, function ($query) {
                    return $query->where('users.active_status', $this->active_status);
                })
                ->when($this->civil_status, function ($query) {
                    return $query->where('user_data.civil_status', $this->civil_status);
                })
                ->when($this->selectedProvince, function ($query) {
                    return $query->where('user_data.permanent_selectedProvince', $this->selectedProvince);
                })
                ->when($this->selectedCity, function ($query) {
                    return $query->where('user_data.permanent_selectedCity', $this->selectedCity);
                })
                ->get();

        $deactivatedIPs = User::where('user_role', 'yip')
            ->where('users.active_status', 2)
            ->get();

        $ageRange = User::where('user_role', 'yip')
                ->join('user_data', 'users.id', '=', 'user_data.user_id')
                ->select('user_data.age')
                ->orderBy('user_data.age', 'asc')
                ->get();

        return view('livewire.ipbs-table', [
            'volunteers' => $volunteers,
            'deactivatedIPs' => $deactivatedIPs,  
            'ageRange' => $ageRange, 
            'cities' => $this->cities
        ]);
    }

    public function deactivatedAccounts(){
        if($this->active_status == 2){
            $this->active_status = 1;
        }else{
            $this->active_status = 2;
        }
    }

    public function reactivateVolunteer($userId){
        $user = User::find($userId);
        if ($user){
            $user->update([
                'active_status' => 1,
            ]);
            $this->deleteMessage = 'Reactivated successfully.';
            $this->disableButton = "Yes";
        }else{
            $this->deleteMessage = 'Reactivated unsuccessfully.';
            $this->disableButton = "Yes";
        }
        $this->reactivateVolunteerId = null;
    }

    public function reactivateDialog($userId){
        $this->reactivateVolunteerId = $userId;
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }

    public function hideReactivateDialog(){
        $this->deleteMessage = null;
        $this->reactivateVolunteerId = null;
        $this->disableButton = "No";
        if($this->selectedUserDetails != null){
            $this->selectedUserDetails = null;
        }
    }
}
