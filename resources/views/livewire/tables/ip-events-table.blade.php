<div>
    
    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
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
                        <h3 class="card-title">International Program Events List</h3> 
                        @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                            <button type="button" class="btn-submit btn-add-event float-right" wire:click="openAddForm">Add Event</button>
                        @endif
                    </div>

                    <div class="card-header card-header1">
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search event...">
                        </div>

                        <div class="col-md-2">
                            <select class="form-control" wire:model.live="status">
                                <option selected value="">Status</option>
                                <option class="label" value="Ongoing">Ongoing</option>
                                <option class="label" value="Upcoming">Upcoming</option>
                                <option class="label" value="Completed">Completed</option>
                            </select>
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
                                    {{-- @if(session('user_role') == 'sa')
                                        <th width="15%">Posted By</th>
                                    @endif --}}
                                    <th class="th-border-rad">Name of Exchange Program/Event</th>
                                    <th>Organizer / Sponsor</th>
                                    <th>Date / Period</th>
                                    <th>Status</th>
                                    <th>Participant Qualifications</th>
                                    <th class="action-btn2 th-action-btn"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($ipEvents as $event)
                                    <tr>
                                        {{-- @if(session('user_role') == 'sa')
                                            <td>{{ $event->name }}</td>
                                        @endif --}}
                                        <td>{{ $event->event_name }}</td>
                                        <td>{{ $event->organizer_sponsor }}</td>
                                        <td>
                                            {{ $event->start }} - <br> {{ $event->end }}
                                        </td>
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
                                        <td class="list-td-2">
                                            <ul>
                                                @foreach($event->qualifications as $qualification)
                                                    <li>{{ $qualification }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="action-btn2">
                                            @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                                                <div class="btn-g">
                                                    <button class="btn-success" wire:click="openJoinRequests({{ $event->id }})">
                                                        <i class="bi bi-person-plus"></i>
                                                    </button>
                                                    <span class="span" style="margin-top: -20px !important;">Join Requests</span>
                                                    <span class="notif-count" style="color: white; background-color: {{ count($joinRequestsData[$event->id] ?? []) > 0 ? 'red' : 'rgb(245, 245, 245)' }};">{{ count($joinRequestsData[$event->id] ?? []) }}</span>
                                                </div>
                                                <div class="mx-2"></div>
                                                <div class="options">
                                                    <div class="btn-g">
                                                        <button class="btn-submit focused" wire:click="toggleOptions({{ $event->id }})">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <span class="span">Options</span>
                                                    </div>
                                                    @if($options == $event->id)
                                                        <div class="options-container">
                                                            <button class="btn-success" wire:click="viewParticipants({{ $event->id }})"><i class="bi bi-people"></i> Participants</button>
                                                            @if($event->status === "Completed")
                                                                <button class="btn-success" wire:click="openPpoSubmissions({{ $event->id }})"><i class="bi bi-file-earmark-check"></i> PPO Files</button>
                                                            @endif
                                                            @if($event->status !== "Completed")
                                                                <button class="btn-submit" wire:click="toggleJoinStatus({{ $event->id }})">
                                                                    @if(!$event->join_status)
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
                                            @endif
                                            @if(session('user_role') == 'yip')
                                                @if(!$event->hasJoined && !$event->approved && !$event->disapprovedParticipants && !$event->join_status)
                                                    @if($event->status !== "Completed")
                                                        <button class="btn-success" wire:click="joinEvent({{ $event->id }})">Join</button>
                                                    @endif
                                                @elseif($event->join_status)
                                                    <span class="orange">Closed</span>
                                                @elseif($event->approved)
                                                    <span class="green">Joined</span>
                                                @elseif($event->disapprovedParticipants)
                                                    <span class="orange">Not Qualified</span>
                                                @else
                                                    <span class="light-blue">Waiting for approval</span>
                                                @endif
                                            @endif
                                        </td>
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

    @if($deleteEventId)
        <div class="anns anns-full-h">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if($deleteMessage)
                            <p style="color: green;">{{ $deleteMessage }}</p>
                        @else
                            <p>Are you sure you want to deactivate this event?</p>
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

    @if($openAddEvent)
        <div class="anns">
            <div class="close-form" wire:click="closeAddForm"></div>
            <div class="add-announcement-container">
                <div class="modal-content">
                    <form wire:submit.prevent='createEvent'>

                        <div class="modal-header">
                            <h4 class="modal-title">Add IP Event</h4>
                            <button type="button" class="close" wire:click="closeAddForm">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">      
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name of Exchange Program/Event</label>
                                        <input type="text" class="form-control" row="5" wire:model.live='event_name' placeholder="Add the name of exchange program or event" required>
                                        @error('event_name') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Organizer / Sponsor</label>
                                        <input type="text" class="form-control" row="5" wire:model.live='organizer_sponsor' placeholder="Add organizer or sponsor" required>
                                        @error('organizer_sponsor') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" row="5" wire:model.live='start' required>
                                        @error('start') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" row="5" wire:model.live='end' required>
                                        @error('end') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Participant Qualifications</label>
                                        @foreach($qualifications as $index => $qualification)
                                            <div class="add-edit-skill-input">
                                                <input type="text" class="form-control skill-form-control" wire:model="qualifications.{{ $index }}" placeholder="Add participant qualifications" required>
                                                <button type="button" class="close" wire:click="removeQualification({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        @endforeach
                                        <p class="btn-submit" wire:click="addQualification">
                                            <i class="bi bi-plus-lg"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                        <div class="modal-footer justify-content-between">
                            <button class="btn-success" type="submit">Submit</button>
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
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Edit IP Event</h4>
                        <button type="button" class="close" wire:click="closeEditForm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent='editEvent'>
                                
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name of Exchange Program/Event</label>
                                        <input type="text" class="form-control" row="5" wire:model.live='event_name' placeholder="Add the name of exchange program or event" required>
                                        @error('event_name') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Organizer / Sponsor</label>
                                        <input type="text" class="form-control" row="5" wire:model.live='organizer_sponsor' placeholder="Add organizer or sponsor" required>
                                        @error('organizer_sponsor') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" row="5" wire:model.live='start' required>
                                        @error('start') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" row="5" wire:model.live='end' required>
                                        @error('end') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Participant Qualifications</label>
                                        @foreach($qualifications as $index => $qualification)
                                            <div class="add-edit-skill-input">
                                                <input type="text" class="form-control skill-form-control" wire:model="qualifications.{{ $index }}" placeholder="Add participant qualifications" required>
                                                <button type="button" class="close" wire:click="removeQualification({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        @endforeach
                                        <button type="button" class="btn-submit" wire:click="addQualification">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer justify-content-between">
                                <button class="btn-success" type="submit">Submit</button>
                            </div>
                                
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if($openJoinRequestsTable)
        <div class="anns">
            <div class="close-form" wire:click="closeJoinRequests"></div>
            <div class="add-announcement-container">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Approve IP Event Join Requests</h4>
                            <button type="button" class="close" wire:click="closeJoinRequests">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <label style="font-weight: 500;">Request List</label>
                            @if(empty($joinRequestsData[$joinEventId]))
                                <p>No join request yet!</p>
                            @else
                                {{-- <h3>Event: {{ $event->event_name }}</h3> --}}
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
        </div>
    @endif

    @if($ipEvent)
        <div class="anns">
            <div class="close-form" wire:click="closeParticipantsForm"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Event: {{ $ipEvent->event_name }}</h4>
                        <button type="button" class="close" wire:click="closeParticipantsForm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if(!empty($participants))
                            <div class="participant-list-header">
                                <label style="font-weight: 500;"><b>{{ count($participants) }}</b> Participant/s</label>
                                <button class="btn-submit float-right" wire:click="exportParticipantsList({{ $ipEvent->id }})" wire:loading.attr='disabled'>
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
                                            @if($ipEvent->status !== "Completed")
                                                <div class="btn-approval">
                                                    <button class="btn-delete" wire:click="disapproveParticipant('{{ $participant['id'] }}')">Remove</button>
                                                </div>
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

    @if($ppoSubmisions)
        <div class="anns">
            <div class="close-form" wire:click="closeSubmissionsTable"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Post-Program Obligation Submissions</h4>
                        <button type="button" class="close" wire:click="closeSubmissionsTable">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <label style="font-weight: 500;">Submission List</label>
                        @foreach($ppoSubmisions as $ppoSubmision)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group requester">
                                        <label class="label" wire:click="showParticipantDetails({{ $ppoSubmision->user_id }}, '')">{{ $ppoSubmision->user->userdata->first_name }} {{ $ppoSubmision->user->userdata->middle_name }} {{ $ppoSubmision->user->userdata->last_name }}</label>
                                        @if($ppoSubmision->file_paths)
                                            <p>{{ pathinfo(asset($ppoSubmision->file_paths), PATHINFO_FILENAME) }}.{{ pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) }}</p>
                                            <div class="anns-buttons">
                                                <a href="{{ asset($ppoSubmision->file_paths) }}" download>
                                                    <i class="bi bi-file-earmark-arrow-down"></i> Download
                                                </a>
                                                
                                                @if(pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'pdf' ||
                                                    pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'docx' ||
                                                    pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'txt' ||
                                                    pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'csv')
                                                    <a href="#" onclick="window.open('{{ asset($ppoSubmision->file_paths) }}', '_blank')"><i class="bi bi-eye"></i> Preview</a>
                                                @endif
                                            </div>
                                        @else
                                            <a href="{{ $ppoSubmision->file_links }}" target="_blank"><p class="p-break">{{ $ppoSubmision->file_links }}</p></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                            @foreach($volunteerExperiences as $experience)
                                <tr class="recordRow">
                                    <td>{{ $experience->nature_of_event }}</td>
                                    <td>{{ $experience->participation }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="row1">
                    <div class="col" style="margin-top: 10px;">
                        <div class="user-data">
                            @if(!$ppoSubmisions)
                                @if(!$isParticipant)
                                    <button class="btn-success" wire:click="approveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled">Approve</button>
                                    <button class="btn-delete" wire:click="disapproveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled">Disapprove</button>
                                @elseif($ipEvent->status !== "Completed")
                                    <button class="btn-delete" wire:click="disapproveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled">Remove</button>
                                @endif
                            @endif
                            <button class="btn-cancel" wire:click="hideUserData" wire:loading.attr="disabled">Close</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>    
    @endif

</div>
