<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rewards;
use App\Models\Volunteer;
use App\Models\User;
use App\Models\ClaimRequest;
use App\Models\RewardClaim;
use App\Models\VolunteerHours;
use App\Models\VolunteerRewards as VolunteerReward; 
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use Exception;

use function Laravel\Prompts\select;

class VolunteerRewards extends Component
{
    use WithPagination;
    public $rewards;
    public $openRewards;
    public $totalVolunteerHours;
    public $rewardType;
    public $userHours = [];
    public $thisUserId;
    public $openRequest;
    public $popup_message;
    public $addRewardMatrix;
    public $level;
    public $hours;
    public $reward;
    public $thisReward;
    public $editRewardId;
    public $deleteRewardId;
    public $claimables;
    public $claimableRewards = [];
    public $search;
    public $search2;

    protected $rules = [
        'level' => 'required|numeric|min:1',
        'hours' => 'required|numeric|min:1',
        'thisReward' => 'required|min:2',
    ];

    public function render(){
        $this->rewards = Rewards::orderBy('level', 'asc')->get();
        $this->fetchTotalVolunteerHours();
        
        $claimRequests = VolunteerReward::where('request_status', 1)
                            ->where('claim_status', 0)
                            ->search(trim($this->search2))
                            ->get();
    
        $user = Auth::user();
        $perRewards = VolunteerReward::where('user_id', $user->id)->get();
    
        $userRewards = null;
        $userHours = VolunteerHours::join('users', 'volunteer_hours.user_id', '=', 'users.id')
            ->whereIn('users.user_role', ['yv', 'yip'])
            ->selectRaw('users.id as user_id, users.name as user_name, SUM(volunteer_hours.volunteering_hours) as total_hours')
            ->groupBy('users.id', 'users.name')
            ->search(trim($this->search))
            ->paginate(10);

        foreach ($userHours as $user) {
            $rewardsArray = [];

            $userRewards = VolunteerReward::where('user_id', $user->user_id)->get();

            foreach ($userRewards as $reward) {
                $rewardModel = Rewards::find($reward->reward_id);
                if ($rewardModel) {
                    $rewardsArray[] = [
                        'reward' => $rewardModel->rewards,
                        'claim_status' => $reward->claim_status,
                        'claim_date' => $reward->claim_date,
                    ];
                }
            }

            $user->rewards = $rewardsArray;
        }

        return view('livewire.volunteer-rewards', [
            'claimRequests' => $claimRequests,
            'userRewards' => $userRewards,
            'perRewards' => $perRewards,
            'userHoursArray' => $userHours,
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

    public function approveRequest($rewardId){
        try {

            $rewards = VolunteerReward::where('id', $rewardId)->first();
            $rewards->update([
                'claim_status' => 1,
                'claim_date'=>now(),
            ]);

            $this->dispatch('claim-request');
            $this->claimables = null;
            $this->claimableRewards = null;
            $this->openRequest = null;
            $this->popup_message = "Request approved successfully.";
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function claimReward($rewardId){
        try {
            $user = Auth::user();
            $rewardClaim = RewardClaim::where('user_id', $user->id)->first();
            $reward = Rewards::where('id', $rewardId)->first();

            VolunteerReward::create([
                'user_id' => $user->id,
                'number_of_hours' => $reward->number_of_hours,
                'reward_id' => $rewardId,
                'request_date' => now(),
            ]);

            if($rewardClaim){
                $totalClaimedHours = $rewardClaim->total_claimed_hours + $reward->number_of_hours;
                $claimableHours = $rewardClaim->total_hours - $totalClaimedHours;
                $rewardClaim->update([
                    'total_claimed_hours' => $totalClaimedHours,
                    'claimable_hours' => $claimableHours,
                ]);
            }

            $this->claimables = null;
            $this->claimableRewards = null;
            $this->popup_message = "Request sent successfully.";
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function fetchTotalVolunteerHours(){
        try{
            $user = Auth::user();
            $this->totalVolunteerHours = RewardClaim::where('user_id', $user->id)->first();
        }catch (Exception $e){
            throw $e;
        }
    }

    public function submitReward(){
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

    public function seeClaimables(){
        try {
            $this->claimables = true;
            $user = Auth::user();
            
            if ($user) {
                $rewardMatrix = Rewards::orderBy('number_of_hours', 'asc')->get();
                $totalClaimableHours = RewardClaim::where('user_id', $user->id)->first();

                $claimableRewards = [];
    
                foreach ($rewardMatrix as $reward) {
                    if ($totalClaimableHours->claimable_hours >= $reward->number_of_hours) {
                        $claimableRewards[] = [
                            'id' => $reward->id,
                            'reward' => $reward->rewards,
                        ];
                    }
                }
    
                $this->claimableRewards = $claimableRewards;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    

    
    public function closeClaimables(){
        $this->claimables = null;
        $this->claimableRewards = null;
    }
    
}