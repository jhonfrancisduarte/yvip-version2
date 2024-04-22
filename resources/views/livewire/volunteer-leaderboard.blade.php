<section class="content volunteers-table-content">
    
    <div class="container-fluid">
        <div class="row volunteer-row">
            <div class="col-12 table-contain">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Volunteers Rankings</h3> 
                    </div>
 
                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">Ranks</th>
                                    <th>Names</th>
                                    <th width="15%">Total of Hours</th>
                                </tr>
                            </thead>

                            <tbody>
                                <div>
                                @php $rank = 1; @endphp
                                    @foreach ($totalHoursPerUser as $record)
                                        <tr>
                                            <td id="rank" @if($rank === 1 ) class="gold" @elseif($rank === 2 ) class="silver" @elseif($rank === 3 ) class="bronze" @endif >{{ $rank }}</td>
                                            <td>{{ $record->fullname }}</td>
                                            <td>{{ $record->total_volunteer_hours }}</td>
                                        </tr>
                                        @php $rank++; @endphp
                                    @endforeach
                                </div>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th width="10%">Ranks</th>
                                    <th>Names</th>
                                    <th width="15%">Total of Hours</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

