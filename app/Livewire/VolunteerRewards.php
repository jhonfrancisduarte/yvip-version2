<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rewards;
use App\Models\Volunteer;
use App\Models\User;
use App\Models\ClaimRequest;
use App\Models\VolunteerRewards as VolunteerReward; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;

class VolunteerRewards extends Component
{
    public $rewards;
    public $openRewards;
    public $totalVolunteerHours;
    public $rewardType;
    public $userHoursArray = [];
    public $thisUserId;
    public $userRewards;
    public $openRequest;
    public $popup_message;
    public $disabledButtons = [];
    public $addRewardMatrix;
    public $level;
    public $hours;
    public $reward;
    public $thisReward;
    public $editRewardId;
    public $deleteRewardId;

    protected $rules = [
        'level' => 'required|numeric|min:1',
        'hours' => 'required|numeric|min:1',
        'thisReward' => 'required|min:2',
    ];

    public function render()
    {
        $this->rewards = Rewards::orderBy('level', 'asc')->get();
        $this->userHoursArray = null;
        $this->fetchTotalVolunteerHours();
        $this->fetchUserRewards();
        $this->disabledButtons = Session::get('disabledButtons', []);
        $claimRequests = ClaimRequest::whereNotNull('pending')->get();
        return view('livewire.volunteer-rewards', [
            'claimRequests' => $claimRequests,
        ]);
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function seeRequests(){
        $this->openRequest = true;
    }

    public function seeRewards(){
        $this->openRewards = true;
    }

    public function closeRewards(){
        $this->openRewards = null;
        $this->thisUserId = null;
        $this->openRequest = null;
    }

    public function grantReward($userId){
        $this->thisUserId = $userId;
    }

    public function approveRequest($claimRequestId)
    {
        try {
            $claimRequest = ClaimRequest::findOrFail($claimRequestId);

            $rewards = VolunteerReward::where('user_id', $claimRequest->user_id)->get();

            // Update the claim status of each reward record
            foreach ($rewards as $reward) {
                $reward->update([
                    'claim_status' => 1,
                    'claim_date'=>now(),
                ]);
            }
                
            $claimRequest->update([
                'approved' => '1',
                'pending' => null,
            ]);

            $this->dispatch('claim-request');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function claimReward($rewardId)
    {
        try {
            $userId = Auth::id();

            $this->disabledButtons[$rewardId] = true;
            
            // Store the updated disabled buttons state in the session
            Session::put('disabledButtons', $this->disabledButtons);
            
            ClaimRequest::create([
                'user_id' => $userId,
                'reward_id' => $rewardId,
                'pending' => true,
            ]);

            $this->popup_message = "Request sent successfully.";
    
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function fetchTotalVolunteerHours()
    {
        try{
            if(session('user_role') !== "yv" && session('user_role') !== "yip"){
                $volunteers = Volunteer::whereHas('user', function ($query) {
                    $query->where('user_role', 'yv')->orWhere('user_role', 'yip');
                })->get();

                $totalHoursPerUser = $volunteers->groupBy('user_id')->map(function ($group) {
                    return $group->sum('volunteering_hours');
                });

                foreach ($totalHoursPerUser as $userId => $totalHours) {
                    $user = User::find($userId);
                    if ($user) {
                        $userName = $user->name;
                        $userRewards = VolunteerReward::where('user_id', $userId)->get();
                        $rewardsArray = [];
                        foreach ($userRewards as $reward) {
                            $rewardsArray[] = $reward->rewards;
                        }
                        $this->userHoursArray[] = [
                            'user_id' => $userId,
                            'user_name' => $userName,
                            'total_hours' => $totalHours,
                            'rewards' => $rewardsArray,
                        ];
                    }
                }

            }else{
                try {
                    $user = Auth::user();
                    $this->totalVolunteerHours = Volunteer::where('user_id', $user->id)->sum('volunteering_hours');
                    
                    $userId = Auth::id();
                    $rewardRecord = VolunteerReward::where('user_id', $userId)->first();
            
                    if ($rewardRecord) {
                        $this->reward = $rewardRecord->rewards;
                    } else {
                        $this->reward = 'No Rewards';
                    }
                } catch (Exception $e) {
                    throw $e;
                }
            }
            
        }catch (Exception $e){
            throw $e;
        }
    }

    private function fetchUserRewards()
    {
        $userId = Auth::id();
        $this->userRewards = VolunteerReward::where('user_id', $userId)->get();
    }

    public function submitReward()
    {
        try{
            $thisVolunteerHours = Volunteer::where('user_id', $this->thisUserId)->sum('volunteering_hours');

            $reward = VolunteerReward::create([
                'user_id'=>$this->thisUserId,
                'number_of_hours'=>$thisVolunteerHours,
                'rewards'=>$this->rewardType,
                'award_date'=>now(),
            ]);
            
            $this->thisUserId = null;
            return redirect()->to(route('volunteer-rewards'));
        }catch(Exception $e){
            throw $e;
        }
    }

    public function toggleAddRewardMatrix(){
        if($this->addRewardMatrix){
            $this->addRewardMatrix = null;
            $this->resetForm();
        }else{
            $this->addRewardMatrix = true;
            $this->resetForm();
        }
    }

    public function createReward(){
        try{
            $this->validate();
            $reward = Rewards::create([
                'level' => $this->level,
                'number_of_hours' => $this->hours,
                'rewards' => $this->thisReward,
            ]);

            $this->addRewardMatrix = null;
            $this->editRewardId = null;
            $this->resetForm();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function updateReward(){
        try{
            $this->validate();
            $reward = Rewards::find($this->editRewardId);
            if ($reward) {
                $reward->update([
                    'level' => $this->level,
                    'number_of_hours' => $this->hours,
                    'rewards' => $this->thisReward,
                ]);
            }

            $this->addRewardMatrix = null;
            $this->editRewardId = null;
            $this->resetForm();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deleteReward(){
        try{
            $reward = Rewards::find($this->deleteRewardId);
            if ($reward) {
                $reward->delete();
            }
            $this->addRewardMatrix = null;
            $this->deleteRewardId = null;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function editReward($rewardId){
        try{
            $reward = Rewards::find($rewardId);
            if($reward){
                $this->editRewardId = $rewardId;
                $this->level = $reward->level;
                $this->hours = $reward->number_of_hours;
                $this->thisReward = $reward->rewards;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deleteThisReward($rewardId){
       $this->deleteRewardId = $rewardId;
    }

    public function closeEditReward(){
        $this->editRewardId = null;
        $this->deleteRewardId = null;
        $this->resetForm();
    }

    public function resetForm(){
        $this->reset(['level', 'hours', 'thisReward']);
    }
}