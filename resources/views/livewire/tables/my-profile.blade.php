<section class="content profile-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="profile-header">
        <div class="cover">
           <img src="images/yvip_logo.png" alt="logo" width="100">
        </div>
        <div class="profile-body">
            <div class="content">
                <div class="top-info">
                    <img src="{{ $user->profile_picture }}" alt="profile picture" width="100">
                    <div class="name">
                        <h3>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h3>
                        <p>{{ $user->nickname }}</p>
                    </div>
                </div>
                <div class="user-info">
                    <div class="row1 row-header">
                        <div class="col1">
                            <label class="label">Passport Number: <span>{{ $user ? $user['passport_number'] : '' }}</span></label>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Date of Birth: <span>{{ $user ? $user['date_of_birth'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Civil Status: <span>{{ $user ? $user['civil_status'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Age: <span>{{ $user ? $user['age'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Nationality: <span>{{ $user ? $user['nationality'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Tel Number: <span>{{ $user ? $user['tel_number'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Mobile Number: <span>{{ $user ? $user['mobile_number'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Email: <span>{{ $user ? $user['email'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Blood Type: <span>{{ $user ? $user['blood_type'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Sex at Birth: <span>{{ $user ? $user['sex'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Educational Background: <span>{{ $user ? $user['educational_background'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col1">
                            <label class="label">Permanent Adrress: <span>{{ $user->p_street_barangay }} {{ $user->permanent_selectedCity }} {{ $user->permanent_selectedProvince }}</span></label>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col1">
                            <label class="label">Residential Adrress: <span>{{ $user->r_street_barangay }} {{ $user->residential_selectedCity }} {{ $user->residential_selectedProvince }}</span></label>
                        </div>
                    </div>
    
                    <div class="row1">
                        <div class="col1">
                            <label class="label">Status: <span>{{ $user ? $user['status'] : '' }}</span></label>
                        </div>
                    </div>
    
                    @if($user['name_of_school'])
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">School Name: <span>{{ $user ? $user['name_of_school'] : '' }}</span></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Course: <span>{{ $user ? $user['course'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif
    
                    @if($user['nature_of_work'])
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Nature of Work: <span>{{ $user ? $user['nature_of_work'] : '' }}</span></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Employer: <span>{{ $user ? $user['employer'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif
    
                    @if($user['organization_name'])
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Organization Name: <span>{{ $user ? $user['organization_name'] : '' }}</span></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Position: <span>{{ $user ? $user['org_position'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>
