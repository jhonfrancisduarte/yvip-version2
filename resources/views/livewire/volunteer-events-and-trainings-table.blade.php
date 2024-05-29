<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="table-wrapper">
        <div class="table-container" style="overflow: visible !important">

            <div class="table-header bordered-bottom">
                <h3 class="table-title">Volunteer Events and Trainings</h3> 
            </div>
        
            <div class="table-header justify-left">
                    <div class="col-md-3">
                        <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search event...">
                    </div>
                    <div class="v-spacer"></div>
                    <div class="col-md-2 margin-top-mobile">
                        <div class="status-dropdown">
                            <select class="panel-input-1 w" wire:model.live="selectedStatus"> 
                                <option value="">Status</option> 
                                <option value="Ongoing">Ongoing</option> 
                                <option value="Upcoming">Upcoming</option> 
                                <option value="Completed">Completed</option> 
                            </select>
                            <i class="bi bi-caret-down select-icon"></i>
                        </div>
                    </div>
                    <div class="v-spacer"></div>
                    @if(session('user_role') == 'sa' || session('user_role') == 'ips') 
                        <div class="date-filter margin-top-mobile">   
                            <div class="col-md-4">
                                <div class="input-group-radio">
                                    <div class="radio">
                                        <input type="radio" value="start" checked="checked" wire:model.live="filterBy" name="date">
                                        <span>Start date</span>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" value="end" wire:model.live="filterBy" name="date">
                                        <span>End date</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="margin-top: -3px; padding-right: 0; width: 230px">
                                <div class="input-group">
                                    <input class="panel-input-1 w shadowed-left" type="date" wire:model.live="selectedDate" max="{{ now()->format('Y-m') }}">
                                    <div class="reset-date on-desktop">
                                        <i class="bi bi-arrow-clockwise" wire:click='resetDateFilter'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="reset-date on-mobile">
                                <i class="bi bi-arrow-clockwise" wire:click='resetDateFilter'></i>
                            </div>
                        </div>  
                    @endif
                    <div class="v-spacer"></div>
                    @if(session('user_role') === 'sa' || session('user_role') === 'vsa' || session('user_role') === 'vs')
                        <button type="button" class="open-dialog-btn table-button margin-top-mobile" wire:click="eventForm">Add Event/Training</button>
                    @endif
            </div>

            <div class="table-table" id="table-table">
                <div class="table">
                    @foreach($events as $event)
                        <div class="table-tr" style="overflow: visible !important">
                            <div class="table-overlay"></div>
                            <div class="tr" style="padding-bottom: 15px">

                                <div class="primary-data" style="height: fit-content; padding-top: 10px">
                                    <div class="data-row no-padding full-w-on-mobile p-data">
                                        <p class="table-tr-data main-data data-col-full">{{ $event->event_name }}</p>
                                        <p class="table-tr-data data-col-full">Organizer/Facilitator: {{ $event->organizer_facilitator }}</p>
                                        <p class="table-tr-data data-col-full"><span><i class="bi bi-tag"></i></span> {{ $event->event_type  }} • <i class="bi bi-clock"></i></span> {{ $event->volunteer_hours }}</p>
                                        <p class="table-tr-data data-col-full"><span><i class="bi bi-calendar-check"></i></span> {{ $event->start_date }} - {{ $event->end_date }}</p>
                                        <p class="table-tr-data data-col-full">Volunteer Category: {{ $event->volunteer_category }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="table-action-buttons">
                                <div class="event-options">
                                    @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa')
                                        <div class="table-btn-g">
                                            <button class="open-dialog-btn table-action-button t-a-b-success" wire:click="openJoinRequests({{ $event->id }})"><i class="bi bi-person-plus"></i></button>
                                            <span class="hover-p" style="overflow-wrap: none">Join&nbspRequests</span>
                                            <span class="notif-count" style="color: white; background-color: {{ count($joinRequestsData[$event->id] ?? []) > 0 ? 'red' : '#F7F7F7' }}">{{ count($joinRequestsData[$event->id] ?? []) }}</span>
                                        </div>
                                        <div class="mx-2"></div>
                                        <div class="options">
                                            <div class="table-btn-g">
                                                <button class="open-dialog-btn table-action-button t-a-b-submit" wire:click="toggleSettings({{ $event->id }})"><i class="bi bi-gear"></i></button>
                                            </div>
                                        </div>
                                        <div class="mx-2"></div>
                                        <div class="table-btn-g">
                                            <button class="open-dialog-btn table-action-button t-a-b-submit" {{ $event->status !== "Completed" ? 'disabled' : '' }} wire:click="viewParticipants({{ $event->id }}, 'grant')"><i class="bi bi-clock"></i></button>
                                            <span class="hover-p">Grant&nbspHours</span>
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
                                                    <button class="open-dialog-btn table-action-button t-a-b-succes" wire:click="joinEvent({{ $event->id }})">Join</button>
                                                @endif
                                            @endif
                                        @elseif($event->join_status)
                                            <span class="orange">Closed</span>
                                        @endif
                                    @endif
                                </div>

                                <div class="options-hover"></div>

                                <div class="inside-settings-buttons">
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-success" wire:click="viewParticipants({{ $event->id }}, 'participants')"><i class="bi bi-people"></i></button>
                                        <span class="hover-p">Participants</span>
                                    </div>
                                    <div class="mx-2"></div>
                                    @if($event->status !== "Completed")
                                        <div class="table-btn-g">
                                            <button class="table-action-button t-a-b-submit" wire:click="toggleJoinStatus({{ $event->id }})" wire:loading.attr="disabled">
                                                @if($event->join_status == 0)
                                                    <i class="bi bi-x-circle"></i>
                                                @else
                                                    <i class="bi bi-door-open"></i>
                                                @endif
                                            </button>
                                            <span class="hover-p">
                                                @if($event->join_status == 0)
                                                    Close&nbspEvent
                                                @else
                                                    Reopen
                                                @endif
                                            </span>
                                        </div>
                                        <div class="mx-2"></div>
                                    @endif
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-submit" wire:click="openEditForm({{ $event->id }})"><i class="bi bi-pencil-square"></i></button>
                                        <span class="hover-p">Edit</span>
                                    </div>
                                    <div class="mx-2"></div>
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-danger" wire:click="deleteDialog({{ $event->id }})"><i class="bi bi-trash3"></i></button>
                                        <span class="hover-p">Delete</span>
                                    </div>
                                </div>
                            </div>

                            <div class="event-status-wrapper" style=" 
                                @if($event->status === "Completed")
                                    background: rgba(0,255,0,0.03);
                                @elseif($event->status === "Ongoing")
                                    background: rgba(0,0,255,0.03);
                                @else
                                    background: rgba(255,205,0,0.03);
                                @endif
                            ">
                                <div @if($event->status !== "Completed") class="change-stat-container" @endif>
                                    <button  class="btn-status {{ $event->status !== "Completed" ? '' : 'hover-disabled' }}" {{ $event->status === "Completed" ? 'disabled' : '' }}>
                                        {{ $event->status }}
                                    </button>
                                    
                                    <div class="options-container on-desktop">
                                        <p style="margin-bottom: 0">Change Status</p>
                                        <button class="table-button-2 full-width" wire:click="changeStatus({{ $event->id }}, 'Ongoing')">Ongoing</button>
                                        <button class="table-button-2 margin-top full-width" wire:click="changeStatus({{ $event->id }}, 'Completed')">Completed</button>
                                    </div>  

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="m-3">
                {{ $events->links('livewire::bootstrap') }}
            </div>
        
        </div>
        <div class="mt-5"></div>
    </div>

    <div class="popup popup-modal" @if(!$deleteEventId) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="hideDeleteDialog"></div>
        <div class="popup-modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close-dialog-btn close" aria-label="Close" wire:click="hideDeleteDialog" style="float: right;">
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
                        <button class="close-dialog-btn btn-delete" wire:click="deleteEvent" wire:loading.attr="disabled">Yes</button>
                        <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                    @else
                        <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>

        </div>
    </div>    

    <div class="popup popup-panel" @if(!$showForm) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeEventForm"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h4 class="table-title">Add Events and Trainings</h4>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeEventForm">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="create" id="edit-volunteer-form">

                    <div class="panel-form-group">
                        <span>Name of Event <span class="required-mark">*</span></span>
                        <input type="text" class="panel-input-1" name="event_name" id="event-name" placeholder="Enter Event Name" wire:model="eventName" required>
                        @error('eventName') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="panel-form-group">
                        <span>Organizer/Facilitator <span class="required-mark">*</span></span>
                        <input type="text" class="panel-input-1" name="organizer" placeholder="Enter Organizer/Facilitator" wire:model="organizer" required>
                        @error('organizer') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="panel-form-group block-on-mobile">
                        <div class="panel-form-group-2">
                            <span>Start Date <span class="required-mark">*</span></span>
                            <input type="date" class="panel-input-1" name="start_date" id="start-date" wire:model="startDate" required>
                            @error('startDate') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-2">
                            <span>End Date <span class="required-mark">*</span></span>
                            <input type="date" class="panel-input-1" name="end_date" id="end-date" wire:model="endDate" min="{{ $startDate ? $startDate : '' }}" required>
                            @error('endDate') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="panel-form-group block-on-mobile" style="margin-top: -30px">
                        <div class="panel-form-group-2">
                            <span>Number of applicable volunteering hours <span class="required-mark">*</span></span>
                            <input type="number" class="panel-input-1" name="volunteering_hours" placeholder="Enter Number of Hours" wire:model="volunteerHours" required>
                            @error('volunteerHours') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-2">
                            <span>Event Type <span class="required-mark">*</span></span>
                            <select class="panel-input-1" id="event-type" wire:model="eventType" required>
                                <option value="" selected class="label">Choose option</option>
                                <option value="Event">Event</option>
                                <option value="Training">Training</option>
                            </select>
                            <i class="bi bi-caret-down select-icon"></i>
                            @error('eventType') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <div class="panel-form-group" style="margin-top: -30px">
                        <span>Volunteer category who can join</span>
                        <select class="panel-input-1" wire:model="category" required> 
                            <option value="">Categories</option> 
                            @foreach ($categories as $item)
                                <option value="{{ $item->all_categories_name }}">{{ $item->all_categories_name }}</option> 
                            @endforeach 
                        </select>
                        <i class="bi bi-caret-down select-icon" style="right: 60px;"></i>
                        <button type="button" class="theme-btn" wire:click='addTag' style="margin-left: 10px;"><i class="bi bi-plus-lg"></i></button>
                    </div>

                    <div class="panel-form-group" id="added-tags">
                        <span>Added Categories:  <span class="required-mark">*</span></span>
                        @foreach($selectedTags as $tag)
                            <button type="button" class="theme-btn">{{ $tag }} <i class="fa fa-times" wire:click="removeTag('{{ $tag }}')"></i></button>
                        @endforeach
                        @error('category') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="popup-panel-footer">
                        <button type="submit" class="btn-success btn-overide float-right">Submit</button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>

    <div class="popup popup-panel" @if(!$openEditEvent) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeEditForm"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h4 class="table-title">Edit Events and Trainings</h4>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeEditForm">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="editEvent" id="edit-volunteer-form">


                    <div class="panel-form-group">
                        <span>Name of Event <span class="required-mark">*</span></span>
                        <input type="text" class="panel-input-1" name="event_name" id="event-name" placeholder="Enter Event Name" value="{{$eventName}}" wire:model.live="eventName">
                        @error('eventName') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="panel-form-group">
                        <span>Organizer/Facilitator <span class="required-mark">*</span></span>
                        <input type="text" class="panel-input-1" name="organizer" value="{{$organizer}}" wire:model.live="organizer">
                        @error('organizer') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="panel-form-group block-on-mobile">
                        <div class="panel-form-group-2">
                            <span>Start Date <span class="required-mark">*</span></span>
                            <input type="date" class="panel-input-1" name="start_date" id="start-date" value="{{$startDate}}" wire:model.live="startDate">
                            @error('startDate') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-2">
                            <span>End Date <span class="required-mark">*</span></span>
                            <input type="date" class="panel-input-1" name="end_date" id="end-date" value="{{$endDate}}" wire:model.live="endDate" min="{{ $startDate ? $startDate : '' }}">
                            @error('endDate') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    
                    <div class="panel-form-group block-on-mobile" style="margin-top: -30px">
                        <div class="panel-form-group-2">
                            <span>Number of applicable volunteering hours <span class="required-mark">*</span></span>
                            <input type="number" class="panel-input-1" name="volunteering_hours" placeholder="Enter Number of Hours" value="{{$volunteerHours}}" wire:model.live="volunteerHours">
                            @error('volunteerHours') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-2">
                            <span>Event Type <span class="required-mark">*</span></span>
                            <select class="panel-input-1" id="event-type" value="{{$eventType}}" wire:model.live="eventType">
                                <option value="" selected class="label">Choose option</option>
                                <option value="Event">Event</option>
                                <option value="Training">Training</option>
                            </select>
                            <i class="bi bi-caret-down select-icon"></i>
                            @error('eventType') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
    
                    
                    <div class="panel-form-group" style="margin-top: -30px">
                        <span>Volunteer category who can join <span class="required-mark">*</span></span>
                        <select class="panel-input-1" wire:model="category"> 
                            <option value="">Categories</option> 
                            @foreach ($categories as $item)
                                @if($item->id !== 1)
                                    <option value="{{ $item->all_categories_name }}">{{ $item->all_categories_name }}</option> 
                                @endif
                            @endforeach 
                        </select>
                        <i class="bi bi-caret-down select-icon" style="right: 60px;"></i>
                        <button type="button" class="theme-btn" wire:click='addTag' style="margin-left: 10px;"><i class="bi bi-plus-lg"></i></button>
                    </div>

                    <div class="paner-form-group" id="added-tags">
                        <span>Added Categories: </span>
                        @foreach($selectedTags as $tag)
                            <button type="button" class="theme-btn">{{ $tag }} <i class="fa fa-times" wire:click="removeTag('{{ $tag }}')"></i></button>
                        @endforeach
                        @error('category') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
        

                    <div class="popup-panel-footer">
                        <button type="submit" class="btn-success btn-overide float-right">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="popup popup-panel" @if(!$openJoinRequestsTable) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeJoinRequests"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h3 class="table-title">Event and Training Join Requests <br>
                        <span style="font-size: 13px">Requests List</span>
                    </h3>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeJoinRequests">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body no-padding">
                    @if(empty($joinRequestsData[$joinEventId]))
                        <p>No Join Requests Yet...</p>
                    @else
                        @foreach($joinRequestsData[$joinEventId] as $requester)
                            <div class="table-tr no-hover" style="background: #f0f0f0">
                                <div class="table-overlay"></div>
                                <div class="tr" style="padding-bottom: 0">

                                    <div class="primary-data">
                                        <img src="{{ $requester['picture'] }}" style="height: 70px; width: 70px; border-radius: 50%;" wire:click="showParticipantDetails('{{ $requester['user_id'] }}', '')">
                                        <div class="data-row full-w-on-mobile p-data">
                                            <p class="table-tr-data main-data data-col-full hovered-p" wire:click="showParticipantDetails('{{ $requester['user_id'] }}', '')">{{ $requester['name'] }}</p>
                                            <p class="table-tr-data data-col-full">{{ $requester['passport'] }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="table-action-buttons">
                                    <div class="mx-2"></div>
                                    <div class="table-btn-g">
                                        <button class="table-action-button t-a-b-success" wire:click="approveParticipant('{{ $requester['user_id'] }}')" style="padding-right: 3px !important">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <p class="hover-p" style="background: white">Approve</p>
                                    </div>
                                    <div class="mx-2"></div>
                                    <div class="table-btn-g">
                                        <button class="table-action-button t-a-b-warning" wire:click="disapproveParticipant('{{ $requester['user_id'] }}')" style="padding-right: 3px !important">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <p class="hover-p" style="background: white">Disapprove</p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="popup popup-panel" @if(!$volunteerEvent) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeJoinRequests"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px; position: relative">

                <button type="button" class="close-dialog-btn close close-3" wire:click="closeParticipantsForm">
                    <span>&times;</span>
                </button>

                @if($volunteerEvent)
                    <div class="popup-panel-header">
                        <h3 class="table-title">Event: {{ $volunteerEvent->event_name }}<br>
                            <span style="font-size: 13px">Participant/s List</span>
                        </h3>
                    </div>

                    <div class="modal-body no-padding">
                        @if(!empty($participants) && $type === 'participants')
                            <div class="participant-list-header">
                                <label style="font-weight: 500;"><b>{{ count($participants) }}</b> Participant/s</label>
                                <button class="table-button" wire:click="exportParticipantsList({{ $volunteerEvent->id }})" wire:loading.attr='disabled' style="margin-bottom: 10px">
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
                            @if($type !== 'participants')
                                <div class="grant-hours-thead">
                                    <span>No. of Volunteer Hours Granted</span>
                                </div>
                            @endif
                            @foreach($participants as $participant)
                                <div class="table-tr-2 no-hover">

                                    @if($type === 'participants')
                                        <div class="primary-data-2">
                                            <img src="{{ $participant['picture'] }}" wire:click="showParticipantDetails('{{ $participant['id'] }}', '')">
                                            <div class="data-row full-w-on-mobile p-data">
                                                <p class="table-tr-data main-data data-col-full hovered-p" wire:click="showParticipantDetails('{{ $participant['id'] }}', '')">{{ $participant['name'] }} <br>
                                                    <span style="font-size: 13px; font-weight:400">{{ $participant['passport'] }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <p class="main-data" wire:click="showParticipantDetails('{{ $participant['id'] }}', '')" style="margin-bottom: 0; cursor: pointer">{{ $participant['name'] }} <br>
                                        <span style="font-size: 13px; font-weight:400">{{ $participant['passport'] }}</span>
                                        </p>
                                    @endif

                                    @if($volunteerEvent->status !== "Completed" && $type === 'participants')
                                        <div class="table-btn-g">
                                            <button class="open-dialog-btn table-action-button t-a-b-danger" wire:click="disapproveParticipant('{{ $participant['id'] }}')"><i class="bi bi-x-lg"></i></button>
                                            <span class="hover-p" style="background: white">Remove</span>
                                        </div>
                                    @elseif($volunteerEvent->status === "Completed" && $type === 'grant')
                                        @if(!$participant['hoursGranted'])
                                            <form class="grant-hours-form" wire:submit.prevent="grantHours('{{ $participant['id'] }}', {{ $volunteerEvent->id }})">
                                                <div class="btn-approval">
                                                    <span class="grant-label">Grant Hours</span>
                                                    <input class="panel-input-1 w" type="number" wire:model="hours.{{ $participant['id'] }}" required>
                                                    <button class="btn-grant" type="submit"><i class="bi bi-check-lg"></i></button>
                                                </div>
                                                @error('hours.' . $participant['id'])
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </form>
                                        @else
                                            <div class="granted-hours">
                                                <p><i class="bi bi-clock"></i> {{ $participant['hoursGranted'] }}<br>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>

    @if($thisUserDetails)
        <div class="popup popup-panel">
            <div class="panel-content-wrapper">
                <div class="popup-panel-content" style="margin-left: 5px; position: relative">

                    <button type="button" class="close close-3" wire:click="hideUserData">
                        <span>&times;</span>
                    </button>
                    <div class="mt-5"></div>
                    <div class="tr">
                        <div class="secondary-data">

                            <img src="{{ $thisUserDetails['profile_picture'] }}" style="height: 70px; width: 70px; border-radius: 50%;">
                            <div class="data-row full-w-on-mobile p-data">
                                <p class="table-tr-data main-data data-col-full">{{ $thisUserDetails['first_name'] }} {{ $thisUserDetails['middle_name'] }} {{ $thisUserDetails['last_name'] }}</p>
                                <p class="table-tr-data data-col-full">Passport Number: {{ $thisUserDetails['passport_number'] }}</p>
                            </div>

                            <div class="data-row on-mobile m-margin-top">
                                <p class="table-tr-data"><span>Nickname: </span>{{ $thisUserDetails['nickname'] }}</p>
                                <p class="table-tr-data"><span>Age: </span>{{ $thisUserDetails['age'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data"><span>Sex at Birth: </span>{{ $thisUserDetails['sex'] }}</p>
                                <p class="table-tr-data"><span>Date of Birth: </span>{{ $thisUserDetails['date_of_birth'] }}</p>
                            </div>
                            
                            <div class="data-row on-mobile">
                                <p class="table-tr-data"><span>Nationality: </span>{{ $thisUserDetails['nationality'] }}</p>
                                <p class="table-tr-data"><span>Blood Type: </span>{{ $thisUserDetails['blood_type'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data"><span>Civil Status: </span>{{ $thisUserDetails['civil_status'] }}</p>
                                <p class="table-tr-data"><span>Email: </span>{{ $thisUserDetails['email'] }}</p>

                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data"><span>Tel Number: </span>{{ $thisUserDetails['tel_number'] }}</p>
                                <p class="table-tr-data"><span>Mobile Number: </span>{{ $thisUserDetails['mobile_number'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data data-col-full"><span>Permanent Address: </span>{{ $thisUserDetails['p_street_barangay'] }}, {{ $thisUserDetails['permanent_selectedCity'] }}, {{ $thisUserDetails['permanent_selectedProvince'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data data-col-full"><span>Residential Address: </span>{{ $thisUserDetails['r_street_barangay'] }}, {{ $thisUserDetails['residential_selectedCity'] }}, {{ $thisUserDetails['residential_selectedProvince'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data data-col-full"><span>Educational Background: </span>{{ $thisUserDetails['educational_background'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                <p class="table-tr-data data-col-full"><span>Status: </span>{{ $thisUserDetails['status'] }}</p>
                            </div>

                            <div class="data-row on-mobile">
                                @if($thisUserDetails['status'] === 'PROFESSIONAL')
                                    <p class="table-tr-data"><span>Nature of Work: </span>{{ $thisUserDetails['nature_of_work'] }}</p>
                                    <p class="table-tr-data"><span>Employer: </span>{{ $thisUserDetails['employer'] }}</p>
                                @elseif($thisUserDetails['status'] === 'STUDENT')
                                    <p class="table-tr-data"><span>Name of School: </span>{{ $thisUserDetails['name_of_school'] }}</p>
                                    <p class="table-tr-data"><span>Course: </span>{{ $thisUserDetails['course'] }}</p>
                                @endif
                            </div>

                            @if($thisUserDetails['organization_name'])
                                <div class="data-row on-mobile">
                                <p class="table-tr-data"><span>Organization Name: </span>{{ $thisUserDetails['organization_name'] }}</p>
                                    <p class="table-tr-data"><span>Position: </span>{{ $thisUserDetails['org_position'] }}</p>
                                </div>
                            @endif

                            @if($thisUserDetails)
                                <div class="other-details on-mobile">

                                    <table class="other-details-table">
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
                                                    <td style="color: #ccc;">
                                                    No Categories Yet
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <table class="other-details-table">
                                        <thead>
                                            <tr>
                                                <th  width="40%">Experience</th>
                                                <th  width="60%"></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr style="background: #EFEFEF; border-top: 1px solid #f5f5f5;">
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
                                                    <td style="color: #ccc;">
                                                        No Experience Yet
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <table class="other-details-table">
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
                            @endif
                            
                            <div class="data-row center on-mobile">
                                @if(!$isParticipant)
                                    <div class="table-btn-g w-35">
                                        <button class="open-dialog-btn btn-success" wire:click="approveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled"><i class="bi bi-check-lg"></i>
                                        </button>
                                        <p class="hover-p-2">Approve</p>
                                    </div>
                                    <div class="table-btn-g w-35">
                                        <button class="open-dialog-btn btn-warning" wire:click="disapproveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled"><i class="bi bi-x-lg"></i>
                                        </button>
                                        <p class="hover-p-2">Disapprove</p>
                                    </div>
                                @elseif($volunteerEvent->status !== "Completed")
                                    <div class="table-btn-g w-35">
                                        <button class="open-dialog-btn btn-delete" wire:click="disapproveParticipant('{{ $thisUserDetails['user_id'] }}')" wire:loading.attr="disabled"><i class="bi bi-trash3"></i>
                                        </button>
                                        <p class="hover-p-2">Remove</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-5"></div>
                </div>
                
            </div>
        </div> 
    @endif  

</div>