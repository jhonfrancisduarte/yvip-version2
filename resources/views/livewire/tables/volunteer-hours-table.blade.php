<div>
    
    <div class="container mt-4 {{ $selectedUserDetails ? 'hide-table' : '' }}">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header card-header1">
                        <div class="col-md-4">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        <div class="col-md-2 margin-top-mobile">
                            <input type="number" class="form-control" wire:model.live="hours" placeholder="No. of hours">
                        </div>
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table-main">
                            <thead>
                                <tr>
                                    <th width="15%" class="th-border-rad">Passport Number</th>
                                    <th>Name</th>
                                    <th width="20%" class="th-action-btn">
                                        <span>
                                            @if($sortDirection === "desc")
                                                <i class="bi bi-sort-down volunteers-name" wire:click="toggleSortDirection"></i>
                                            @else
                                                <i class="bi bi-sort-up-alt volunteers-name" wire:click="toggleSortDirection"></i>
                                            @endif
                                        </span> Total Number of Hours
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($userHours as $record)
                                    <tr>
                                        <td><span wire:click="showUserData('{{ $record->user_id }}')" style="cursor: pointer;">{{ $record->user->userData->passport_number }}</span></td>
                                        <td>
                                            <img class="profile_picture volunteers-name" src="{{ $record->user->userData->profile_picture }}" alt="profile picture" width="40" style="margin-right: 15px; border-radius: 50%; height: 40px;" wire:click="showUserData('{{ $record->user_id }}')">
                                            <span class="volunteers-name" wire:click="showUserData('{{ $record->user_id }}')">{{ $record->name }}</span>
                                        </td>
                                        <td class="centered">
                                            <i class="bi bi-clock"></i> {{ $record->total_hours }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="m-3">
                        {{ $userHours->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

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
                                            <th  width="100%" class="th-border-rad-2" style="border-bottom: 1px solid white;">Volunteering Hours: {{ $volunteerHours->total_hours }}</th>
                                        </tr>
                                    </thead>

                                    <thead>
                                        <tr>
                                            <th  width="100%">Personal Data</th>
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

                                <div class="mt-3"></div>
                                <div class="row1">
                                    <div class="col">
                                        <div class="user-data">
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