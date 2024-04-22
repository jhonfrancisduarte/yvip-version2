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
                                    <th>Names</th>
                                    <th>Ranks</th>
                                    <th width="7%" class="action-btn">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <div>
                                    @foreach ($totalHoursPerUser as $record)
                                        <p>User ID: {{ $record->user_id }}, Total Volunteer Hours: {{ $record->total_volunteer_hours }}</p>
                                    @endforeach
                                </div>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Names</th>
                                    <th>Ranks</th>
                                    <th width="7%" class="action-btn">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
