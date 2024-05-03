<div>

    <div class="container mt-4 {{ $selectedUserDetails ? 'hide-table' : '' }}">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <h3 class="card-title">IP Beneficiaries Management</h3> 
                        <div class="top-buttons">
                            <button type="button" class="btn btn-submit btn-accounts" style="float: right;" wire:click="deactivatedAccounts">
                                @if($active_status === 1)
                                    <div class="is-mobile-view">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <div class="is-desktop-view">
                                        Deactivated Accounts
                                    </div>
                                @else
                                    <div class="is-mobile-view">
                                        <i class="fas fa-user-check"></i>                                
                                    </div>
                                    <div class="is-desktop-view">
                                        Active Accounts
                                    </div>
                                @endif
                            </button>
                            @if($active_status === 1)
                                <span style="color:white; background-color: {{ count($deactivatedIPs) > 0 ? 'red' : 'rgb(245, 245, 245)' }}">{{ count($deactivatedIPs) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-2">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model.live="civil_status">
                                <option selected disabled>Civil Status</option>
                                <option class="label" value="Single">Single</option>
                                <option class="label" value="Married">Married</option>
                                <option class="label" value="Widowed">Widowed</option>
                                <option class="label" value="Legally Separated">Legally Separated</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model.live="age_range">
                                <option disabled selected>Age</option>
                                @foreach($ageRange as $age)
                                    <option value="{{ $age->age }}">{{ $age->age }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select wire:model.live="selectedProvince" id="province" class="form-control">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_description }}">{{ $province->province_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="city" class="form-control" wire:model.live="selectedCity">
                                <option value="">Select City</option>
                                @if($cities)
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_municipality_description }}">{{ $city->city_municipality_description }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="card-header card-header1">
                        <label class="label" style="color: {{ $active_status === 2 ? 'red' : 'green' }}">
                            @if($active_status === 2)
                                Deactivated Accounts  
                            @else
                                Active Accounts 
                            @endif
                            <span> | </span>
                        </label>
                        <label class="label"> Number of Results: <span>{{ count($volunteers )}}</span></label>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
        
                        <table id="volunteers-table" class="table-main">
                            <thead>
                                <tr>
                                    <th class="th-border-rad">Passport Number</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Nickname</th>
                                    <th>Tel Number</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Sex at Birth</th>
                                    <th>Age</th>
                                    <th>Date of Birth</th>
                                    <th>Civil Status</th>
                                    <th>Nationality</th>
                                    <th>Blood Type</th>
                                    <th>Permanent Address</th>
                                    <th>Residential Address</th>
                                    <th>Educational Background</th>
                                    <th>Status</th>
                                    <th>Work/School</th>
                                    <th>Employer/Course</th>
                                    <th class="action-btn width th-action-btn"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    <tr>
                                        <td>{{ $volunteer->passport_number }}</td>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->middle_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>{{ $volunteer->nickname }}</td>
                                        <td>{{ $volunteer->tel_number }}</td>
                                        <td>{{ $volunteer->mobile_number }}</td>
                                        <td>{{ $volunteer->email }}</td>
                                        <td>{{ $volunteer->sex }}</td>
                                        <td>{{ $volunteer->age }}</td>
                                        <td>{{ $volunteer->date_of_birth }}</td>
                                        <td>{{ $volunteer->civil_status }}</td>
                                        <td>{{ $volunteer->nationality }}</td>
                                        <td>{{ $volunteer->blood_type }}</td>
                                        <td class="label-capitalize">{{ $volunteer->p_street_barangay }}, {{ $volunteer->permanent_selectedCity }}, {{ $volunteer->permanent_selectedProvince }}</td>
                                        <td class="label-capitalize">{{ $volunteer->r_street_barangay }}, {{ $volunteer->residential_selectedCity }}, {{ $volunteer->residential_selectedProvince }}</td>
                                        <td>{{ $volunteer->educational_background }}</td>
                                        <td>{{ $volunteer->status }}</td>
                                        @if($volunteer->status == "Professional")
                                            <td>{{ $volunteer->nature_of_work }}</td>
                                            <td>{{ $volunteer->employer }}</td>
                                        @elseif($volunteer->status == "Student")
                                            <td>{{ $volunteer->name_of_school }}</td>
                                            <td>{{ $volunteer->course }}</td>
                                        @else
                                            <td style="color: #ccc;">N/A</td>
                                            <td style="color: #ccc;">N/A</td>
                                        @endif
                                        <td class="action-btn width">
                                            <div class="btn-group-2" role="group">
                                                <div class="btn-g">
                                                    <button class="btn-submit" wire:click="showUserData('{{ $volunteer->user_id }}')">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <span class="span span-submit">View</span>
                                                </div>
                                                <div class="mx-2"></div>
                                                @if(session('user_role') !== 'vsa')
                                                    @if($active_status === 2)
                                                        <div class="btn-g">
                                                            <button class="btn-success" wire:click="reactivateDialog('{{ $volunteer->user_id }}')">
                                                                <i class="bi bi-person-check"></i>
                                                            </button>
                                                            <span class="span span-delete">Activate</span>
                                                        </div>
                                                    @elseif($active_status === 1) 
                                                        <div class="btn-g">
                                                            <button class="btn-warning" wire:click="deactDialog('{{ $volunteer->user_id }}')">
                                                                <i class="bi bi-ban"></i>
                                                            </button>
                                                            <span class="span span-delete">Deactivate</span>
                                                        </div>
                                                    @endif
                                                    <div class="mx-2"></div>
                                                    <div class="btn-g">
                                                        <button class="btn-delete" wire:click="deleteDialog('{{ $volunteer->user_id }}')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                        <span class="span span-delete">Delete</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="m-3">
                        {{ $volunteers->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

    @if($deleteVolunteerId)
        <div class="users-data-all-container no-padding">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info user-infos">
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
                        <p>Are you sure you want to delete this volunteer?</p>
                    @endif
                </div>
                
                <div class="modal-footer">
                    @if($disableButton == "No")
                        <button class="btn-delete" wire:click="deleteVolunteer('{{ $deleteVolunteerId }}')" wire:loading.attr="disabled">Yes
                        </button>
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                    @else
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>
            </div>
        </div>    
    @endif

    @if($deactVolunteerId)
        <div class="users-data-all-container no-padding">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info user-infos">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deactivate</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($deleteMessage)
                        <p style="color: green;">{{ $deleteMessage }}</p>
                    @else
                        <p>Are you sure you want to deactivate this volunteer?</p>
                    @endif
                </div>
                
                <div class="modal-footer">
                    @if($disableButton == "No")
                        <button class="btn-delete" wire:click="deactivateVolunteer('{{ $deactVolunteerId }}')" wire:loading.attr="disabled">Yes</button>
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                    @else
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>
            </div>
        </div>    
    @endif

    @if($reactivateVolunteerId)
        <div class="users-data-all-container no-padding">
            <div class="close-form" wire:click="hideReactivateDialog"></div>
            <div class="user-info user-infos">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Activation</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($deleteMessage)
                        <p style="color: green;">{{ $deleteMessage }}</p>
                    @else
                        <p>Are you sure you want to activate this volunteer?</p>
                    @endif
                </div>
                
                <div class="modal-footer">
                    @if($disableButton == "No")
                        <button class="btn-submit" wire:click="reactivateVolunteer('{{ $reactivateVolunteerId }}')" wire:loading.attr="disabled">Yes
                        </button>
                        <button class="btn-cancel" wire:click="hideReactivateDialog">Cancel</button>
                    @else
                        <button class="btn-cancel" wire:click="hideReactivateDialog">Close</button>
                    @endif
                </div>
            </div>
        </div>    
    @endif

    @if($selectedUserDetails)
        <div class="user-details">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card" style="border-radius: 20px; overflow: hidden;">

                            <div class="reg-logo-container text-center">
                                <img src="images/yvip_logo.png" width="100"/>
                            </div>

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ $selectedUserDetails['profile_picture'] }}" class="card-img-top" alt="Passport Image" style="max-width: 100%; height: auto; display: block; border-radius: 5px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="card-text" style="font-family: Arial, sans-serif;">
                                            Passport No. : {{ $selectedUserDetails['passport_number'] }}
                                            <br>
                                            Full Name : {{ $selectedUserDetails['first_name'] }} {{ $selectedUserDetails ? $selectedUserDetails['middle_name'] : '' }} {{ $selectedUserDetails['last_name'] }}
                                            <br>
                                            Nationality : {{ $selectedUserDetails['nationality'] }}
                                            <br>
                                            Age : {{ $selectedUserDetails['age'] }}
                                            <br> 
                                            Sex : {{ $selectedUserDetails['sex'] }}
                                            <br>
                                            Date of Birth: <span>{{ $selectedUserDetails ? $selectedUserDetails['date_of_birth'] : '' }}</span>
                                        </p>
                                    </div>
                                    <!-- QR Code Section -->
                                    <div class="col-md-3 text-center">
                                        <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 100px; height: auto;" class="mx-auto">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="volunteers-table" class="table-main">
                                    <thead>
                                        <tr>
                                            <th  width="100%" class="th-border-rad-2">Personal Data</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @if($selectedUserDetails['nickname'])
                                        <tr>
                                            <td>Nickname : {{ $selectedUserDetails['nickname'] }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td style="display:flex;">
                                                <span style="width: 50%;">Civil Status : {{ $selectedUserDetails['civil_status'] }}</span>
                                                <span style="width: 50%;">Blood Type : {{ $selectedUserDetails['blood_type'] }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="display:flex;">
                                                <span style="width: 50%;">Tel Number : {{ $selectedUserDetails['tel_number'] }}</span>
                                                <span style="width: 50%;">Mobile Number : {{ $selectedUserDetails['mobile_number'] }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="display:flex;">
                                                <span style="width: 50%;">Email : {{ $selectedUserDetails['email'] }}</span>
                                                <span style="width: 50%;">Educational Background : {{ $selectedUserDetails['educational_background'] }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Permanent Address : {{ $selectedUserDetails['p_street_barangay'] }}, {{ $selectedUserDetails['permanent_selectedCity'] }}, {{ $selectedUserDetails['permanent_selectedProvince'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Residential Address : {{ $selectedUserDetails['r_street_barangay'] }}, {{ $selectedUserDetails['residential_selectedCity'] }}, {{ $selectedUserDetails['residential_selectedProvince'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status : {{ $selectedUserDetails['status'] }}</td>
                                        </tr>
                                        @if($selectedUserDetails['name_of_school'])
                                        <tr>
                                            <td style="display:flex;">
                                                <span style="width: 50%;">School Name : {{ $selectedUserDetails['name_of_school'] }}</span>
                                                <span style="width: 50%;">Course : {{ $selectedUserDetails['course'] }}</span>  
                                            </td>                            
                                        </tr>
                                        @endif
                        
                                        @if($selectedUserDetails['nature_of_work'])
                                        <tr>
                                            <td style="display:flex;">
                                                <span style="width: 50%;">Nature of Work : {{ $selectedUserDetails['nature_of_work'] }}</span>                                         
                                                <span style="width: 50%;">Employer : {{ $selectedUserDetails['employer'] }}</span>
                                            </td>   
                                        </tr>
                                        @endif
                        
                                        @if($selectedUserDetails['organization_name'])
                                        <tr>
                                            <td style="display:flex;">    
                                                <span style="width: 50%;">Organization Name : {{ $selectedUserDetails['organization_name'] }}</span>    
                                                <span style="width: 50%;">Position : {{ $selectedUserDetails['org_position'] }}</span>
                                            </td>   
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3"></div>
                                <div class="row1">
                                    <div class="col">
                                        <div class="user-data">
                                            @if($active_status === 2)
                                                <button class="btn-success" wire:click="reactivateDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Activate</button>
                                            @else
                                                <button class="btn-success" wire:click="exportToPdf" wire:loading.attr="disabled">Export Data</button>
                                                <button class="btn-warning" wire:click="deactDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Deactivate</button>
                                            @endif
                                            <button class="btn-delete" wire:click="deleteDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Delete</button>
                                            <button class="btn-cancel" wire:click="hideUserData">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                
                            </div>

                        </div>
                        <div class="mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
