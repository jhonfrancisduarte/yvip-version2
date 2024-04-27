<div>
    <!-- Add Event Button and Past IP Events Table -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center fw-bold fs-4">Past IP Events</h3>

                        <div class="d-flex justify-content-end"> <!-- Align to the right -->
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-info" wire:click="openAddEventModal">Add Event</button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Organizer / Sponsor</th>
                                        <th>Sponsor Category</th>
                                        <th>Date / Period</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastIpEvents as $event)
                                    <tr>
                                        <td>{{ $event->event_name }}</td>
                                        <td>{{ $event->organizer_sponsor }}</td>
                                        <td>{{ $event->sponsor_category }}</td>
                                        <td>{{ $event->start }} - {{ $event->end }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <!-- Edit button -->
                                                <button type="button" class="btn btn-sm btn-info" wire:click="editEvent({{ $event->id }})">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <!-- Delete button -->
                                                <button type="button" class="btn btn-sm btn-danger" wire:click="deleteEvent({{ $event->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                    </div>


                </div>

            </div>
        </div>
    </div>



@if($openAddEvent)
<div class="modal fade show" tabindex="-1" role="dialog" style="display: {{ $openAddEvent ? 'block' : 'none' }};">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Past Event</h5>
                <button type="button" class="btn-close" aria-label="Close" wire:click="closeAddEventModal"></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn-close" aria-label="Close" wire:click="closeAddEventModal"></button> <!-- Close button -->
                <form wire:submit.prevent="saveEvent">
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" class="form-control" id="eventName" placeholder="Enter event name" wire:model.defer="eventName">
                        @error('eventName') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="organizerSponsor">Organizer / Sponsor</label>
                        <input type="text" class="form-control" id="organizerSponsor" placeholder="Enter organizer / sponsor" wire:model.defer="organizerSponsor">
                        @error('organizerSponsor') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="sponsorCategory">Sponsor Category</label>
                        <select class="form-control" id="sponsorCategory" wire:model.defer="sponsorCategory">
                            <option value="">Select Sponsor Category</option>
                            <option value="Fully Sponsored">Fully Sponsored</option>
                            <option value="Accommodation was sponsored">Accommodation was sponsored</option>
                            <option value="Airfare was sponsored">Airfare was sponsored</option>
                            <option value="At own expense">At own expense</option>
                        </select>
                        @error('sponsorCategory') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="dateStart">Date Start</label>
                        <input type="date" class="form-control" id="dateStart" placeholder="Enter date start" wire:model.defer="dateStart">
                        @error('dateStart') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="dateEnd">Date End</label>
                        <input type="date" class="form-control" id="dateEnd" placeholder="Enter date end" wire:model.defer="dateEnd" :min="$dateStart">
                        @error('dateEnd') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeAddEventModal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif


    <!-- Confirmation Modal -->
    @if($confirmingDelete)
        <div class="modal" tabindex="-1" role="dialog" style="display: {{ $confirmingDelete ? 'block' : 'none' }};">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close" aria-label="Close" wire:click="$set('confirmingDelete', false)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this event?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
