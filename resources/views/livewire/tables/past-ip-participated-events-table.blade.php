<div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <h3 class="card-title text-center fw-bold fs-4">Past IP Events</h3>
                        <div class="d-flex justify-content-end"> <!-- Align to the right -->
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn-submit" wire:click="openAddEventModal">Add Event</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-main">
                                <thead>
                                    <tr>
                                        <th class="th-border-rad">Event Name</th>
                                        <th>Organizer / Sponsor</th>
                                        <th>Sponsor Category</th>
                                        <th>Date / Period</th>
                                        <th>Status</th>
                                        <th class="th-action-btn">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastIpEvents as $event)
                                    <tr>
                                        <td>{{ $event->event_name }}</td>
                                        <td>{{ $event->organizer_sponsor }}</td>
                                        <td>{{ $event->sponsor_category }}</td>
                                        <td>{{ $event->start }} - {{ $event->end }}</td>
                                        <td>{{ $event->confirmed ? 'Confirmed' : 'Pending' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <!-- Edit button -->
                                                <div class="btn-g">
                                                    @if($event->confirmed)
                                                    <button type="button" class="btn-submit mx-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Cannot Edit Confirmed Event!">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>


                                                    @else
                                                        <button type="button" class="btn-submit mx-1" wire:click="editEvent({{ $event->id }})">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                        <span class="span span-delete">Edit</span>
                                                    @endif
                                                </div>
                                              <!-- Delete button -->
                                                <button type="button" class="btn-delete" wire:click="deleteEvent({{ $event->id }})">
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

                    <div class="m-3">
                        {{ $pastIpEvents->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($openAddEvent)
    <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Your Past Event</h5>
                    <button type="button" class="btn-close" aria-label="Close" wire:click="closeAddEventModal"></button>
                </div>
                <div class="modal-body">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@if($openAddEvent)
    <div class="modal" tabindex="-1" role="dialog" style="display: {{ $openAddEvent ? 'block' : 'none' }};" style="width: 500px">
        <div class="close-form" wire:click="closeAddEventModal"></div>
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Add Past Event</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="closeAddEventModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to add a new event -->
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

                        <button type="submit" class="btn-success">Submit</button>
                        <button type="button" class="btn-cancel" wire:click="closeAddEventModal">Cancel</button>
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
                    <button type="button" class="btn-cancel" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn-delete" wire:click="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
