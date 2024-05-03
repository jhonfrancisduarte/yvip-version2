<section class="content rewards-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
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
                    <h3 class="card-title">Volunteers Rewards</h3>
                        @if(session('user_role') !== "yv" && session('user_role') !== "yip")
                        <div class="btn-g">
                            <button class="btn btn-submit btn-sm btn-claim-requests" wire:click="seeRequests">Claim Request</button>
                            <span class="notif-count" style="color: white; background-color: {{ count($claimRequests) > 0 ? 'red' : 'rgb(245, 245, 245)' }};">{{ count($claimRequests) }}</span>
                        </div>
                            <button type="button" class="btn btn-submit btn-sm btn-reward" wire:click="seeRewards">Rewards Matrix</button>
                        @else
                            <button type="button" class="btn btn-submit btn-sm" wire:click="seeRewards">Rewards Matrix</button>
                        @endif
                    </div>

                    <div class="card-body">
                        @if(session('user_role') !== 'yv' || session('user_role') !== 'yip')
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th width="30%" class="th-border-rad">Name</th>
                                        <th width="30%">Total of hours</th>
                                        <th class="th-action-btn">Reward</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div>
                                    @foreach($userHoursArray as $user)
                                        <tr>
                                            <td>{{ $user['user_name'] }}</td>
                                            <td>{{ $user['total_hours'] }} hours</td>
                                            <td class="rewards">
                                                @if(collect($user['rewards'])->isEmpty())
                                                    <span>N/A</span>
                                                @else
                                                    <ul>
                                                        @foreach($user['rewards'] as $rwrd)
                                                            <li>{{ $rwrd }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                            
                                            <td class="reward-actions">
                                                <button type="button" class="btn btn-submit btn-sm" wire:click="grantReward('{{ $user['user_id'] }}')"><i class="bi bi-award"></i></button>
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
                                        {{-- <th width="30%">Name</th> --}}
                                        <th width="30%" class="th-border-rad">Total of hours</th>
                                        <th class="th-action-btn">Reward</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div>
                                        <tr>
                                            {{-- <td>{{ Auth::user()->name }}</td> --}}
                                            <td>{{ $totalVolunteerHours }} hours</td>
                                            <td>{{ $reward }}</td>
                                        </tr>
                                    </div>
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
                                                            <td>{{ $reward->rewards }}</td>
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
</section>
