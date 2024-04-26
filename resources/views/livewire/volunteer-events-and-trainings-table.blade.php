<!DOCTYPE html>

    <div>
        <div class="card-header">
            <h3 class="card-title">Volunteers Events and Trainings Announcement</h3> 
            @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" style="margin-left:20px; font-family:'Arial', sans !important;" wire:click="eventForm({{ auth()->user()->id}})">Add Event or Training</button>
            @endif
            
        </div>
    <div>

    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
            <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

        <div class="card-body scroll-table" id="scroll-table">
            <table id="thisUserDetailss-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Event Type</th>
                        <th>Name of Event</th>
                        <th>Organizer / Facilitator</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Volunteering Hours</th>
                        <th>Volunteer Category</th>
                        <th width="7%" class="action-btn"></th>
                    </tr>
                </thead>

                <tbody>
    @foreach($events as $event)
    <tr>
        <td>{{ $event->event_type }}</td>
        <td>{{ $event->event_name }}</td>
        <td>{{ $event->organizer_facilitator }}</td>
        <td>{{ $event->start_date }}</td>
        <td>{{ $event->end_date }}</td>
        <td>{{ $event->volunteer_hours }}</td>
        <td>{{ $event->volunteer_category }}</td>
        <td>
            <div class="action-buttons">

                <button class="btn btn-success btn-xs btn-accounts" wire:click="openJoinRequests({{ $event->id }})">Join Requests
                    <span style="background-color: {{ count($joinRequestsData[$event->id] ?? []) > 0 ? 'red' : '#343a40' }}">{{ count($joinRequestsData[$event->id] ?? []) }}</span></button>
                <button class="btn btn-info btn-xs settings" wire:click="toggleSettings({{ $event->id }})">
                    <i class="fas fa-cogs"></i>
                </button>
                @if($showEditDeleteButtons && $selectedEventId == $event->id)
                <div class="inside-settings-buttons">
                    <button class="btn btn-info btn-xs" wire:click="openEditForm({{ $event->id }})">Edit</button>
                    <button class="btn btn-danger btn-xs delete-button" wire:click="deleteDialog({{ $event->id }})">Delete</button>
                </div>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</tbody>

@if($deleteEventId)
<div class="users-data-all-container">
    <div class="close-form" wire:click="hideDeleteDialog"></div>
    <div class="user-info">
        <div class="row1 row-header">
            <div class="col1">
                @if($deleteMessage)
                <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                @else
                <label class="label">Are you sure you want to delete this Event?</label>
                @endif
            </div>
        </div>

        <div class="row1 row-footer">
            <div class="col">
                <div class="user-data">
                    @if($disableButton == "No")
                    <button class="btn-danger btn-50" wire:click="deleteEvent" wire:loading.attr="disabled">Yes</button>
                    <button class="btn-close-user-data btn-50" wire:click="hideDeleteDialog">Cancel</button>
                    @else
                    <button class="btn-close-user-data btn-50" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</div>


                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->event_type }}</td>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ $event->organizer_facilitator }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>{{ $event->volunteer_hours }}</td>
                        <td>{{ $event->volunteer_category }}</td>
                        <td>
                        <div class="action-buttons">

                        <button class="btn btn-success btn-xs btn-accounts" wire:click="openJoinRequests({{ $event->id }})">Join Requests
                            <span style="background-color: {{ count($joinRequestsData[$event->id] ?? []) > 0 ? 'red' : '#343a40' }}">{{ count($joinRequestsData[$event->id] ?? []) }}</span></button>
                            <button class="btn btn-info btn-xs settings" wire:click="toggleSettings({{ $event->id }})">
                                <i class="fas fa-cogs"></i>
                            </button>
                            @if($showEditDeleteButtons && $selectedEventId == $event->id)
                                <div class="inside-settings-buttons">
                                    <button class="btn btn-info btn-xs" wire:click="openEditForm({{ $event->id }})">Edit</button>
                                    <button class="btn btn-danger btn-xs delete-button" wire:click="deleteDialog({{ $event->id }})">Delete</button>
                                </div>
                            @endif
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($deleteEventId)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info">
                <div class="row1 row-header">
                    <div class="col1">
                        @if($deleteMessage)
                            <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                        @else
                            <label class="label">Are you sure you want to delete this Event?</label>
                        @endif
                    </div>
                </div>
                
                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            @if($disableButton == "No")
                                <button class="btn-danger btn-50" wire:click="deleteEvent" wire:loading.attr="disabled">Yes</button>
                                <button class="btn-close-user-data btn-50" wire:click="hideDeleteDialog">Cancel</button>
                            @else
                                <button class="btn-close-user-data btn-50" wire:click="hideDeleteDialog">Close</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif

            @if($showForm)
                <div class="show-form">
                    <div class="close-event-form" wire:click="closeEventForm"></div>
                    <div class="modal-dialog modal-sm event-form-width">
                        <form wire:submit.prevent="create" id="edit-volunteer-form">
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
                                                    <select class="form-control" id="event-type" wire:model.live="eventType">
                                                        <option value="" selected class="label">Choose option</option>
                                                        <option value="Event">Event</option>
                                                        <option value="Training">Training</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Name of Event</label>
                                                    <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Enter Event Name" wire:model.live="eventName">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Organizer/Facilitator</label>
                                                    <input type="text" class="form-control" name="organizer" placeholder="Enter Organizer/Facilitator" wire:model.live="organizer">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" name="start_date" id="start-date" wire:model.live="startDate">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" name="end_date" id="end-date" wire:model.live="endDate" min="{{ $startDate ? $startDate : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Number of applicable volunteering hours</label>
                                                    <input type="number" class="form-control" name="volunteering_hours" placeholder="Enter Number of Hours" wire:model.live="volunteerHours">
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

            @if($openEditEvent)
                <div class="show-form">
                    <div class="close-event-form" wire:click="closeEditForm"></div>
                    <div class="modal-dialog modal-sm event-form-width">
                        <form wire:submit.prevent="editEvent" id="edit-volunteer-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Events and Trainings</h4>
                                    <button type="button" class="close" wire:click="closeEditForm" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Type</label>
                                                    <select class="form-control" id="event-type" value="{{$eventType}}" wire:model.live="eventType">
                                                        <option value="" selected class="label">Choose option</option>
                                                        <option value="Event">Event</option>
                                                        <option value="Training">Training</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Name of Event</label>
                                                    <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Enter Event Name" value="{{$eventName}}" wire:model.live="eventName">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Organizer/Facilitator</label>
                                                    <input type="text" class="form-control" name="organizer" value="{{$organizer}}" wire:model.live="organizer">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" name="start_date" id="start-date" value="{{$startDate}}" wire:model.live="startDate">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" name="end_date" id="end-date" value="{{$endDate}}" wire:model.live="endDate" min="{{ $startDate ? $startDate : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Number of applicable volunteering hours</label>
                                                    <input type="number" class="form-control" name="volunteering_hours" placeholder="Enter Number of Hours" value="{{$volunteerHours}}" wire:model.live="volunteerHours">
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
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

    </div>