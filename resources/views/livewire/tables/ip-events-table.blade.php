<section class="content thisUserDetailss-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="container-fluid">
        <div class="row thisUserDetails-row">
            <div class="col-12 table-contain">
                <div class="card">
                    @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                        <div class="card-header">
                                <h3 class="card-title">International Program Events Management</h3> 
                                <button type="button" class="btn btn-success btn-sm btn-add-event" wire:click="openAddForm">Add Event</button>
                        </div>
                    @endif

                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                            <table id="thisUserDetailss-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if(session('user_role') == 'sa')
                                            <th>Posted By</th>
                                        @endif
                                        <th>Name of Exchange Program/Event</th>
                                        <th>Organizer / Sponsor</th>
                                        <th>Date / Period</th>
                                        <th>Participant Qualifications</th>
                                        @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                                            <th>Participants</th>
                                        @endif
                                        <th width="7%" class="action-btn">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($ipEvents as $event)
                                        <tr>
                                            @if(session('user_role') == 'sa')
                                                <td>{{ $event->name }}</td>
                                            @endif
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->organizer_sponsor }}</td>
                                            <td>
                                                <p>{{ $event->start }} - {{ $event->end }} <br>
                                                    <span
                                                    @if($event->status === "Ongoing")
                                                        class="green"
                                                    @elseif($event->status === "Completed")
                                                        class="blue"
                                                    @else
                                                        class="orange"
                                                    @endif
                                                    >{{ $event->status }}</span>
                                                </p>
                                            </td>
                                            <td class="list-td-2">
                                                <ul>
                                                    @foreach($event->qualifications as $qualification)
                                                        <li>{{ $qualification }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                                                <td class="list-td">
                                                    <ul>
                                                        @foreach($event->participantData as $participant)
                                                            <li wire:click="showParticipantDetails({{ $participant['user_id'] }}, {{ $event->id }})">{{ $participant['name'] }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            @endif
                                            <td class="action-btn">
                                                @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                                                    <button class="btn btn-success btn-xs btn-accounts" wire:click="openJoinRequests({{ $event->id }})">Join Requests
                                                        <span style="background-color: {{ count($joinRequestsData[$event->id] ?? []) > 0 ? 'red' : '#343a40' }}">{{ count($joinRequestsData[$event->id] ?? []) }}</span>                                                    </button>
                                                    <button class="btn btn-info btn-xs" wire:click="toggleOptions({{ $event->id }})"><i class="fas fa-cogs"></i></button>
                                                    @if($options == $event->id)
                                                        <div class="options-container">
                                                            @if($event->status === "Completed")
                                                                <button class="btn btn-success btn-xs" wire:click="openPpoSubmissions({{ $event->id }})">PPO Files</button>
                                                            @endif
                                                            <button class="btn btn-info btn-xs" wire:click="openEditForm({{ $event->id }})">Edit</button>
                                                            <button class="btn btn-info btn-xs" wire:click="toggleJoinStatus({{ $event->id }})">
                                                                @if(!$event->join_status)
                                                                    Close Event
                                                                @else
                                                                    Reopen
                                                                @endif
                                                            </button>
                                                            <button class="btn btn-danger btn-xs" wire:click="deleteDialog({{ $event->id }})">Delete</button>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if(session('user_role') == 'yip')
                                                    @if(!$event->hasJoined && !$event->approved && !$event->disapprovedParticipants && !$event->join_status)
                                                        @if($event->status === "Completed" || $event->status === "Ongoing")
                                                            {{-- No action --}}
                                                        @else
                                                            <button class="btn btn-success btn-xs" wire:click="joinEvent({{ $event->id }})">Join</button>
                                                        @endif
                                                    @elseif($event->join_status)
                                                        <span class="orange">Closed</span>
                                                    @elseif($event->approved)
                                                        <span class="green">Joined</span>
                                                    @elseif($event->disapprovedParticipants)
                                                        <span class="orange">Sorry! You are not qualified for this event.</span>
                                                    @else
                                                        <span class="blue">Waiting for approval</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        @if(session('user_role') == 'sa')
                                            <th>Posted By</th>
                                        @endif
                                        <th>Name of Exchange Program/Event</th>
                                        <th>Organizer / Sponsor</th>
                                        <th>Date / Period</th>
                                        <th>Participant Qualifications</th>
                                        @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                                            <th>Participants</th>
                                        @endif
                                        <th width="7%" class="action-btn">Actions</th>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                            <label class="label">Are you sure you want to delete this Ip Event?</label>
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

    @if($openAddEvent)
        <div class="anns">
            <div class="close-form" wire:click="closeAddForm"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add IP Event</h4>
                            <button type="button" class="close" wire:click="closeAddForm">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form wire:submit.prevent='createEvent'>
                            <div class="card card-primary">
                                <div class="card-body">
                                    
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
                                                @foreach($newSkills as $index => $skill)
                                                    <div class="add-edit-skill-input">
                                                        <input type="text" class="form-control skill-form-control" wire:model="newSkills.{{ $index }}" placeholder="Add participant qualifications" required>
                                                        <button type="button" class="close" wire:click="removeSkill({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                @endforeach
                                                <button type="button" class="btn btn-success btn-sm" wire:click="addSkill">
                                                    <i class="nav-icon fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button class="btn btn-infos" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($openEditEvent)
        <div class="anns">
            <div class="close-form" wire:click="closeEditForm"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit IP Event</h4>
                            <button type="button" class="close" wire:click="closeEditForm">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form wire:submit.prevent='editEvent'>
                            <div class="card card-primary">
                                <div class="card-body">
                                    
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
                                                @foreach($newSkills as $index => $skill)
                                                    <div class="add-edit-skill-input">
                                                        <input type="text" class="form-control skill-form-control" wire:model="newSkills.{{ $index }}" placeholder="Add participant qualifications" required>
                                                        <button type="button" class="close" wire:click="removeSkill({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                @endforeach
                                                <button type="button" class="btn btn-success btn-sm" wire:click="addSkill">
                                                    <i class="nav-icon fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button class="btn btn-infos" type="submit">Submit</button>
                                </div>
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
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Approve IP Event Join Requests</h4>
                            <button type="button" class="close" wire:click="closeJoinRequests">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <label style="margin-left: 20px; font-weight: 400;">Request List</label>
       
                        <div class="card card-primary">
                            <div class="card-body">

                                    {{-- <h3>Event: {{ $event->event_name }}</h3> --}}
                                    @foreach($joinRequestsData[$joinEventId] as $requester)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group requester">
                                                    <label class="label" wire:click="showParticipantDetails({{ $requester['user_id'] }}, '')">{{ $requester['name'] }}</label>
                                                    <div class="btn-approval">
                                                        <button class="btn btn-danger btn-xs btn-approve" wire:click="disapproveParticipant({{ $requester['user_id'] }})">Disapprove</button>
                                                        <button class="btn btn-success btn-xs btn-approve" wire:click="approveParticipant({{ $requester['user_id'] }})" style="margin-right: 5px;">Approve</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($ppoSubmisions)
        <div class="anns">
            <div class="close-form" wire:click="closeSubmissionsTable"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Post-Program Obligation Submissions</h4>
                            <button type="button" class="close" wire:click="closeSubmissionsTable">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <label style="margin-left: 20px; font-weight: 400;">Submission List</label>
       
                        <div class="card card-primary">
                            <div class="card-body">

                                    @foreach($ppoSubmisions as $ppoSubmision)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group requester">
                                                    <label class="label" wire:click="showParticipantDetails({{ $ppoSubmision->user_id }}, '')">{{ $ppoSubmision->user->userdata->first_name }} {{ $ppoSubmision->user->userdata->middle_name }} {{ $ppoSubmision->user->userdata->last_name }}</label>
                                                    @if($ppoSubmision->file_paths)
                                                        <p>{{ pathinfo(asset($ppoSubmision->file_paths), PATHINFO_FILENAME) }}.{{ pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) }}</p>
                                                        <div>
                                                            <a href="{{ asset($ppoSubmision->file_paths) }}" download>
                                                                <button class="btn btn-info btn-xs">Download</button>
                                                            </a>
                                                            
                                                            @if(pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'pdf' ||
                                                                pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'docx' ||
                                                                pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'txt' ||
                                                                pathinfo(asset($ppoSubmision->file_paths), PATHINFO_EXTENSION) === 'csv')
                                                                <button class="btn btn-info btn-xs btn-resized" onclick="window.open('{{ asset($ppoSubmision->file_paths) }}', '_blank')">Preview</button>
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
            </div>
        </div>
    @endif

    @if($thisUserDetails)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideUserData"></div>
            <div class="user-info">
            <div class="info">
                <div class="row1 row-header">
                    <div class="col1">
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

            </div>
                <div class="row1">
                    <div class="col">
                        <div class="user-data">
                            @if(!$ppoSubmisions)
                                @if(!$isParticipant)
                                    <button class="btn btn-success btn-xs" wire:click="approveParticipant({{ $thisUserDetails['user_id'] }})" wire:loading.attr="disabled">Approve</button>
                                    <button class="btn btn-danger btn-xs" wire:click="disapproveParticipant({{ $thisUserDetails['user_id'] }})" wire:loading.attr="disabled">Disapprove</button>
                                @else
                                    <button class="btn btn-success btn-xs" wire:click="disapproveParticipant({{ $thisUserDetails['user_id'] }})" wire:loading.attr="disabled">Remove</button>
                                @endif
                            @endif
                            <button class="btn btn-info btn-xs" wire:click="hideUserData" wire:loading.attr="disabled">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif

</section>