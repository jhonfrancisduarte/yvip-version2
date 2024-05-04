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

                    <div class="card-header">
                        @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                            <h3 class="card-title">Volunteers Rewards</h3>
                            <div class="btn-claim-requests">
                                <button type="button" class="btn-submit btn-reward" wire:click="seeRewards">Add/Edit Reward Matrix</button>
                                <button class="btn-submit" wire:click="seeRequests">Claim Request</button>
                                <span class="notif-count" style="color: white; background-color: {{ count($claimRequests) > 0 ? 'red' : 'rgb(245, 245, 245)' }};">{{ count($claimRequests) }}</span>
                            </div>
                        @else
                            <button type="button" class="btn-submit" wire:click="seeRewards">Reward Matrix</button>
                        @endif
                    </div>

                    <div class="card-body">
                        @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th width="30%" class="th-border-rad">Name</th>
                                        <th width="30%">Total of hours</th>
                                        <th>Reward</th>
                                        <th class="th-action-btn"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div>
                                        @foreach($userHoursArray as $user)
                                            <tr>
                                                <td>{{ $user['user_name'] }}</td>
                                                <td>{{ $user['total_hours'] }} hours</td>
                                                <td class="rewards ">
                                                    @if(collect($user['rewards'])->isEmpty())
                                                        <span style="color: #ccc;">N/A</span>
                                                    @else
                                                        <ul>
                                                            @foreach($user['rewards'] as $rwrd)
                                                                <li>{{ $rwrd }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                
                                                <td class="btn-action2">
                                                    <div class="btn-g">
                                                        <button type="button" class="btn-submit float-right" wire:click="grantReward('{{ $user['user_id'] }}')"><i class="bi bi-award"></i></button>
                                                        <span class="span span-submit">Grant Reward</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </div>
                                </tbody>
                            </table>      
                        @else
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th width="20%" class="th-border-rad">Total of hours</th>
                                        <th width="20%">Reward</th>
                                        <th width="20%">Claim Status</th>
                                        <th width="10%" class="th-action-btn"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $totalVolunteerHours }} hours</td>
                                        <td>
                                            @if($userRewards->isNotEmpty())
                                                <ul class="reward-list">
                                                    @foreach($userRewards as $reward)
                                                        <li>{{ $reward->rewards }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                No Rewards
                                            @endif
                                        </td>
                                        <td class="claim-status">
                                            @foreach($userRewards as $reward)
                                                <li>
                                                    {{ $reward->claim_status ? 'Claimed' : 'Unclaimed' }}
                                                </li>
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($userRewards as $reward)
                                            <li class="claim-reward">
                                                <button type="button" class="btn-success" wire:click="claimReward({{ $reward->id }})" @if(isset($disabledButtons[$reward->id]) && $disabledButtons[$reward->id]) disabled @endif>
                                                    @if(isset($disabledButtons[$reward->id]) && $disabledButtons[$reward->id])
                                                        Request Sent
                                                    @else 
                                                        Request Claim
                                                    @endif
                                                </button>
                                            </li>
                                        @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
                <div class="mt-5"></div>
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
                            <h4 class="modal-title">Reward Matrix</h4>
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
                                <form wire:submit.prevent="createReward">
                                    <div class="row">
                                        <div class="col-2">
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
                                        <div class="col-2">
                                            <div class="btn-group-2" role="group">
                                                <button class="btn-success float-right" type="submit">Submit</button> 
                                                <button class="btn-cancel float-right" wire:click="toggleAddRewardMatrix" style="margin-top: 5px;">Cancel</button> 
                                            </div>
                                        </div>
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
                                                            @else
                                                                <td>{{ $reward->level }}</td>
                                                                <td>{{ $reward->number_of_hours }}</td>
                                                                <td>{{ $reward->rewards }}</td>
                                                                @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                                                                    <td>
                                                                        <div class="btn-group-2" role="group">
                                                                            <div class="btn-g">
                                                                                <button class="btn-submit float-right" wire:click="editReward({{ $reward->id }})">
                                                                                    <i class="bi bi-pencil-square"></i>
                                                                                </button>
                                                                                <span class="span span-delete">Edit</span>
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
        <div class="main-div-request">
            <div class="close-form" wire:click="closeRewards"></div>
            <div class="add-announcement-container request-form-container">
                <div class="modal-dialog modal-md request-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Claim Requests</h4>
                            <button type="button" class="close" wire:click="closeRewards">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <label style="margin-left: 20px; font-weight: 400;">Request List</label>
        
                        <div class="card card-primary">
                            <div class="card-body">

                            @foreach($claimRequests as $request)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group requester">
                                                <label class="label">{{ $request->user->name }}</label>
                                                
                                                <div class="btn-approval">
                                                    @foreach($claimRequests as $claimRequest)
                                                        <button type="button" class="btn btn-success btn-sm" wire:click="approveRequest({{ $claimRequest->id }})">Approve</button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
