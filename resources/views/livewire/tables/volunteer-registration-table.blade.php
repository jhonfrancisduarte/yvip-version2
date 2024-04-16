<section class="content volunteers-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="container-fluid">
        <div class="row volunteer-row">
            <div class="col-12 table-contain">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Volunteer Registrations Management</h3> 
                    </div>

                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        {{-- <label for="" class="label" style="margin-top: 5px;">Status: </label>
                        <div class="col-md-2">
                            <select class="form-control" wire:model.live="status">
                                <option class="label" selected>Status</option>
                                <option class="label" value="0">Pending</option>
                                <option class="label" value="1">Approved</option>
                            </select>
                        </div> --}}
    
                    </div>
                    <div class="card-header card-header1">
                        <label class="label">Number of Results: <span>{{ count($volunteers )}}</span></label>
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Passport Number</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th width="7%" class="action-btn">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    <tr>
                                        <td>{{ $volunteer->passport_number }}</td>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->middle_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>{{ $volunteer->email }}</td>
                                        <td> 
                                            @if($volunteer->active_status === 0)
                                                <p class="red">Pending</p>
                                            @else
                                                <p class="green">Active</p>
                                            @endif
                                        </td>
                                        <td class="action-btn">
                                            <button class="btn btn-info btn-xs" wire:click="showUserData({{ $volunteer->user_id }})">View</button>
                                            <button class="btn btn-success btn-xs" wire:click="approveUser({{ $volunteer->user_id }})">Approve</button>
                                            <button class="btn btn-danger btn-xs" wire:click="deleteDialog({{ $volunteer->user_id }})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Passport Number</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th width="7%" class="action-btn">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($deleteRegistrantId)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info">

                <div class="row1 row-header">
                    <div class="col1">
                        @if($deleteMessage)
                            <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                        @else
                            <label class="label">Are you sure you want to delete this registrant?</label>
                        @endif
                    </div>
                </div>
                
                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            @if($disableButton == "No")
                                <button class="btn-danger btn-50" wire:click="deleteRegistrant({{ $deleteRegistrantId }})" wire:loading.attr="disabled">Yes
                                    {{-- <div class="loader" wire:loading></div> --}}
                                </button>
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

    @if($selectedUserDetails)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideUserData"></div>
            <div class="user-info">
                <div class="row1">
                    <div class="col1">
                        <img src="{{ $selectedUserDetails['profile_picture'] }}" alt="" width="100" style="border-radius: 10px;">
                    </div>
                </div>
                <div class="row1  row-header">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Passport Number: <span>{{ $selectedUserDetails ? $selectedUserDetails['passport_number'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Registration Status: <span class="red">@if($selectedUserDetails['active_status'] === 0)Pending @endif</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Firstname: <span>{{ $selectedUserDetails ? $selectedUserDetails['first_name'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Lastname: <span>{{ $selectedUserDetails ? $selectedUserDetails['last_name'] : '' }}</span></label>
                        </div>
                    </div>
                </div>
                
                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Middlename: <span>{{ $selectedUserDetails ? $selectedUserDetails['middle_name'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Nickname: <span>{{ $selectedUserDetails ? $selectedUserDetails['nickname']: '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Date of Birth: <span>{{ $selectedUserDetails ? $selectedUserDetails['date_of_birth'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Civil Status: <span>{{ $selectedUserDetails ? $selectedUserDetails['civil_status'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Age: <span>{{ $selectedUserDetails ? $selectedUserDetails['age'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Nationality: <span>{{ $selectedUserDetails ? $selectedUserDetails['nationality'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Tel Number: <span>{{ $selectedUserDetails ? $selectedUserDetails['tel_number'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Mobile Number: <span>{{ $selectedUserDetails ? $selectedUserDetails['mobile_number'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Email: <span>{{ $selectedUserDetails ? $selectedUserDetails['email'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Blood Type: <span>{{ $selectedUserDetails ? $selectedUserDetails['blood_type'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Sex at Birth: <span>{{ $selectedUserDetails ? $selectedUserDetails['sex'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Educational Background: <span>{{ $selectedUserDetails ? $selectedUserDetails['educational_background'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col1">
                        <label class="label">Permanent Adrress: <span>{{ $volunteer->p_street_barangay }} {{ $volunteer->permanent_selectedCity }} {{ $volunteer->permanent_selectedProvince }}</span></label>
                    </div>
                </div>

                <div class="row1">
                    <div class="col1">
                        <label class="label">Residential Adrress: <span>{{ $volunteer->r_street_barangay }} {{ $volunteer->residential_selectedCity }} {{ $volunteer->residential_selectedProvince }}</span></label>
                    </div>
                </div>

                <div class="row1">
                    <div class="col1">
                        <label class="label">Status: <span>{{ $selectedUserDetails ? $selectedUserDetails['status'] : '' }}</span></label>
                    </div>
                </div>

                @if($selectedUserDetails['name_of_school'])
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">School Name: <span>{{ $selectedUserDetails ? $selectedUserDetails['name_of_school'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Course: <span>{{ $selectedUserDetails ? $selectedUserDetails['course'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                @endif

                @if($selectedUserDetails['nature_of_work'])
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Nature of Work: <span>{{ $selectedUserDetails ? $selectedUserDetails['nature_of_work'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Employer: <span>{{ $selectedUserDetails ? $selectedUserDetails['employer'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                @endif

                @if($selectedUserDetails['organization_name'])
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Organization Name: <span>{{ $selectedUserDetails ? $selectedUserDetails['organization_name'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Position: <span>{{ $selectedUserDetails ? $selectedUserDetails['org_position'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Youth Volunteer: 
                                <span>
                                    <input type="checkbox" class="checkbox" {{ $selectedUserDetails && $selectedUserDetails['is_volunteer'] ? 'checked' : '' }} disabled>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">IP Parcicipant: 
                                <span>
                                    <input type="checkbox" class="checkbox" {{ $selectedUserDetails && $selectedUserDetails['is_ip_participant'] ? 'checked' : '' }} disabled>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            <button class="btn-green" wire:click="approveUser({{ $selectedUserDetails['user_id'] }})" wire:loading.attr="disabled">Approve</button>
                            <button class="btn-close-user-data" wire:click="hideUserData">Close</button>
                            <button class="btn-danger" wire:click="deleteDialog({{ $selectedUserDetails['user_id'] }})" wire:loading.attr="disabled">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif

</section>
