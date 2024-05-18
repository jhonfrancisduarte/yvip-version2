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
                                @elseif($active_status === 2)
                                    <div class="is-mobile-view">
                                        <i class="fas fa-user-check"></i>                                
                                    </div>
                                    <div class="is-desktop-view">
                                        Active Accounts
                                    </div>
                                @elseif($active_status === 3)
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
                        <div class="col-md-2">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        <div class="col-md-2 margin-top-mobile">
                            <select class="form-control" wire:model.live="civil_status">
                                <option selected value="">Civil Status</option>
                                <option class="label" value="Single">Single</option>
                                <option class="label" value="Married">Married</option>
                                <option class="label" value="Widowed">Widowed</option>
                                <option class="label" value="Legally Separated">Legally Separated</option>
                            </select>
                        </div>
                        <div class="col-md-2 margin-top-mobile">
                            <select class="form-control" wire:model.live="age_range">
                                <option value="" selected>Age</option>
                                @foreach($ageRange as $age)
                                    <option value="{{ $age->age }}">{{ $age->age }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 margin-top-mobile">
                            <select wire:model.live="selectedProvince" id="province" class="form-control">
                                <option selected value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_description }}">{{ $province->province_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 margin-top-mobile">
                            <select id="city" class="form-control" wire:model.live="selectedCity">
                                <option selected value="">Select City</option>
                                @if($cities)
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_municipality_description }}">{{ $city->city_municipality_description }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2 margin-top-mobile">
                            <select id="city" class="form-control" wire:model.live="advocacy">
                                <option selected value="">Advocacy</option>
                                <option value="HEALTH">Health</option>
                                <option value="EDUCATION">Education</option>
                                <option value="ECONOMIC EMPOWERMENT">Economic Empowerment</option>
                                <option value="SOCIAL INCLUSION AND EQUITY">Social Inclusion and Equity</option>
                                <option value="PEACE-BUILDING AND SECURITY">Peace-building and Security</option>
                                <option value="GOVERNANCE">Governance</option>
                                <option value="ACTIVE CITIZENSHIP">Active Citizenship</option>
                                <option value="ENVIRONMENT">Environment</option>
                                <option value="GLOBAL MOBILITY">Global Mobility</option>
                                <option value="AGRICULTURE">Agriculture</option>   
                            </select>
                        </div>
                    </div>

                    <div class="card-header card-header1">
                        <label class="label" style="color: {{ $active_status === 2 || $active_status === 3 ? 'red' : 'green' }}">
                            @if($active_status === 2)
                                Deactivated Accounts
                            @elseif($active_status === 3)  
                                Red Flag Accounts
                            @else
                                Active Accounts 
                            @endif
                            <span> | </span>
                        </label>
                        <label class="label"> Number of Results: <span>{{ count($volunteers )}}</span></label>

                        <div class="btn-g btn-pos-right">
                            <button class="{{ $active_status === 3 ? 'btn-success' : 'btn-delete' }}" wire:click="toggleFlaggedAccounts">
                                <i class="bi bi-flag-fill"></i>
                            </button>
                            <span class="span span-submit">
                                @if($active_status === 3)
                                    Green Flags
                                @else
                                    Red Flags
                                @endif
                            </span>
                        </div>
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
                                    <th>Advocacy Plans</th>
                                    <th>Status</th>
                                    <th>Work/School</th>
                                    <th>Employer/Course</th>
                                    <th class="action-btn width th-action-btn"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    <tr class="{{ $volunteer->active_status === 3 ? 'background-red' : '' }}">
                                        <td style="position: relative;">
                                            @if($volunteer->active_status === 3)
                                                <span class="red-flag"><i class="bi bi-flag-fill"></i></span>
                                            @endif
                                            {{ $volunteer->passport_number }}
                                        </td>
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
                                        <td>
                                            @if(!@empty($volunteer->advocacy_plans))
                                                @foreach ($volunteer->advocacy_plans as $advocacy_plan)
                                                    <span>• {{ $advocacy_plan }}</span><br>
                                                @endforeach
                                            @else
                                                <span style="color: #ccc;">None</span>
                                            @endif
                                        </td>
                                        <td>{{ $volunteer->status }}</td>
                                        @if($volunteer->status == "PROFESSIONAL")
                                            <td>{{ $volunteer->nature_of_work }}</td>
                                            <td>{{ $volunteer->employer }}</td>
                                        @elseif($volunteer->status == "STUDENT")
                                            <td>{{ $volunteer->name_of_school }}</td>
                                            <td>{{ $volunteer->course }}</td>
                                        @else
                                            <td style="color: #ccc;">N/A</td>
                                            <td style="color: #ccc;">N/A</td>
                                        @endif
                                        <td class="action-btn width {{ $volunteer->active_status === 3 ? 'background-red' : '' }}">
                                            <div class="btn-group-2" role="group">
                                                <div class="btn-g">
                                                    <button class="btn-submit" wire:click="showUserData('{{ $volunteer->user_id }}')">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <span class="span span-submit">View</span>
                                                </div>
                                                <div class="mx-2"></div>
                                                @if(session('user_role') !== 'vsa')
                                                    @if($volunteer->active_status === 2)
                                                        <div class="btn-g">
                                                            <button class="btn-success" wire:click="reactivateDialog('{{ $volunteer->user_id }}')">
                                                                <i class="bi bi-person-check"></i>
                                                            </button>
                                                            <span class="span span-delete">Activate</span>
                                                        </div>
                                                    @elseif($volunteer->active_status === 1) 
                                                        <div class="btn-g">
                                                            <button class="btn-warning" wire:click="deactDialog('{{ $volunteer->user_id }}')">
                                                                <i class="bi bi-ban"></i>
                                                            </button>
                                                            <span class="span span-delete">Deactivate</span>
                                                        </div>
                                                        <div class="mx-2"></div>
                                                        <div class="btn-g">
                                                            <button class="btn-delete" wire:click="flagDialog('{{ $volunteer->user_id }}', {{ $volunteer->active_status }})">
                                                                <i class="bi bi-flag-fill"></i>
                                                            </button>
                                                            <span class="span span-submit">Redflag</span>
                                                        </div>
                                                    @elseif($volunteer->active_status === 3) 
                                                        <div class="btn-g">
                                                            <button class="btn-warning" wire:click="deactDialog('{{ $volunteer->user_id }}')">
                                                                <i class="bi bi-ban"></i>
                                                            </button>
                                                            <span class="span span-delete">Deactivate</span>
                                                        </div>
                                                        <div class="mx-2"></div>
                                                        <div class="btn-g">
                                                            <button class="btn-success" wire:click="flagDialog('{{ $volunteer->user_id }}', {{ $volunteer->active_status }})">
                                                                <i class="bi bi-flag-fill"></i>
                                                            </button>
                                                            <span class="span span-submit">Greenflag</span>
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
        </div>    
    @endif

    @if($deactVolunteerId)
       <div class="anns anns-full-h">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

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
        </div>    
    @endif

    @if($reactivateVolunteerId)
        <div class="anns anns-full-h">
            <div class="close-form" wire:click="hideReactivateDialog"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

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
                            <button class="btn-success" wire:click="reactivateVolunteer('{{ $reactivateVolunteerId }}')" wire:loading.attr="disabled">Yes
                            </button>
                            <button class="btn-cancel" wire:click="hideReactivateDialog">Cancel</button>
                        @else
                            <button class="btn-cancel" wire:click="hideReactivateDialog">Close</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>    
    @endif

    @if($flagRegistrantId)
        <div class="anns anns-full-h">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="add-announcement-container">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            @if($activeStatus === 1)
                                Confirm Red Flag
                            @else
                                Confirm Green Flag
                            @endif
                        </h5>
                        <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if($deleteMessage)
                            <p style="color: green;">{{ $deleteMessage }}</p>
                        @else
                            @if($activeStatus === 1)
                                <p>Are you sure you want to red flag this registrant?</p>
                            @else
                                <p>Are you sure you want to green flag this registrant?</p>
                            @endif
                        @endif
                    </div>

                    <div class="modal-footer">
                        @if($disableButton == "No")
                            <button class="{{ $activeStatus === 1 ? 'btn-delete' : 'btn-success' }}" wire:click="flagRegistrant('{{ $flagRegistrantId }}')" wire:loading.attr="disabled">Yes
                            </button>
                            <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                        @else
                            <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                        @endif
                    </div>

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
                                            @if($selectedUserDetails['active_status'] === 3)
                                                <span class="red-flag"> <i class="bi bi-flag-fill"></i></span>
                                            @endif
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
                                                <td style="color: #ccc;">
                                                   No Categories Yet
                                                </td>
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
                                                <td style="color: #ccc;">
                                                    No Experience Yet
                                                </td>
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

                                <table class="table-main">
                                    <thead>
                                        <tr>
                                            <th>Birth Certificate</th>
                                            <th>Curriculum Vitae</th>
                                            <th>Good Moral Certificate</th>
                                            <th>Valid ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="position: relative">
                                                @if($selectedUserDetails['birth_certificate'])
                                                    <div class="file-container fit-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_EXTENSION) }}</span>
                                                    </div>
                                                    <div class="req-files-buttons">
                                                        <a class="btn-submit" href="{{ asset($selectedUserDetails['birth_certificate']) }}" download>
                                                            <i class="bi bi-file-earmark-arrow-down"></i>
                                                        </a>
                                                        @if(pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_EXTENSION) === 'pdf' ||
                                                            pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_EXTENSION) === 'docx' ||
                                                            pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_EXTENSION) === 'txt' ||
                                                            pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_EXTENSION) === 'csv')
                                                            <a class="btn-submit" href="#" onclick="window.open('{{ asset($selectedUserDetails['birth_certificate']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </td>
                                            <td style="position: relative">
                                                @if($selectedUserDetails['curriculum_vitae'])
                                                    <div class="file-container fit-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_EXTENSION) }}</span>
                                                    </div>
                                                    <div class="req-files-buttons">
                                                        <a class="btn-submit" href="{{ asset($selectedUserDetails['curriculum_vitae']) }}" download>
                                                            <i class="bi bi-file-earmark-arrow-down"></i>
                                                        </a>
                                                        @if(pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_EXTENSION) === 'pdf' ||
                                                            pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_EXTENSION) === 'docx' ||
                                                            pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_EXTENSION) === 'txt' ||
                                                            pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_EXTENSION) === 'csv')
                                                            <a class="btn-submit" href="#" onclick="window.open('{{ asset($selectedUserDetails['curriculum_vitae']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </td>
                                            <td style="position: relative;">
                                                @if($selectedUserDetails['good_moral_cert'])
                                                    <div class="file-container fit-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_EXTENSION) }}</span>
                                                    </div>
                                                    <div class="req-files-buttons">
                                                        <a class="btn-submit" href="{{ asset($selectedUserDetails['good_moral_cert']) }}" download>
                                                            <i class="bi bi-file-earmark-arrow-down"></i>
                                                        </a>
                                                        @if(pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_EXTENSION) === 'pdf' ||
                                                            pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_EXTENSION) === 'docx' ||
                                                            pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_EXTENSION) === 'txt' ||
                                                            pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_EXTENSION) === 'csv')
                                                            <a class="btn-submit" href="#" onclick="window.open('{{ asset($selectedUserDetails['good_moral_cert']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </td>
                                            <td style="position: relative;">
                                                @if($selectedUserDetails['valid_Id'])
                                                    <div class="file-container fit-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) }}</span>
                                                    </div>
                                                    <div class="req-files-buttons">
                                                        <a class="btn-submit" href="{{ asset($selectedUserDetails['valid_Id']) }}" download>
                                                            <i class="bi bi-file-earmark-arrow-down"></i>
                                                        </a>
                                                        @if(pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'pdf' ||
                                                            pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'docx' ||
                                                            pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'txt' ||
                                                            pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'png' ||
                                                            pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'jpg' ||
                                                            pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'jpeg' ||
                                                            pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) === 'csv')
                                                            <a class="btn-submit" href="#" onclick="window.open('{{ asset($selectedUserDetails['valid_Id']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody style="margin-top: 10px">
                                        <tr style="background: #CFE9FF">
                                            <td><b>Other Documents</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        @if(!@empty($otherDocs))
                                            @foreach ($otherDocs as $docu)
                                                <tr>
                                                    <td style="position: relative;">
                                                        <div class="file-container fit-container">
                                                            <span>{{ pathinfo(asset($docu), PATHINFO_FILENAME) }}.{{ pathinfo(asset($docu), PATHINFO_EXTENSION) }}</span>
                                                        </div>
                                                        <div class="req-files-buttons">
                                                            <a class="btn-submit" href="{{ asset($docu) }}" download>
                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                            </a>
                                                            @if(pathinfo(asset($docu), PATHINFO_EXTENSION) === 'pdf' ||
                                                                pathinfo(asset($docu), PATHINFO_EXTENSION) === 'docx' ||
                                                                pathinfo(asset($docu), PATHINFO_EXTENSION) === 'txt' ||
                                                                pathinfo(asset($docu), PATHINFO_EXTENSION) === 'csv')
                                                                <a class="btn-submit" href="#" onclick="window.open('{{ asset($docu) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>None</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="mt-3"></div>
                                <div class="row1">
                                    <div class="col">
                                        <div class="user-data">
                                            @if($selectedUserDetails['active_status'] === 2)
                                                <button class="btn-success" wire:click="reactivateDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Activate</button>
                                            @else
                                                <button class="btn-success" wire:click="exportToPdf" wire:loading.attr="disabled">
                                                    <span><i class="bi bi-filetype-pdf"></i> Export Data</span>
                                                    <div wire:loading wire:target="exportToPdf" class="loading-container">
                                                        <div class="loading-spinner"></div>
                                                    </div>
                                                </button>
                                                <button class="btn-warning" wire:click="deactDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Deactivate</button>
                                            @endif
                                            @if($selectedUserDetails['active_status'] === 1) 
                                                <div class="btn-g">
                                                    <button class="btn-delete" wire:click="flagDialog('{{ $selectedUserDetails['user_id'] }}', {{ $selectedUserDetails['active_status'] }})">
                                                        <i class="bi bi-flag-fill"></i>
                                                    </button>
                                                </div>
                                            @elseif($selectedUserDetails['active_status'] === 3) 
                                                <div class="btn-g">
                                                    <button class="btn-success" wire:click="flagDialog('{{ $selectedUserDetails['user_id'] }}', {{ $selectedUserDetails['active_status'] }})">
                                                        <i class="bi bi-flag-fill"></i>
                                                    </button>
                                                </div>
                                            @endif
                                            <button class="btn-delete" wire:click="deleteDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Delete</button>
                                            <button class="btn-cancel" wire:click="hideUserData">Close</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
