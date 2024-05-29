<div class="main-contents">

    <div class="table-wrapper">
        <div class="table-container">

            <div class="table-header bordered-bottom">
                <h3 class="table-title">Past Participated IP Events</h3> 
            </div>

            <div class="table-header justify-left">
                <div class="col-md-3">
                    <input type="search" class="panel-input-1 w" wire:model.live="searchQuery" placeholder="Search...">
                </div>
                <div class="v-spacer"></div>
                <div class="col-md-3 margin-top-mobile">
                    <div class="status-dropdown">
                        <select class="panel-input-1 w" wire:model.live="status"> 
                            <option value="">Status</option> 
                            <option value="0">Pending</option> 
                            <option value="1">Confirmed</option> 
                        </select>
                        <i class="bi bi-caret-down select-icon"></i>
                    </div>
                </div>
                <div class="v-spacer"></div>
                <div class="col-md-3 margin-top-mobile">
                    <div class="status-dropdown">
                        <select class="panel-input-1 w" wire:model.live="event"> 
                            <option value="">Event</option> 
                            @foreach ($addedPastEventNames as $addedEvent)
                                <option value="{{ $addedEvent }}">{{ $addedEvent }}</option> 
                            @endforeach
                        </select>
                        <i class="bi bi-caret-down select-icon"></i>
                    </div>
                </div>
                <div class="v-spacer"></div>
                <div class="col-md-3 margin-top-mobile">
                    <div class="status-dropdown">
                        <select class="panel-input-1 w" wire:model.live="category"> 
                            <option value="">Category</option> 
                            <option value="">Select Sponsor Category</option>
                            <option value="Fully Sponsored">Fully Sponsored</option>
                            <option value="Accommodation was sponsored">Accommodation was sponsored</option>
                            <option value="Airfare was sponsored">Airfare was sponsored</option>
                            <option value="At own expense">At own expense</option>
                        </select>
                        <i class="bi bi-caret-down select-icon"></i>
                    </div>
                </div>
            </div>

            <div class="table-header justify-left" style="position: relative">
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
                <div class="v-spacer"></div>
                <div class="top-buttons" style="position: absolute; right: 0">
                    <button type="button" class="table-button float-right margin-l-t" wire:click="openAddEventModal">Add Event</button>
                </div>
            </div>

            <div class="table-table" id="table-table"  style="margin-top: 50px !important">
                <div class="table">
                    @foreach($pastIpEvents as $event)
                        
                        <div class="table-tr" style="overflow: visible !important">
                            <div class="table-overlay"></div>

                            <div class="tr" style="padding-bottom: 15px">
                                <div class="primary-data" style="height: fit-content; padding-top: 10px">
                                    <div class="data-row no-padding full-w-on-mobile p-data">
                                        <p class="table-tr-data main-data data-col-full">{{ $event->user->name }}</p>
                                        <p class="table-tr-data sub-main-data data-col-full">Event: {{ $event->event_name }}</p>
                                        <p class="table-tr-data data-col-full">Organizer/Facilitator: {{ $event->organizer_sponsor }}</p>
                                        <p class="table-tr-data data-col-full"><span><i class="bi bi-calendar-check"></i></span> {{ $event->start }} - {{ $event->end }}</p>
                                        <p class="table-tr-data data-col-full"><span><i class="bi bi-tag"></i></span> {{ $event->sponsor_category  }}</p>
                                        <p class="table-tr-data data-col-full {{ $event->confirmed ? 'green' : 'red' }}" style="margin-top: 5px !important">{{ $event->confirmed ? 'Confirmed' : 'Pending' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="table-action-buttons">
                                @if (!$event->confirmed)
                                    <div class="mx-2"></div>
                                    <div class="btn-g">
                                        <button type="button" class="table-action-button t-a-b-success" wire:click="openApproveEvent({{ $event->id }})">
                                            <i class="bi bi-check2-circle"></i>
                                        </button>
                                        <span class="hover-p">Approve</span>
                                    </div>
                                @endif
                                <div class="mx-2"></div>
                                <div class="table-btn-g">
                                    <button class="open-dialog-btn table-action-button t-a-b-submit" wire:click="editEvent({{ $event->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <p class="hover-p">Edit</p>
                                </div>
                                <div class="mx-2"></div>
                                <div class="table-btn-g">
                                    <button class="open-dialog-btn table-action-button t-a-b-danger" wire:click="deleteEvent({{ $event->id }})">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                    <p class="hover-p">Delete</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="m-3">
                {{ $pastIpEvents->links('livewire::bootstrap') }}
            </div>
            
        </div>
        <div class="mt-5"></div>
    </div>

    <div class="popup popup-panel" @if(!$openAddEvent) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeAddEventModal"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h4 class="table-title">Past Paticipated IP Event</h4>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeAddEventModal">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="saveEvent">

                        <div class="panel-form-group">
                            <span>Participant <span class="required-mark">*</span></span>
                            @if(!$editEventId)
                                <select class="panel-input-1" id="userId" wire:model.defer="userId" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <i class="bi bi-caret-down select-icon"></i>
                            @else
                                <input type="text" class="panel-input-1" id="userId" value="{{ $userName }}" disabled>
                                <input type="hidden" wire:model.defer="userId">
                            @endif
                            @error('userId') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="panel-form-group">
                            <span>Name of Event <span class="required-mark">*</span></span>
                            <input type="text" class="panel-input-1" id="eventName" placeholder="Enter event name" wire:model.defer="eventName" required>
                            @error('eventName') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="panel-form-group block-on-mobile">
                            <div class="panel-form-group-2">
                                <span>Organizer / Sponsor<span class="required-mark">*</span></span>
                                <input type="text" class="panel-input-1" id="organizerSponsor" placeholder="Enter organizer / sponsor" wire:model.defer="organizerSponsor" required>
                                @error('organizerSponsor') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="v-spacer"></div>
                            <div class="panel-form-group-2">
                                <span>Sponsor Category <span class="required-mark">*</span></span>
                                <select class="panel-input-1" id="sponsorCategory" wire:model.defer="sponsorCategory" required>
                                    <option value="">Select Sponsor Category</option>
                                    <option value="Fully Sponsored">Fully Sponsored</option>
                                    <option value="Accommodation was sponsored">Accommodation was sponsored</option>
                                    <option value="Airfare was sponsored">Airfare was sponsored</option>
                                    <option value="At own expense">At own expense</option>
                                </select>
                                <i class="bi bi-caret-down select-icon"></i>
                                @error('sponsorCategory') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="panel-form-group block-on-mobile" style="margin-top: -30px">
                            <div class="panel-form-group-2">
                                <span>Date Start <span class="required-mark">*</span></span>
                                <input type="date" class="panel-input-1" id="dateStart" placeholder="Enter date start" wire:model.defer="dateStart" required>
                                @error('dateStart') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="v-spacer"></div>
                            <div class="panel-form-group-2">
                                <span>Date End <span class="required-mark">*</span></span>
                                <input type="date" class="panel-input-1" id="dateEnd" placeholder="Enter date end" wire:model.defer="dateEnd" required>
                                @error('dateEnd') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        
                        <div class="popup-panel-footer">
                            <button type="submit" class="btn-success btn-overide float-right">Save</button>
                            <button type="button" class="close-dialog-btn btn-cancel btn-overide float-right" wire:click="closeAddEventModal">Cancel</button>
                        </div>

                </form>

            </div>
        </div>
    </div>

    <div class="popup popup-modal" @if(!$approveEventId) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="cancelApproval"></div>
        <div class="popup-modal-content h-fit-content">

                <div class="modal-header">
                    <h5 class="modal-title">Approve Event</h5>
                    <button type="button" class="close-dialog-btn close" wire:click="cancelApproval">
                        <span>&times;</span>
                    </button>
                </div>

                @if($approveEventId)
                    <div class="modal-body">
                        <p><strong>User:</strong> {{ $event->user->name }}</p>
                        <p><strong>Event Name:</strong> {{ $event->event_name }}</p>
                        <p><strong>Organizer / Sponsor:</strong> {{ $event->organizer_sponsor }}</p>
                        <p><strong>Sponsor Category:</strong> {{ $event->sponsor_category }}</p>
                        <p><strong>Date / Period:</strong> {{ $event->start }} - {{ $event->end }}</p>
                    </div>
                @endif

                <div class="modal-footer">
                    <button type="button" class="close-dialog-btn btn-cancel" wire:click="cancelApproval">Cancel</button>
                    <button type="button" class="btn-submit" wire:click="approveEvent" wire:loading.attr="disabled" wire:target="approveEvent">Approve</button>
                </div>

        </div>
    </div>

    <div  class="popup popup-modal" @if(!$confirmingDelete) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="$set('confirmingDelete', false)"></div>
        <div class="popup-modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" wire:click="$set('confirmingDelete', false)">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this event?
            </div>

            <div class="modal-footer">
                <button type="button" class="close-dialog-btn btn-cancel" wire:click="$set('confirmingDelete', false)">Cancel</button>
                <button type="button" class="close-dialog-btn btn-delete" wire:click="confirmDelete">Delete</button>
            </div>

        </div>
    </div>
    
</div>
