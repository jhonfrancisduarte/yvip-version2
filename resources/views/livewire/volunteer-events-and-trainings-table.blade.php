<div>

    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important; opacity: 1;"@endif>
            <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <h3 class="card-title">Volunteers Events and Trainings List</h3> 
                        @if(session('user_role') === 'sa' || session('user_role') === 'vsa' || session('user_role') === 'vs')
                            <button type="button" class="btn-submit btn-add-event" style="float: right;" wire:click="eventForm">Add Event or Training</button>
                        @endif
                    </div>
                
                    <div class="card-header card-header1">
                            <div class="col-md-2">
                                <input type="search" class="form-control" wire:model.live="search" placeholder="Search event...">
                            </div>
                            
                            <div class="col-md-2">
                                <div class="status-dropdown">
                                    <select class="form-control" wire:model.live="selectedStatus"> 
                                        <option value="">Status</option> 
                                        <option value="Ongoing">Ongoing</option> 
                                        <option value="Upcoming">Upcoming</option> 
                                        <option value="Completed">Completed</option> 
                                    </select>
                                </div>
                            </div>

                            @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                                <div class="divider"></div>
                                
                                <div class="col-md-2">
                                    <div class="input-group-radio">
                                        <div class="radio">
                                            <input type="radio" value="start" checked="checked" wire:model.live="filterBy" name="date">
                                            <label>Start date</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" value="end" wire:model.live="filterBy" name="date">
                                            <label>End date</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 date-pick">
                                    <div class="input-group">
                                        <input class="form-control" type="date" wire:model.live="selectedDate" max="{{ now()->format('Y-m') }}">
                                        <div class="reset-date">
                                            <i class="bi bi-arrow-clockwise" wire:click='resetDateFilter'></i>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table-main">
                            <thead>
                                <tr>
                                    <th class="th-border-rad">Event Type</th>
                                    <th>Name of Event</th>
                                    <th>Organizer / Facilitator</th>
                                    <th>Date / Period</th>
                                    <th>Status</th>
                                    <th>Volunteering Hours</th>
                                    <th>Volunteer Category</th>
                                    <th width="7%" class="action-btn2 th-action-btn"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->event_type }}</td>
                                    <td>{{ $event->event_name }}</td>
                                    <td>{{ $event->organizer_facilitator }}</td>
                                    <td>{{ $event->start_date }} - <br> {{ $event->end_date }}</td>
                                    <td>
                                        <div class="options">
                                            <span  
                                            @if($event->status === "Ongoing")
                                                class="green"
                                                wire:click="toggleOptions2({{ $event->id }})"
                                            @elseif($event->status === "Completed")
                                                class="light-blue"
                                            @else
                                                class="orange"
                                                wire:click="toggleOptions2({{ $event->id }})"
                                            @endif >
                                            {{ $event->status }}
                                            </span>
                                            @if($options2 == $event->id)
                                                <div class="options-container">
                                                    Change Status
                                                    <button class="btn-success" wire:click="changeStatus({{ $event->id }}, 'Ongoing')">Ongoing</button>
                                                    <button class="btn-submit" wire:click="changeStatus({{ $event->id }}, 'Completed')">Completed</button>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="centered-content">{{ $event->volunteer_hours }}</td>
                                    <td>{{ $event->volunteer_category }}</td>
                                    <td class="action-btn2">
                                        @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa')
                                            <div class="btn-g">
                                                <button class="btn-success" wire:click="openJoinRequests({{ $event->id }})"><i class="bi bi-person-plus"></i></button>
                                                <span class="span" style="margin-top: -20px !important;">Join Requests</span>
                                                <span class="notif-count" style="color: white; background-color: {{ count($joinRequestsData[$event->id] ?? []) > 0 ? 'red' : '#F7F7F7' }}">{{ count($joinRequestsData[$event->id] ?? []) }}</span>
                                            </div>
                                            <div class="mx-2"></div>
                                            <div class="options">
                                                <div class="btn-g">
                                                    <button class="btn-submit focused" wire:click="toggleSettings({{ $event->id }})"><i class="bi bi-gear"></i></button>
                                                    <span class="span">Options</span>
                                                </div>
                                                @if($selectedEventId === $event->id)
                                                    <div class="inside-settings-buttons">
                                                        <button class="btn-success" wire:click="viewParticipants({{ $event->id }}, 'participants')"><i class="bi bi-people"></i> Participants</button>
                                                        @if($event->status !== "Completed")
                                                            <button class="btn-submit" wire:click="toggleJoinStatus({{ $event->id }})" wire:loading.attr="disabled">
                                                                @if($event->join_status == 0)
                                                                    <i class="bi bi-x-circle"></i> Close Event
                                                                @else
                                                                    <i class="bi bi-door-open"></i> Reopen
                                                                @endif
                                                            </button>
                                                        @endif
                                                        <button class="btn-submit" wire:click="openEditForm({{ $event->id }})"><i class="bi bi-pencil-square"></i> Edit</button>
                                                        <button class="btn-delete" wire:click="deleteDialog({{ $event->id }})"><i class="bi bi-trash3"></i> Delete</button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mx-2"></div>
                                            <div class="btn-g">
                                                <button class="btn-submit" wire:click="viewParticipants({{ $event->id }}, 'grant')"><i class="bi bi-clock"></i></button>
                                                <span class="span" style="margin-top: -20px !important;">Grant Hours</span>
                                                <span class="notif-count" style="color: white; background-color: {{ $hoursUngrantedParticipants[$event->id] > 0 ? 'red' : '#F7F7F7' }}">{{ $hoursUngrantedParticipants[$event->id] }}</span>
                                            </div>
                                        @endif
                                        @if(session('user_role') == 'yip' || session('user_role') == 'yv')
                                            @if(!$event->hasJoined && !$event->approved && !$event->disapprovedParticipants && !$event->join_status)
                                                @if($event->status === "Completed")
                                                    {{-- No action --}}
                                                @else
                                                    @php
                                                        $userId = Auth::user()->id;
                                                        $participants = explode(',', $event->participants);
                                                        $disapprovedParticipants = explode(',', $event->disapproved);
                                                        $joinRequests = explode(',', $event->join_requests);
                                                    @endphp

                                                    @if (in_array($userId, $participants))
                                                        <span class="green">Joined</span>
                                                    @elseif (in_array($userId, $disapprovedParticipants))
                                                        <span class="orange">Not Qualified</span>
                                                    @elseif (in_array($userId, $joinRequests))
                                                        <span class="blue">Waiting for approval</span>
                                                    @else
                                                        <button class="btn-success" wire:click="joinEvent({{ $event->id }})">Join</button>
                                                    @endif
                                                @endif
                                            @elseif($event->join_status)
                                                <span class="orange">Closed</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="m-3">
                        {{ $events->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

    @if($deleteEventId)
        <div class="anns anns-full-h">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog" style="float: right;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if($deleteMessage)
                            <p style="color: green;">{{ $deleteMessage }}</p>
                        @else
                            <p>Are you sure you want to delete this Event?</p>
                        @endif
                    </div>
                    
                    <div class="modal-footer">
                        @if($disableButton == "No")
                            <button class="btn-delete" wire:click="deleteEvent" wire:loading.attr="disabled">Yes</button>
                            <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                        @else
                            <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>    
    @endif

    @if($showForm)
        <div class="anns">
            <div class="close-form" wire:click="closeEventForm"></div>
            <div class="add-announcement-container">
                <div class="modal-content">
                    <form wire:submit.prevent="create" id="edit-volunteer-form">

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
                                            <select class="form-control" id="event-type" wire:model="eventType" required>
                                                <option value="" selected class="label">Choose option</option>
                                                <option value="Event">Event</option>
                                                <option value="Training">Training</option>
                                            </select>
                                            @error('eventType') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name of Event</label>
                                            <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Enter Event Name" wire:model="eventName" required>
                                            @error('eventName') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Organizer/Facilitator</label>
                                            <input type="text" class="form-control" name="organizer" placeholder="Enter Organizer/Facilitator" wire:model="organizer" required>
                                            @error('organizer') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" name="start_date" id="start-date" wire:model="startDate" required>
                                            @error('startDate') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" name="end_date" id="end-date" wire:model="endDate" min="{{ $startDate ? $startDate : '' }}" required>
                                            @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Number of applicable volunteering hours</label>
                                            <input type="number" class="form-control" name="volunteering_hours" placeholder="Enter Number of Hours" wire:model="volunteerHours" required>
                                            @error('volunteerHours') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Volunteer category who can join</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group form-group-2">
                                            <select class="form-control" wire:model="category"> 
                                                <option value="">Categories</option> 
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->all_categories_name }}">{{ $item->all_categories_name }}</option> 
                                                @endforeach 
                                            </select>
                                            <button type="button" class="btn-submit" wire:click='addTag' style="margin-left: 10px;"><i class="bi bi-plus-lg"></i></button>
                                        </div>
                                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-12" id="added-tags">
                                        <label>Added Categories:</label>
                                        @foreach($selectedTags as $tag)
                                            <button type="button" class="btn-submit">{{ $tag }} <i class="fa fa-times" wire:click="removeTag('{{ $tag }}')"></i></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn-submit">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($openEditEvent)
        <div class="anns">
            <div class="close-form" wire:click="closeEditForm"></div>
            <div class="add-announcement-container">
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
                                        <div class="form-group form-group-2">
                                            <select class="form-control" wire:model="category"> 
                                                <option value="">Categories</option> 
                                                @foreach ($categories as $item)
                                                    @if($item->id !== 1)
                                                        <option value="{{ $item->all_categories_name }}">{{ $item->all_categories_name }}</option> 
                                                    @endif
                                                @endforeach 
                                            </select>
                                            <button type="button" class="btn-submit" wire:click='addTag' style="margin-left: 10px;"><i class="bi bi-plus-lg"></i></button>
                                        </div>
                                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-12" id="added-tags">
                                        <label>Added Categories:</label>
                                        @foreach($selectedTags as $tag)
                                            <button type="button" class="btn-submit">{{ $tag }} <i class="fa fa-times" wire:click="removeTag('{{ $tag }}')"></i></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($openJoinRequestsTable)
        <div class="anns">
            <div class="close-form" wire:click="closeJoinRequests"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Event and Training Join Requests</h4>
                        <button type="button" class="close" wire:click="closeJoinRequests">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <label style="font-weight: 500;">Requests List</label>
                        @if(empty($joinRequestsData[$joinEventId]))
                            <p>No Join Requests Yet...</p>
                        @else
                            @foreach($joinRequestsData[$joinEventId] as $requester)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group requester">
                                            <label class="label" wire:click="showParticipantDetails('{{ $requester['user_id'] }}', '')">{{ $requester['name'] }}</label>
                                            <div class="btn-approval">
                                                <button class="btn-delete" wire:click="disapproveParticipant('{{ $requester['user_id'] }}')">Disapprove</button>
                                                <button class="btn-success" wire:click="approveParticipant('{{ $requester['user_id'] }}')" style="margin-right: 5px;">Approve</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if($volunteerEvent)
        <div class="anns">
            <div class="close-form" wire:click="closeParticipantsForm"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Event: {{ $volunteerEvent->event_name }}</h4>
                        <button type="button" class="close" wire:click="closeParticipantsForm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if(!empty($participants) && $type === 'participants')
                            <div class="participant-list-header">
                                <label style="font-weight: 500;"><b>{{ count($participants) }}</b> Participant/s</label>
                                <button class="btn-submit float-right" wire:click="exportParticipantsList({{ $volunteerEvent->id }})" wire:loading.attr='disabled'>
                                    <span><i class="bi bi-filetype-pdf"></i> Export List</span>
                                    <div wire:loading wire:target="exportParticipantsList" class="loading-container">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </button>
                            </div>
                        @endif

                        @if(empty($participants))
                            <p>No participants yet!</p>
                        @else
                            
                            @foreach($participants as $participant)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group requester">
                                            <label class="label" wire:click="showParticipantDetails('{{ $participant['id'] }}', '')">{{ $participant['name'] }}</label>
                                            @if($volunteerEvent->status !== "Completed" && $type === 'participants')
                                                <div class="btn-approval">
                                                    <button class="btn-delete" wire:click="disapproveParticipant('{{ $participant['id'] }}')">Remove</button>
                                                </div>
                                            @elseif($volunteerEvent->status === "Completed" && $type === 'grant')
                                                @if(!$participant['hoursGranted'])
                                                    <form wire:submit.prevent="grantHours('{{ $participant['id'] }}', {{ $volunteerEvent->id }})">
                                                        <div class="btn-approval">
                                                            <input class="form-control" type="number" wire:model="hours.{{ $participant['id'] }}" required>
                                                            <button class="btn-success" type="submit">Grant Hours</button>
                                                        </div>
                                                        @error('hours.' . $participant['id'])
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </form>
                                                @else
                                                    <span>{{ $participant['hoursGranted'] }} Volunteer Hours Granted</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if($thisUserDetails)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideUserData"></div>
            <div class="user-info">
                <div class="info">
                    <div class="row1 row-header">
                        <div class="col1" style="margin-bottom: 10px;">
                            <img src="{{ $thisUserDetails['profile_picture'] }}" alt="" width="100" style="border-radius: 10px;">
                            <label class="label">Passport Number: <span>{{ $thisUserDetails ? $thisUserDetails['passport_number'] : '' }}</span></label>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Firstname: <span>{{ $thisUserDetails ? $thisUserDetails['first_name'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Lastname: <span>{{ $thisUserDetails ? $thisUserDetails['last_name'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Middlename: <span>{{ $thisUserDetails ? $thisUserDetails['middle_name'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Nickname: <span>{{ $thisUserDetails ? $thisUserDetails['nickname']: '' }}</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Date of Birth: <span>{{ $thisUserDetails ? $thisUserDetails['date_of_birth'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Civil Status: <span>{{ $thisUserDetails ? $thisUserDetails['civil_status'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Age: <span>{{ $thisUserDetails ? $thisUserDetails['age'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Nationality: <span>{{ $thisUserDetails ? $thisUserDetails['nationality'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Tel Number: <span>{{ $thisUserDetails ? $thisUserDetails['tel_number'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Mobile Number: <span>{{ $thisUserDetails ? $thisUserDetails['mobile_number'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Email: <span>{{ $thisUserDetails ? $thisUserDetails['email'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Blood Type: <span>{{ $thisUserDetails ? $thisUserDetails['blood_type'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Sex at Birth: <span>{{ $thisUserDetails ? $thisUserDetails['sex'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Educational Background: <span>{{ $thisUserDetails ? $thisUserDetails['educational_background'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col1">
                            <label class="label label-capitalize">Permanent Adrress: <span>{{ $thisUserDetails['p_street_barangay'] }}, {{ $thisUserDetails['permanent_selectedCity'] }}, {{ $thisUserDetails['permanent_selectedProvince'] }}</span></label>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col1">
                            <label class="label label-capitalize">Residential Adrress: <span>{{ $thisUserDetails['r_street_barangay'] }}, {{ $thisUserDetails['residential_selectedCity'] }}, {{ $thisUserDetails['residential_selectedProvince'] }}</span></label>
                        </div>
                    </div>

                    <div class="row1">
                        <div class="col1">
                            <label class="label">Status: <span>{{ $thisUserDetails ? $thisUserDetails['status'] : '' }}</span></label>
                        </div>
                    </div>

                    @if($thisUserDetails['name_of_school'])
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">School Name: <span>{{ $thisUserDetails ? $thisUserDetails['name_of_school'] : '' }}</span></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Course: <span>{{ $thisUserDetails ? $thisUserDetails['course'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($thisUserDetails['nature_of_work'])
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Nature of Work: <span>{{ $thisUserDetails ? $thisUserDetails['nature_of_work'] : '' }}</span></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Employer: <span>{{ $thisUserDetails ? $thisUserDetails['employer'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($thisUserDetails['organization_name'])
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Organization Name: <span>{{ $thisUserDetails ? $thisUserDetails['organization_name'] : '' }}</span></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Position: <span>{{ $thisUserDetails ? $thisUserDetails['org_position'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <table id="volunteers-table" class="table-main">
                        <thead>
                            <tr>
                                <th  width="40%">Category</th>
                                <th  width="60%">Skills</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(!$groupedSkills->isEmpty())
                                @foreach($groupedSkills as $categoryName => $skills)
                                    <tr class="recordRow">
                                        <td class="categoryColumn">
                                            <div>
                                                <p>{{ $categoryName }}</p>
                                            </div>
                                        </td>
                                        <td class="skillsColumn">
                                            <div>
                                            @foreach($skills as $skill)
                                                <li>{{ $skill->all_skills_name }}</li>
                                            @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No Categories and Skills Yet</td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <table id="volunteers-table" class="table-main">
                        <thead>
                            <tr>
                                <th  width="40%">Experience</th>
                                <th  width="60%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background: #CFE9FF; border-top: 1px solid #f5f5f5;">
                                <td>Nature of Work</td>
                                <td>Participation</td>
                            </tr>
                        </tbody>

                        <tbody>
                            @if(!$volunteerExperiences->isEmpty())
                                @foreach($volunteerExperiences as $experience)
                                    <tr class="recordRow">
                                        <td>{{ $experience->nature_of_event }}</td>
                                        <td>{{ $experience->participation }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No Experience Yet</td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <table id="volunteers-table" class="table-main">
                        <thead>
                            <tr>
                                <th  width="40%">Advocacy Plan/s</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($advocacyPlans))
                            <tr class="recordRow">
                                <td>
                                    @foreach($advocacyPlans as $advocacyPlan)
                                        <span>• {{  $advocacyPlan }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            @else
                                <tr>
                                    <td style="color: #ccc;">
                                        No Advocacy Plan
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

                <div class="row1">
                    <div class="col" style="margin-top: 10px;">
                        <div class="user-data">
                            @if(!$isParticipant)
                                <button class="btn-success" wire:click="approveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled">Approve</button>
                                <button class="btn-delete" wire:click="disapproveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled">Disapprove</button>
                            @elseif($volunteerEvent->status !== "Completed")
                                <button class="btn-delete" wire:click="disapproveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled">Remove</button>
                            @endif
                            <button class="btn-cancel" wire:click="hideUserData" wire:loading.attr="disabled">Close</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>    
    @endif

</div>