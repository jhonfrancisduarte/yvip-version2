<div>
        <div class="bg-white p-3">
            <div class="card-header">
                <h3 class="card-title">My Participated YV Events</h3> 
            </div>
        </div>
    </div>

    <table id="volunteers-table" class="table-main">
        <thead>
            <tr>
                <th>Event Type</th>
                <th>Name of Event</th>
                <th>Organizer / Facilitator</th>
                <th>Date / Period</th>
                <th>Status</th>
                <th>Volunteering Hours</th>
                <th>Volunteer Category</th>
                <th width="7%" class="action-btn2"></th>
            </tr>
        </thead>

        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->event_type }}</td>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->organizer_facilitator }}</td>
                    <td>{{ $event->start_date }} - {{ $event->end_date }}</td>
                    <td class="centered-content">{{ $event->status }}</td>
                    <td>{{ $event->volunteer_hours }}</td>
                    <td>{{ $event->volunteer_category }}</td>
                    <td><!-- Any action buttons if needed --></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
