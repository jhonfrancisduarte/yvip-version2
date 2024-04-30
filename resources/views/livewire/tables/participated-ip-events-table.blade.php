<section class="content thisUserDetailss-table-content">
    <div class="container-fluid">
        <div class="row thisUserDetails-row">
            <div class="col-12 table-contain">
                <div class="card">
                    @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                        <div class="card-header">
                                <h3 class="card-title">International Program Events Management</h3> 
                                <button type="button" class="btn btn-success btn-sm btn-add-event" wire:click="openAddForm">Add Event</button>
                        </div>
                    @endif

                    <div class="card-header card-header1">
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        <table id="thisUserDetailss-table" class="table-main table-full-width">
                            <thead>
                                <tr>
                                    <th>Name of Exchange Program/Event</th>
                                    <th>Organizer / Sponsor</th>
                                    <th>Date / Period</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($ipEvents as $event)
                                    <tr>
                                        @if($event->approved)
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->organizer_sponsor }}</td>
                                            <td>{{ $event->start }} - {{ $event->end }} </td>
                                            <td>
                                                <span
                                                    @if($event->status === "Ongoing")
                                                        class="green"
                                                    @elseif($event->status === "Completed")
                                                        class="light-blue"
                                                    @else
                                                        class="orange"
                                                    @endif
                                                    >
                                                    {{ $event->status }}
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
