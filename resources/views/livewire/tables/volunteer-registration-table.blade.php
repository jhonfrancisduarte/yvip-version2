<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="table-wrapper">
        <div class="table-container">

            <div class="table-header bordered-bottom">
                <h3 class="table-title">Volunteer Registrations Management</h3>
            </div>

            <div class="table-header" style="justify-content: left">
                <div class="col-md-6">
                    <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search...">
                </div>
            </div>

            <div class="table-header table-header-2">
                <div>
                    <label class="table-label">
                        Pending Registrations | 
                    </label>
                    <label class="table-label">Number of Results: <span>{{ count($volunteers )}}</span></label>
                </div>
            </div>

            <div class="table-table" id="table-table">
                <div class="table">
                    @foreach($volunteers as $volunteer)
                        <div class="table-tr" wire:key="volunteer-{{ $volunteer->id }}" style="height: @if(in_array($volunteer->id, $expandedRows)) fit-content @else 90px @endif;">
                            <div class="table-overlay"></div>
                            <div class="tr" wire:click="toggleRow('{{ $volunteer->id }}')">
                                
                                <div class="primary-data">
                                    <img src="{{ $volunteer->profile_picture }}" style="height: 70px; width: 70px; border-radius: 50%;">
                                    <div class="data-row full-w-on-mobile p-data">
                                        <p class="table-tr-data main-data data-col-full">{{ $volunteer->first_name }} {{ $volunteer->middle_name }} {{ $volunteer->last_name }}</p>
                                        <p class="table-tr-data data-col-full">{{ $volunteer->passport_number }}</p>
                                    </div>
                                </div>

                                <div class="secondary-data @if(!in_array($volunteer->id, $expandedRows)) display-none @endif">

                                    <div class="data-row on-mobile m-margin-top">
                                        <p class="table-tr-data"><span>Nickname: </span>{{ $volunteer->nickname }}</p>
                                        <p class="table-tr-data"><span>Age: </span>{{ $volunteer->age }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Sex at Birth: </span>{{ $volunteer->sex }}</p>
                                        <p class="table-tr-data"><span>Date of Birth: </span>{{ $volunteer->date_of_birth }}</p>
                                    </div>
                                    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Nationality: </span>{{ $volunteer->nationality }}</p>
                                        <p class="table-tr-data"><span>Blood Type: </span>{{ $volunteer->blood_type }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Civil Status: </span>{{ $volunteer->civil_status }}</p>
                                        <p class="table-tr-data"><span>Email: </span>{{ $volunteer->email }}</p>
    
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data"><span>Tel Number: </span>{{ $volunteer->tel_number }}</p>
                                        <p class="table-tr-data"><span>Mobile Number: </span>{{ $volunteer->mobile_number }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Permanent Address: </span>{{ $volunteer->p_street_barangay }} {{ $volunteer->permanent_selectedCity }} {{ $volunteer->permanent_selectedProvince }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Residential Address: </span>{{ $volunteer->r_street_barangay }} {{ $volunteer->residential_selectedCity }} {{ $volunteer->residential_selectedProvince }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Educational Background: </span>{{ $volunteer->educational_background }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        <p class="table-tr-data data-col-full"><span>Status: </span>{{ $volunteer->status }}</p>
                                    </div>
    
                                    <div class="data-row on-mobile">
                                        @if($volunteer->status == "PROFESSIONAL")
                                            <p class="table-tr-data"><span>Nature of Work: </span>{{ $volunteer->nature_of_work }}</p>
                                            <p class="table-tr-data"><span>Employer: </span>{{ $volunteer->employer }}</p>
                                        @elseif($volunteer->status == "STUDENT")
                                            <p class="table-tr-data"><span>Name of School: </span>{{ $volunteer->name_of_school }}</p>
                                            <p class="table-tr-data"><span>Course: </span>{{ $volunteer->course }}</p>
                                        @endif
                                    </div>
    
                                    @if($selectedUserDetails)
                                        <div class="other-details on-mobile">

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
    
                                    <div class="data-row center on-mobile @if(!in_array($volunteer->id, $expandedRows)) display-none @endif">
                                        @if(Auth::user()->user_role !== 'vsa')
                                            <div class="table-btn-g">
                                                <button class="open-dialog-btn btn-success" wire:click="approveUser('{{ $volunteer->user_id }}')">
                                                    <i class="bi bi-check2-circle"></i>
                                                </button>
                                                <span class="hover-p-2">Approve</span>
                                            </div>
                                            <div class="mx-2"></div>
                                            <div class="table-btn-g">
                                                <button class="open-dialog-btn btn-delete" wire:click="deleteDialog('{{ $volunteer->user_id }}')">
                                                    <i class="bi bi-ban"></i>
                                                </button>
                                                <span class="hover-p-2">Disapprove</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="table-action-buttons">
                                <div class="mx-2"></div>
                                @if(Auth::user()->user_role !== 'vsa')
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-success" wire:click="approveUser('{{ $volunteer->user_id }}')">
                                            <i class="bi bi-person-check"></i>
                                        </button>
                                        <p class="hover-p">Approve</p>
                                    </div>
                                    <div class="mx-2"></div>
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-warning" wire:click="deleteDialog('{{ $volunteer->user_id }}')">
                                            <i class="bi bi-ban"></i>
                                        </button>
                                        <p class="hover-p">Disapprove</p>
                                    </div>
                                @endif
                            </div>

                            <div class="see-more">
                                <div class="see-more-bar" wire:click="toggleRow('{{ $volunteer->id }}')">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="m-3">
                {{ $volunteers->links('livewire::bootstrap') }}
            </div>

        </div>
        <div class="mt-5"></div>
    </div>

    <div class="popup popup-modal" @if(!$deleteRegistrantId) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="hideDeleteDialog"></div>
        <div class="popup-modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Disapprove</h5>
                    <button type="button" class="close-dialog-btn close" wire:click="hideDeleteDialog">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($deleteMessage)
                        <p style="color: green;">{{ $deleteMessage }}</p>
                    @else
                        <p>Are you sure you want to disapprove this registrant?</p>
                    @endif
                </div>

                <div class="modal-footer">
                    @if($disableButton == "No")
                        <button class="btn-delete" wire:click="deleteRegistrant('{{ $deleteRegistrantId }}')" wire:loading.attr="disabled">Yes
                        </button>
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                    @else
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>

        </div>
    </div>

    <div class="popup popup-modal" @if(!$approving) style="display: none;" @endif>
        <div class="modal-overlay"></div>
        <div class="popup-modal-content">
            <div class="modal-body">
                <p>Approving...</p>
                <span>
                    <div wire:loading wire:target="approveUser" class="loading-container">
                        <div class="loading-spinner"></div>
                    </div>
                </span>
            </div>
        </div>
    </div>    

</div>
