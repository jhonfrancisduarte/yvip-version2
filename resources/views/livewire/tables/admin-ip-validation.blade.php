<div >
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header">
                        <div class="d-flex m-2">
                            <!-- Search input -->
                            <div class="input-group me-3" style="max-width: 300px;">
                                <input type="search" class="form-control" wire:model.live="searchQuery" placeholder="Search...">
                            </div>

                            <div class="ml-auto">
                                <button type="button" class="btn-submit" wire:click="openAddEventModal">Add Event</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table" >
                        <table class="table-main table-full-width">
                            <div style="border-radius: 10px; overflow: hidden;">
                                <thead>
                                    <tr>
                                        <th class="bg-primary">User</th>
                                        <th class="bg-primary">Event Name</th>
                                        <th class="bg-primary">Organizer / Sponsor</th>
                                        <th class="bg-primary">Sponsor Category</th>
                                        <th class="bg-primary">Date / Period</th>
                                        <th class="bg-primary">Status</th>
                                        <th class="bg-primary text-center">Actions</th>
                                    </tr>
                                </thead>
                            </div>
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
                                                <div class="btn-g">
                                                    <button type="button" class="btn-success" data-toggle="modal" data-target="#approveModal_{{ $event->id }}">
                                                        <i class="bi bi-check2-circle"></i>
                                                    </button>
                                                    <span class="span span-delete">Approve</span>
                                                </div>

                                            @endif
                                            <div class="btn-g">
                                            <button type="button" class="btn-submit mx-1" wire:click="editEvent({{ $event->id }})">
                                                <i class="bi bi-pencil-fill"></i>

                                            </button>
                                                <span class="span span-delete">Edit</span>
                                            </div>
                                            <div class="btn-g">
                                            <button type="button" class="btn-delete" wire:click="deleteEvent({{ $event->id }})">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                                <span class="span span-delete">Delete</span>
                                            </div>
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
                            @if(!$editEventId)
                            <label for="userId">User</label>
                            <select class="form-control" id="userId" wire:model.defer="userId">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @else
                            <label for="userId">User</label>
                            <input type="text" class="form-control" id="userId" value="{{ $users->firstWhere('id', $userId)->name }}" disabled>
                            <input type="hidden" wire:model.defer="userId">
                            @endif
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
    <div class="modal fade" id="approveModal_{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel_{{ $event->id }}" aria-hidden="true">
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