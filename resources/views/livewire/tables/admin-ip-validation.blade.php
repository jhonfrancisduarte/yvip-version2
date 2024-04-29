<div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center fw-bold fs-4">Past IP Events</h3>
                        <div class="d-flex justify-content-end">
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn-submit" wire:click="openAddEventModal">Add Event</button>
                        </div>
                    </div>

                        <div class="card-body scroll-table" id="scroll-table">
                            <table id="volunteers-table" class="table-main table-full-width">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Event Name</th>
                                        <th>Organizer / Sponsor</th>
                                        <th>Sponsor Category</th>
                                        <th>Date / Period</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastIpEvents as $event)
                                    <tr>
                                        <td class="text-nowrap">{{ $event->user->name }}</td>
                                        <td>{{ $event->event_name }}</td>
                                        <td>{{ $event->organizer_sponsor }}</td>
                                        <td>{{ $event->sponsor_category }}</td>
                                        <td>{{ $event->start }} - {{ $event->end }}</td>
                                        <td>{{ $event->confirmed ? 'Confirmed' : 'Pending' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                @if (!$event->confirmed)
                                                    <button type="button" class="btn-submit" data-toggle="modal" data-target="#approveModal_{{ $event->id }}">
                                                        Approve
                                                    </button>
                                                @endif
                                                <div class="mx-1"></div>
                                                <button type="button" class="btn-submit" wire:click="editEvent({{ $event->id }})">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <div class="mx-1"></div>
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

                    <div class="m-3">
                        {{ $pastIpEvents->links('livewire::bootstrap') }}
                    </div>
                </div>
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
                            <label for="userId">User</label>
                            <select class="form-control" id="userId" wire:model.defer="userId">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('userId') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
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
                        <button type="submit" class="btn-submit">Save</button>
                        <button type="button" class="btn-cancel" wire:click="closeAddEventModal">Cancel</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Approval Modals -->
    @foreach($pastIpEvents as $event)
    <div class="modal" id="approveModal_{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel_{{ $event->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel_{{ $event->id }}">Approve Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>User:</strong> {{ $event->user->name }}</p>
                    <p><strong>Event Name:</strong> {{ $event->event_name }}</p>
                    <p><strong>Organizer / Sponsor:</strong> {{ $event->organizer_sponsor }}</p>
                    <p><strong>Sponsor Category:</strong> {{ $event->sponsor_category }}</p>
                    <p><strong>Date / Period:</strong> {{ $event->start }} - {{ $event->end }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-submit" wire:click="approveEvent({{ $event->id }})" data-dismiss="modal" wire:loading.attr="disabled" wire:target="approveEvent">Approve</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Confirmation Modal -->
    @if($confirmingDelete)
    <div class="modal" tabindex="-1" role="dialog" style="display: {{ $confirmingDelete ? 'block' : 'none' }};">
        <div class="close-form" wire:click="$set('confirmingDelete', false)"></div>
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
