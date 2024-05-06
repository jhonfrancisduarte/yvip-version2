<div>
    
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-body scroll-table">
                        @php 
                            $myRank = 1; 
                        @endphp
                        @foreach ($totalHoursPerUser as $record)
                            @if(auth()->user()->id !== $record->user_id)
                                @php $myRank++; @endphp
                            @else
                                <div class="my-rank">
                                    <div class="r">
                                        <div class="rank">
                                            @if($myRank === 1)
                                                <img src="images/rank1.png" alt="rank icon" width="48">
                                            @elseif($myRank === 2)
                                                <img src="images/rank2.png" alt="rank icon" width="48">
                                            @elseif($myRank === 3)
                                                <img src="images/rank3.png" alt="rank icon" width="48">
                                            @else
                                                <img src="images/norank.png" alt="rank icon" width="48">
                                            @endif
                                            <p @if($myRank === 1)class="rank1"@endif>{{ $myRank }}</p>
                                        </div>
                                        <div class="my-name">
                                            <p><img class="profile_picture" src="{{ $record->profile_picture }}" alt="profile picture" width="40">{{ $record->fullname }}</p>
                                        </div>
                                    </div>
                                    <div class="my-hours">
                                        <p><i class="fas fa-clock"></i> {{ $record->total_volunteer_hours }}</p>
                                    </div>
                                </div>
                                @break
                            @endif
                        @endforeach
                        <table id="volunteers-table">
                            <thead>
                                <tr>
                                    <th width="20%" class="centered">Ranking</th>
                                    <th>Name</th>
                                    <th width="20%" class="centered">Total Number of Hours</th>
                                </tr>
                            </thead>

                            <tbody>
                                <div>
                                    @php 
                                        $rank = 1; 
                                        $previousHours = null;
                                    @endphp
                                    @foreach ($totalHoursPerUser as $record)
                                        @if($previousHours !== $record->total_volunteer_hours && $previousHours !== null)
                                            @php $rank++; @endphp
                                        @endif
                                        <tr>
                                            <td class="centered">
                                                <div class="rank">
                                                    @if($rank === 1)
                                                        <img src="images/rank1.png" alt="rank icon" width="48">
                                                    @elseif($rank === 2)
                                                        <img src="images/rank2.png" alt="rank icon" width="44">
                                                    @elseif($rank === 3)
                                                        <img src="images/rank3.png" alt="rank icon" width="40">
                                                    @else
                                                        <img src="images/norank.png" alt="rank icon" width="35">
                                                    @endif
                                                    <p @if($rank === 1)class="rank1"@endif>{{ $rank }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <img class="profile_picture" src="{{ $record->profile_picture }}" alt="profile picture" width="40">
                                                {{ $record->fullname }}
                                            </td>
                                            <td class="centered">
                                                <i class="fas fa-clock"></i> {{ $record->total_volunteer_hours }}
                                            </td>
                                        </tr>
                                        @if($rank === 10)
                                            @break
                                        @endif
                                        @php
                                            $previousHours = $record->total_volunteer_hours;
                                        @endphp
                                    @endforeach

                                </div>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

</div>