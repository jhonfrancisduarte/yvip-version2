<div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <h3 class="card-title">Participated YV Events</h3> 
                    </div>

                    <div class="card-header card-header1">
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        <table id="thisUserDetailss-table" class="table-main table-full-width">
                            <thead>
                                <tr>
                                    <th class="th-border-rad">Name of Event</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th class="th-action-btn">Hours</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($volunteerEventsAndTrainings as $event)
                                    <tr>
                                        @if($event->approved)
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->event_type }}</td>
                                            <td>
                                                <span 
                                                    @if($event->status === "Ongoing")
                                                        class="green"
                                                    @elseif($event->status === "Completed")
                                                        class="light-blue"
                                                    @else
                                                        class="orange"
                                                    @endif>
                                                    {{ $event->status }}
                                                </span>
                                            </td>
                                            <td>{{ $event->volunteer_hours }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="m-3">
                        {{ $volunteerEventsAndTrainings->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>
</div>
