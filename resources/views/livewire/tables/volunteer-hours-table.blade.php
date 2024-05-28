<div class="main-contents">
    
    <div class="table-wrapper">

        <div class="table-container">

            <div class="table-header bordered-bottom">
                <h3 class="table-title">Volunteering Hours</h3> 
            </div>

            <div class="table-header justify-left">
                <div class="col-md-4">
                    <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search...">
                </div>
                <div class="col-md-3 margin-top-mobile">
                    <input type="number" class="panel-input-1 w" wire:model.live="hours" placeholder="No. of hours">
                </div>
            </div>

            <div class="table-table" id="table-table">
                <div class="table">
                    @foreach ($userHours as $record)
                        <div class="table-tr" wire:key="volunteer-{{ $record->user->userData->id }}" style="height: @if(in_array($record->user->userData->id, $expandedRows)) fit-content @else 90px @endif;">
                            <div class="table-overlay"></div>
                            <div class="tr" wire:click="toggleRow('{{ $record->user->userData->id }}')">

                                <div class="primary-data">
                                    <img src="{{ $record->user->userData->profile_picture }}" style="height: 70px; width: 70px; border-radius: 50%;">
                                    <div class="data-row full-w-on-mobile p-data">
                                        <p class="table-tr-data main-data data-col-full">{{ $record->user->userData->first_name }} {{ $record->user->userData->middle_name }} {{ $record->user->userData->last_name }}</p>
                                        <p class="table-tr-data data-col-full">{{ $record->user->userData->passport_number }}</p>
                                    </div>
                                </div>
                                
                                <div class="secondary-data @if(!in_array($record->user->userData->id, $expandedRows)) display-none @endif">

                                    <div class="data-row on-mobile m-margin-top">
                                        <p class="table-tr-data"><span>Nickname: </span>{{ $record->user->userData->nickname }}</p>
                                        <p class="table-tr-data"><span>Age: </span>{{ $record->user->userData->age }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Sex at Birth: </span>{{ $record->user->userData->sex }}</p>
                                        <p class="table-tr-data"><span>Date of Birth: </span>{{ $record->user->userData->date_of_birth }}</p>
                                    </div>
                                    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Nationality: </span>{{ $record->user->userData->nationality }}</p>
                                        <p class="table-tr-data"><span>Blood Type: </span>{{ $record->user->userData->blood_type }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Civil Status: </span>{{ $record->user->userData->civil_status }}</p>
                                        <p class="table-tr-data"><span>Email: </span>{{ $record->user->userData->email }}</p>
    
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Tel Number: </span>{{ $record->user->userData->tel_number }}</p>
                                        <p class="table-tr-data"><span>Mobile Number: </span>{{ $record->user->userData->mobile_number }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Permanent Address: </span>{{ $record->user->userData->p_street_barangay }} {{ $record->user->userData->permanent_selectedCity }} {{ $record->user->userData->permanent_selectedProvince }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Residential Address: </span>{{ $record->user->userData->r_street_barangay }} {{ $record->user->userData->residential_selectedCity }} {{ $record->user->userData->residential_selectedProvince }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Educational Background: </span>{{ $record->user->userData->educational_background }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Status: </span>{{ $record->user->userData->status }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        @if($record->user->userData->status == "PROFESSIONAL")
                                            <p class="table-tr-data"><span>Nature of Work: </span>{{ $record->user->userData->nature_of_work }}</p>
                                            <p class="table-tr-data"><span>Employer: </span>{{ $record->user->userData->employer }}</p>
                                        @elseif($record->user->userData->status == "STUDENT")
                                            <p class="table-tr-data"><span>Name of School: </span>{{ $record->user->userData->name_of_school }}</p>
                                            <p class="table-tr-data"><span>Course: </span>{{ $record->user->userData->course }}</p>
                                        @endif
                                    </div>
    
                                    @if($selectedUserDetails)
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
            

                                            <div class="table-files">
                                                @if($selectedUserDetails['birth_certificate'])
                                                    <p><b>Birth Certificate</b></p>
                                                    <div class="file-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['birth_certificate']), PATHINFO_EXTENSION) }}</span>
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
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </div>

                                            <div class="table-files">
                                                @if($selectedUserDetails['curriculum_vitae'])
                                                    <p><b>Curriculum Vitae</b></p>
                                                    <div class="file-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['curriculum_vitae']), PATHINFO_EXTENSION) }}</span>
                                                    
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
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </div>

                                            <div class="table-files">
                                                @if($selectedUserDetails['good_moral_cert'])
                                                    <p><b>Good Moral Certificate</b></p>
                                                    <div class="file-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['good_moral_cert']), PATHINFO_EXTENSION) }}</span>
                                                   
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
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </div>

                                            <div class="table-files">
                                                @if($selectedUserDetails['valid_Id'])
                                                    <p><b>Valid ID</b></p>
                                                    <div class="file-container">
                                                        <span>{{ pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($selectedUserDetails['valid_Id']), PATHINFO_EXTENSION) }}</span>
                                                    
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
                                                    </div>
                                                @else
                                                    <span style="color: #ccc;">none</span>
                                                @endif
                                            </div>

                                            <div class="table-files fit-height">   
                                                <p><b>Other Documents</b></p>
         
                                                @if(!@empty($otherDocs))
                                                    <div class="other-files">
                                                        @foreach ($otherDocs as $docu)
                                                            <div class="file-container" style="border: none !important">
                                                                <span>{{ pathinfo(asset($docu), PATHINFO_FILENAME) }}.{{ pathinfo(asset($docu), PATHINFO_EXTENSION) }}</span>
                                                        
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
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p style="color: #ccc">None</p>
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="table-action-buttons">
                                <div class="hours-count">
                                    <i class="bi bi-clock"></i> {{ $record->total_hours }}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="m-3">
                {{ $userHours->links('livewire::bootstrap') }}
            </div>

        </div>
        <div class="mt-5"></div>
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