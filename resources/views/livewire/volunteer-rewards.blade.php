<div>

    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>


    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header block-on-mobile">
                        @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                            <h3 class="card-title">Volunteers Rewards</h3>
                            <div class="btn-claim-requests">
                                <button class="btn-submit" wire:click="seeRequests">Claim Request</button>
                                <span class="notif-count" style="color: white; background-color: {{ count($claimRequests) > 0 ? 'red' : 'rgb(245, 245, 245)' }};">{{ count($claimRequests) }}</span>
                                <button type="button" class="btn-submit btn-reward" wire:click="seeRewards">Add/Edit Reward Matrix</button>
                            </div>
                        @else
                            <button type="button" class="btn-submit" wire:click="seeRewards">Reward Matrix</button>
                            <button type="button" class="btn-submit" wire:click="seeClaimables">Claimable Reward</button>
                        @endif
                    </div>

                    @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                        <div class="card-header card-header1">
                            <div class="col-md-3">
                                <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                            </div>
                        </div>
                    @endif

                    @if(session('user_role') === "yv" || session('user_role') === "yip")
                        <div class="card-header card-header1">
                            <p>Total Volunteering Hours: <b>{{ $totalVolunteerHours->total_hours ?? 'None' }}</b></p>
                            <p>Total Claimed Hours: <b>{{ $totalVolunteerHours->total_claimed_hours ?? 'None' }}</b></p>
                            <p>Claimable Hours: <b>{{ $totalVolunteerHours->claimable_hours ?? 'None' }}</b></p>                            
                        </div>
                    @endif

                    <div class="card-body">
                        @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <th width="30%">Total of hours</th>
                                        <th width="30%">Reward</th>
                                        <th width="10%" class="sa-actions">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($userHoursArray as $user)
                                        <tr>
                                            <td>{{ $user['user_name'] }}</td>
                                            <td>{{ $user['total_hours'] }} hours</td>
                                            <td class="rewards">
                                                @if(collect($user['rewards'])->isEmpty())
                                                    <span style="color: #ccc;">None</span>
                                                @else
                                                    @foreach($user['rewards'] as $reward)
                                                        <span>• {{ $reward['reward'] }} 
                                                            @if($reward['claim_status'])
                                                                | <span class="green">Claimed</span>
                                                            @else 
                                                                | <span class="red">Unclaimed</span>
                                                            @endif
                                                            @if($reward['claim_date'])
                                                                | {{ $reward['claim_date'] }}
                                                            @endif
                                                        </span><br>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>   
                        @else
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th class="th-border-rad">Reward</th>
                                        <th>Claim Status</th>
                                        <th class="th-action-btn"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($perRewards->isNotEmpty())
                                        @foreach($perRewards as $reward)
                                            <tr>
                                                <td>{{ $reward->reward->rewards }}</td>
                                                <td>
                                                    {{ $reward->claim_status ? 'Claimed' : 'Unclaimed' }}
                                                    @if($reward->claim_status)
                                                        <span>  | {{ $reward->claim_date }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($reward->request_status && !$reward->claim_status)
                                                        Go to the nearest NYC office to get your reward
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endif

                    </div>

                    <div class="m-3">
                        {{ $userHoursArray->links('livewire::bootstrap') }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @if($openRewards)
        <div class="see-rewards">
            <div class="close-form" wire:click="closeRewards"></div>
            <div class="modal-dialog">
                <div class="rewards-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="margin-right: 10px;">Reward Matrix</h4>
                            @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                                <p class="btn-submit add-reward" wire:click="toggleAddRewardMatrix">
                                    <i class="bi bi-plus-lg"></i>
                                </p>
                            @endif
                            <button type="button" class="close" wire:click="closeRewards"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @if($addRewardMatrix)
                            <div class="modal-header">
                                <form wire:submit.prevent="createReward" class="add-form">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" row="5" wire:model.live='level' placeholder="Level" required>
                                                @error('level')
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" row="5" wire:model.live='hours' placeholder="Number of hours" required>
                                                @error('hours')
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" row="5" wire:model.live='thisReward' placeholder="Reward" required>
                                                @error('thisReward')
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-buttons">
                                        <button class="btn-success float-right" type="submit">Submit</button> 
                                        <button class="btn-cancel float-right" wire:click="toggleAddRewardMatrix" style="margin-top: 5px;">Cancel</button> 
                                    </div>
                                </form>
                            </div>
                        @endif

                        <div class="container-fluid">
                            <div class="row rewards-row">
                                <div class="col-12 table-contain">
                                    <div class="card1">

                                        <div class="card-body">
                                            <table id="rewards-table" class="table-main">
                                                <thead>
                                                    <tr>
                                                        <th width="30%" class="th-border-rad">Level</th>
                                                        <th width="30%">Number of Hours</th>
                                                        <th class="{{ (session('user_role') === 'yv' || session('user_role') === 'yip') ? 'th-action-btn' : '' }}">Reward</th>
                                                        @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                                                            <th class="th-action-btn"></th>
                                                        @endif
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <div>
                                                    @foreach ($rewards as $reward)
                                                        <tr>
                                                            @if($editRewardId === $reward->id)
                                                                <form wire:submit.prevent="updateReward">
                                                                    <td>
                                                                        <input type="number" class="form-control" row="5" wire:model.live='level' placeholder="Level" value="{{ $level }}" required>
                                                                        @error('level')
                                                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control" row="5" wire:model.live='hours' placeholder="Number of hours" value="{{ $hours }}" required>
                                                                        @error('hours')
                                                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" row="5" wire:model.live='thisReward' placeholder="Reward" value="{{ $thisReward }}" required>
                                                                        @error('thisReward')
                                                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group-2" role="group">
                                                                            <div class="btn-g">
                                                                                <i class="bi bi-check2-circle green" wire:click="updateReward"></i>
                                                                            </div>
                                                                            <div class="btn-g">
                                                                                <i class="bi bi-x-circle light-blue" wire:click="closeEditReward"></i>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </form>
                                                            @elseif($deleteRewardId === $reward->id)
                                                                <form wire:submit.prevent="updateReward">
                                                                    <td>
                                                                        Are you sure you want to delete this reward matrix?
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        <div class="btn-group-2" role="group">
                                                                            <div class="btn-g">
                                                                                <i class="bi bi-trash3 red" wire:click="deleteReward"></i>
                                                                            </div>
                                                                            <div class="btn-g">
                                                                                <i class="bi bi-x-circle light-blue" wire:click="closeEditReward"></i>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </form>
                                                            @else
                                                                <td>{{ $reward->level }}</td>
                                                                <td>{{ $reward->number_of_hours }}</td>
                                                                <td>{{ $reward->rewards }}</td>
                                                                @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                                                                    <td>
                                                                        <div class="btn-group-3">
                                                                            <div class="btn-g">
                                                                                <i class="bi bi-pencil-square light-blue" wire:click="editReward({{ $reward->id }})"></i>
                                                                            </div>
                                                                            <div class="btn-g">
                                                                                <i class="bi bi-trash3 red" wire:click="deleteThisReward({{ $reward->id }})"></i>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </div>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($thisUserId)
        <div class="see-rewards">
            <div class="close-form" wire:click="closeRewards"></div>
            <div class="modal-dialog modal-sm">
                <form wire:submit.prevent="submitReward" class="rewards-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Grant Reward</h4>
                            <button type="button" class="close" wire:click="closeRewards"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="container-fluid">
                            <div class="row rewards-row">
                                <div class="col-12 table-contain">
                                    <div class="card1">

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Choose Reward</label>
                                                        <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                                            <select  class="form-control select-status" wire:model.blur="rewardType" name="rewardType" required>
                                                                <option selected class="form-control">Choose option</option>
                                                                @foreach($rewards as $reward)
                                                                    <option value="{{ $reward->rewards }}" class="form-control">{{ $reward->rewards }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="select-dropdown"></div>
                                                        </div>
                                                        @error('rewardType') 
                                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button class="btn-success" type="submit">Grant</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($openRequest)
        <div class="anns">
            <div class="close-form" wire:click="closeRewards"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Claim Requests</h4>
                        <button type="button" class="close" wire:click="closeRewards">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-header">
                        <div class="col-12">
                            <input type="search" class="form-control" wire:model.live="search2" placeholder="Search volunteer...">
                        </div>
                    </div>

                    <div class="modal-body">
                        <label style="font-weight: 400;">Request List</label>
                        @foreach($claimRequests as $request)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group requester">
                                        <label class="label">{{ $request->user->name }}</label>
                                        
                                        <div class="btn-approval">
                                            <button type="button" class="btn btn-success btn-sm" wire:click="approveRequest({{ $request->id }})">Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if($claimables)
        <div class="anns anns-full-h">
            <div class="close-form" wire:click="closeClaimables"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Claimable Rewards</h4>
                        <button type="button" class="close" wire:click="closeClaimables">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if (!empty($claimableRewards))
                            <table class="table-main">
                                <thead>
                                    <th class="th-border-rad">Reward</th>
                                    <th class="th-action-btn"></th>
                                </thead>

                                <tbody>
                                    @foreach ($claimableRewards as $claimableReward)

                                        <tr>
                                            <td>{{ $claimableReward['reward'] }}</td>
                                            <td>
                                                <button type="button" class="btn-success float-right" wire:click="claimReward({{ $claimableReward['id'] }})">
                                                        Claim Reward
                                                </button>
                                            </td>
                                        </tr>
                            
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No claimable rewards available.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>
