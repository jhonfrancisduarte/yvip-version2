<div>
    <div class="card-header">
        <h3 class="card-title">Volunteers Events and Trainings Announcement</h3> 
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" style="margin-left:20px; font-family:'Arial', sans !important;" wire:click="eventForm({{ auth()->user()->id}})">Add Event or Training</button>

        @if($showForm)
            <div class="show-form">
                <div class="close-event-form" wire:click="closeEventForm"></div>
                <div class="modal-dialog modal-sm event-form-width">
                    <form wire:submit.prevent="create" id="add-volunteer-form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Events and Trainings</h4>
                                <button type="button" class="close" wire:click="closeEventForm" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Event Type</label>
                                                <select class="form-control" id="event-type" wire:model.defer="eventType">
                                                    <option value="" selected class="label">Choose option</option>
                                                    <option value="Event">Event</option>
                                                    <option value="Training">Training</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Name of Event</label>
                                                <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Enter Event Name" wire:model.defer="eventName">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Organizer/Facilitator</label>
                                                <input type="text" class="form-control" name="organizer" placeholder="Enter Organizer/Facilitator" wire:model.defer="organizer">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="date" class="form-control" name="start_date" id="start-date" wire:model.defer="startDate">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" name="end_date" id="end-date" wire:model.defer="endDate" min="{{ $startDate ? $startDate : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Number of applicable volunteering hours</label>
                                                <input type="number" class="form-control" name="volunteering_hours" placeholder="Enter Number of Hours" wire:model.defer="volunteerHours">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Volunteer category who can join</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="tag-box">
                                                    <button type="button" class="tag btn btn-light" wire:click="toggleTag('Support')" value="Support">Support</button>
                                                    <button type="button" class="tag btn btn-light" wire:click="toggleTag('Logistics')" value="Logistics">Logistics</button>
                                                    <button type="button" class="tag btn btn-light" wire:click="toggleTag('Management')" value="Management">Management</button>
                                                    <button type="button" class="tag btn btn-light" wire:click="toggleTag('Highly Technical')" value="Highly Technical">Highly Technical</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" id="added-tags">
                                            <label>Added Tags:</label>
                                            @foreach($selectedTags as $tag)
                                                <button type="button" class="added-tag btn btn-primary mr-2">{{ $tag }} <i class="fa fa-times"></i></button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-primary" wire:click="closeEventForm"><i class="fa fa-check"></i> Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <div class="card-body scroll-table" id="scroll-table">
        <table id="thisUserDetailss-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!-- Add column headers -->
                    <th>Event Type</th>
                    <th>Name of Event</th>
                    <th>Organizer / Facilitator</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Volunteering Hours</th>
                    <th>Volunteer Category</th>
                </tr>
            </thead>

            <tbody>
                <!-- Display data from the form -->
                <tr>
                    <!-- Replace values with data from the form -->
                    <td>{{ $eventType }}</td>
                    <td>{{ $eventName }}</td>
                    <td>{{ $organizer }}</td>
                    <td>{{ $startDate }}</td>
                    <td>{{ $endDate }}</td>
                    <td>{{ $volunteerHours }}</td>
                    <td>{{ implode(', ', $selectedTags) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>