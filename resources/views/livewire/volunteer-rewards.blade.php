<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="table-wrapper">

        <div class="table-container">

            <div class="table-header bordered-bottom">
                @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                    <h3 class="table-title">Volunteers Rewards</h3>
                @endif
            </div>

            @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                <div class="table-header justify-left width-100">
                    <div class="col-md-5">
                        <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search...">
                    </div>
                    @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                        <div class="btn-claim-requests">
                            <button class="open-dialog-btn table-button" wire:click="seeRequests" style="margin-right: 5px">Claim Request</button>
                            <span class="notif-count" style="color: white; background-color: {{ count($claimRequests) > 0 ? 'red' : 'rgb(245, 245, 245)' }};">{{ count($claimRequests) }}</span>
                            <button type="button" class="open-dialog-btn table-button" wire:click="seeRewards">Add/Edit Reward Matrix</button>
                        </div>
                    @else
                        <button type="button" class="open-dialog-btn btn-submit" wire:click="seeRewards">Reward Matrix</button>
                        <button type="button" class="open-dialog-btn btn-submit" wire:click="seeClaimables">Claimable Reward</button>
                    @endif
                </div>
            @endif

            @if(session('user_role') === "yv" || session('user_role') === "yip")
                <div class="card-header card-header1">
                    <p>Total Volunteering Hours: <b>{{ $totalVolunteerHours->total_hours ?? 'None' }}</b></p>
                    <p>Total Claimed Hours: <b>{{ $totalVolunteerHours->total_claimed_hours ?? 'None' }}</b></p>
                    <p>Claimable Hours: <b>{{ $totalVolunteerHours->claimable_hours ?? 'None' }}</b></p>                            
                </div>
            @endif

            <div class="table-table" id="table-table">
                <div class="table">
                    @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                        @foreach($userHoursArray as $user)
                            <div class="table-tr">
                                <div class="table-overlay"></div>
                                <div class="tr" @if(collect($user['rewards'])->isEmpty()) style="padding-bottom: 0" @endif>

                                    <div class="primary-data">
                                        <img src="{{ $user['profile_picture'] }}" style="height: 70px; width: 70px; border-radius: 50%;">
                                        <div class="data-row full-w-on-mobile p-data">
                                            <p class="table-tr-data main-data data-col-full">{{ $user['user_name'] }}</p>
                                            <p class="table-tr-data data-col-full"><b style="color: rgb(0, 57, 133)">{{ $user['total_hours'] }}</b> Volunteering hours</p>
                                        </div>
                                    </div>

                                    <div class="secondary-data {{ collect($user['rewards'])->isEmpty() ? 'display-none' : '' }}">
                                        <div class="data-row center on-mobile">    
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
                                        </div>
                                    </div>

                                </div>

                                <div class="table-action-buttons">
                                    @if(collect($user['rewards'])->isEmpty())
                                        <span style="color: #ccc;">No claimed rewards yet!</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach  
                    @else
                        @if($perRewards->isNotEmpty())
                            @foreach($perRewards as $reward)
                                <div class="table-tr">
                                    <div class="table-overlay"></div>
                                    <div class="tr">
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
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div> 
            </div>

            <div class="m-3">
                {{ $userHoursArray->links('livewire::bootstrap') }}
            </div>

        </div>
    </div>

    <div class="popup popup-panel" @if(!$openRewards) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeRewards"></div>
        <div class="panel-content-wrapper h-fit-content">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="table-header rewards-header">
                    <h3 class="table-title">Reward Matrix</h3>    
                    @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                        <p class="btn-submit add-reward" wire:click="toggleAddRewardMatrix">
                            <i class="bi bi-plus-lg"></i>
                        </p>
                    @endif
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeRewards">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-header" @if(!$addRewardMatrix) style="display: none;" @endif>
                    <form wire:submit.prevent="createReward" class="add-form">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="number" class="panel-input-1" row="5" wire:model.live='level' placeholder="Level" required>
                                    @error('level')
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="number" class="panel-input-1" row="5" wire:model.live='hours' placeholder="Number of hours" required>
                                    @error('hours')
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" class="panel-input-1" row="5" wire:model.live='thisReward' placeholder="Reward" required>
                                    @error('thisReward')
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row-buttons">
                            <button class="btn-success float-right" type="submit">Submit</button> 
                            <button class="btn-cancel float-right" wire:click="toggleAddRewardMatrix">Cancel</button> 
                        </div>
                    </form>
                </div>


                <div class="table-table rounded" id="table-table">

                    <div class="table-thead">
                        <div>Level</div>
                        <div>Number of Hours</div>
                        <div>Reward</div>
                    </div>

                    @foreach ($rewards as $reward)
                            <div class="rewards">
                                @if($editRewardId === $reward->id)
                                    <form wire:submit.prevent="updateReward">
                                        <div>
                                            <input type="number" class="panel-input-1" row="5" wire:model.live='level' placeholder="Level" value="{{ $level }}" required>
                                            @error('level')
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <input type="number" class="panel-input-1" row="5" wire:model.live='hours' placeholder="Number of hours" value="{{ $hours }}" required>
                                            @error('hours')
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <input type="text" class="panel-input-1" row="5" wire:model.live='thisReward' placeholder="Reward" value="{{ $thisReward }}" required>
                                            @error('thisReward')
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                       
                                        <i class="bi bi-check2-circle green" wire:click="updateReward"  style="margin-right: 5px"></i>
                                        <i class="bi bi-x-circle light-blue" wire:click="closeEditReward" style="margin-right: 20px"></i>
                                      

                                    </form>
                                @elseif($deleteRewardId === $reward->id)
                                    <form wire:submit.prevent="updateReward">
                                        <div>
                                           <p>Are you sure you want to delete <br> this reward matrix?</p> 
                                        </div>

                                        <div class="rewards-action">
                                            <i class="bi bi-trash3 red m-r-m" wire:click="deleteReward" style="margin-bottom: 5px"></i>
                                            <i class="bi bi-x-circle light-blue m-r-m" wire:click="closeEditReward"></i>
                                        </div>
                                    </form>
                                @else
                                    <div>{{ $reward->level }}</div>
                                    <div>{{ $reward->number_of_hours }}</div>
                                    <div>{{ $reward->rewards }}</div>
                                    @if(session('user_role') === 'sa' || session('user_role') === 'vs' || session('user_role') === 'vsa')
                                        <div class="rewards-action">
                                            <i class="bi bi-pencil-square light-blue" wire:click="editReward({{ $reward->id }})" style="margin-bottom: 5px"></i>
                                            <i class="bi bi-trash3 red" wire:click="deleteThisReward({{ $reward->id }})"></i>
                                        </div>
                                    @endif
                                @endif
                            </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

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

    <div class="popup popup-panel" @if(!$openRequest) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeRewards"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="table-header rewards-header">
                    <h3 class="table-title">Claim Requests</h3>   
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeRewards">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-header">
                    <div class="col-12">
                        <input type="search" class="panel-input-1" wire:model.live="search2" placeholder="Search volunteer...">
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
