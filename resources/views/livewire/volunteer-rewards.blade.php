<section class="content rewards-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="container-fluid">
        <div class="row rewards-row">
            <div class="col-12 table-contain">
                <div class="card">
                    <div class="card-header">
                        @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                            <button type="button" class="btn btn-info btn-sm btn-show-reward" wire:click="seeRequests">Claim Requests</button>
                            <button type="button" class="btn btn-info btn-sm btn-show-reward" wire:click="seeRewards">Rewards Matrix</button>
                        @else
                            <button type="button" class="btn btn-info btn-sm btn-show-reward" wire:click="seeRewards">Rewards Matrix</button>
                        @endif
                    </div>

                    <div class="card-body">
                    @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                        <table id="rewards-table" class="table">
                            <thead>
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="20%">Total of hours</th>
                                    <th width="30%">Reward</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <div>
                                @foreach($userHoursArray as $user)
                                    <tr>
                                        <td>{{ $user['user_name'] }}</td>
                                        <td>{{ $user['total_hours'] }} hours</td>
                                        <td class="rewards">
                                            @if($user['rewards'] !== null)
                                                <ul>
                                                    @foreach($user['rewards'] as $rwrd)
                                                        @if($rwrd !== null)
                                                            <li>{{ $rwrd }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        
                                        <td class="reward-actions">
                                            <li>
                                                <button type="button" class="btn btn-info btn-sm btn-show-reward" wire:click="grantReward({{ $user['user_id'] }})">Grant Reward</button>
                                            </li>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </div>
                            </tbody>

                        </table>
                    @else
                    <table id="rewards-table" class="table">
                        <thead>
                            <tr>
                                <th width="30%">Name</th>
                                <th width="20%">Total of hours</th>
                                <th width="20%">Reward</th>
                                <th width="20%">Claim Status</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ Auth::user()->name }}</td>
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
                                        <button type="button" class="btn btn-info btn-sm" wire:click="claimReward({{ $reward->id }})" @if(isset($disabledButtons[$reward->id]) && $disabledButtons[$reward->id]) disabled @endif>Claim</button>
                                    </li>
                                @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if($openRewards)
        <div class="see-rewards">
        <div class="close-form" wire:click="closeRewards"></div>
            <div class="modal-dialog modal-sm">
                <form wire:submit.prevent="updateExp" class="rewards-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Rewards</h4>
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
                                            <table id="rewards-table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">Level</th>
                                                        <th width="30%">Number of Hours</th>
                                                        <th>Reward</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <div>
                                                    @foreach ($rewards as $reward)
                                                        <tr>
                                                            <td>{{ $reward->level }}</td>
                                                            <td>{{ $reward->number_of_hours }}</td>
                                                            <td>{{ $reward->all_rewards }}</td>
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
                </form>
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
                            <h4 class="modal-title">Rewards</h4>
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
                                                                    <option value="{{ $reward->all_rewards }}" class="form-control">{{ $reward->all_rewards }}</option>
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
                                                <button class="btn btn-info" type="submit">Submit</button>
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
                                                        <button type="button" wire:click="approveRequest({{ $claimRequest->id }})">Approve</button>
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
</section>
