<div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <button type="button" class="btn-submit btn-show-reward" wire:click="seeRewards">Rewards Matrix</button>
                    </div>

                    <div class="card-body">
                        @if(session('user_role') !== 'yv' || session('user_role') !== 'yip')
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <th width="30%">Total of hours</th>
                                        <th>Reward</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div>
                                        <tr>
                                            <td>{{ Auth::user()->name }}</td>
                                            <td>{{ $totalVolunteerHours }} hours</td>
                                            <td>{{ $reward }}</td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        @else
                            <table id="rewards-table" class="table-main">
                                <thead>
                                    <tr>
                                        {{-- <th width="30%">Name</th> --}}
                                        <th width="30%">Total of hours</th>
                                        <th>Reward</th>
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
                                                <table id="rewards-table" class="table-main">
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

</div>
