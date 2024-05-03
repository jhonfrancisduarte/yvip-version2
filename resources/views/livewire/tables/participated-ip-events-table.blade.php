<div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <h3 class="card-title">International Program Events List</h3> 
                        @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                            <button type="button" class="btn btn-success btn-sm btn-add-event" wire:click="openAddForm">Add Event</button>
                        @endif
                    </div>

                    <div class="card-header card-header1">
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        <table id="thisUserDetailss-table" class="table-main table-full-width">
                            <thead>
                                <tr>
                                    <th class="th-border-rad">Name of Exchange Program/Event</th>
                                    <th>Organizer / Sponsor</th>
                                    <th>Date / Period</th>
                                    <th class="th-action-btn">Status</th>
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

                    <div class="m-3">
                        {{ $ipEvents->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

</div>
