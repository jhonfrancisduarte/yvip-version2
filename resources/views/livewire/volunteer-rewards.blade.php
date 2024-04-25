<section class="content volunteers-table-content">
    
    <div class="container-fluid">
        <div class="row volunteer-row">
            <div class="col-12 table-contain">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title title">Volunteer Rewards</h3>
                        <button type="button" class="btn btn-info btn-sm btn-show-reward" wire:click="seeRewards">See Rewards</button>
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table table-bordered table-striped">
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
                                <div class="row volunteer-row">
                                    <div class="col-12 table-contain">
                                        <div class="card">

                                            <div class="card-body scroll-table">
                                                <table id="volunteers-table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">Level</th>
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
</section>
