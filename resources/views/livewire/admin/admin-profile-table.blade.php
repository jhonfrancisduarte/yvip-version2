<section class="content profile-content">
    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
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
                    <div class="profile-pic">
                        <img src="{{ $user->profile_picture }}" alt="profile picture">
                        <i class="nav-icon fas fa-camera" wire:click="opedEditProfileForm"></i>
                    </div>
                    <div class="name">
                        <h3>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h3>
                        <p>{{ $user->nickname }}</p>
                    </div>
                </div>
                
                <div class="content-actions">
                    <button class="btn btn-info btn-xs" wire:click.live="openEditMyInfo"><i class="nav-icon fas fa-edit"></i> Edit Profile</button>
                </div>

                @if($myInfo)
                    <div class="user-info">
                        <div class="row1 row-header">
                            <div class="col1">
                                <label class="label">Passport Number: <span>{{ $user ? $user['passport_number'] : '' }}</span></label>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Date of Birth: <span>{{ $user ? $user['formatted_date_of_birth'] : '' }}</span></label>
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
                                <label class="label address-label">Permanent Adrress: <span>{{ $user->p_street_barangay }} {{ $user->permanent_selectedCity }} {{ $user->permanent_selectedProvince }}</span></label>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col1">
                                <label class="label address-label">Residential Adrress: <span>{{ $user->r_street_barangay }} {{ $user->residential_selectedCity }} {{ $user->residential_selectedProvince }}</span></label>
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
                @endif

                @if($editMyInfo)
                    <div class="user-info">
                        <div class="edit-title">
                            <h5>Edit profile</h5>
                            <button class="btn btn-success btn-xs" wire:click.live="closeEditMyInfo">Cancel</button>  
                        </div>
                        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Firstname: <span>{{ $user ? $user['first_name'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('first_name')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Lastname: <span>{{ $user ? $user['last_name'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('last_name')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Middlename: <span>{{ $user ? $user['middle_name'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('middle_name')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Nickname: <span>{{ $user ? $user['nickname'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('nickname')"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Date of Birth: <span>{{ $user ? $user['formatted_date_of_birth'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('date_of_birth')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Civil Status: <span>{{ $user ? $user['civil_status'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('civil_status')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Age: <span>{{ $user ? $user['age'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('age')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Nationality: <span>{{ $user ? $user['nationality'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('nationality')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Tel Number: <span>{{ $user ? $user['tel_number'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('tel_number')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Mobile Number: <span>{{ $user ? $user['mobile_number'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('mobile_number')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Email: <span>{{ $user ? $user['email'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('email')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Blood Type: <span>{{ $user ? $user['blood_type'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('blood_type')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Sex at Birth: <span>{{ $user ? $user['sex'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('sex')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Educational Background: <span>{{ $user ? $user['educational_background'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('educational_background')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col1">
                                <label class="label address-label">Permanent Adrress: <span>{{ $user->p_street_barangay }} {{ $user->permanent_selectedCity }} {{ $user->permanent_selectedProvince }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('permanent_selectedProvince')"></i></label>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col1">
                                <label class="label address-label">Residential Adrress: <span>{{ $user->r_street_barangay }} {{ $user->residential_selectedCity }} {{ $user->residential_selectedProvince }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('residential_selectedProvince')"></i></label>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col1">
                                <label class="label">Status: <span>{{ $user ? $user['status'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('status')"></i></label>
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
        

                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Organization Name: <span>{{ $user ? $user['organization_name'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('organization_name')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Position: <span>{{ $user ? $user['org_position'] : '' }}</span> <i class="nav-icon fas fa-edit" wire:click="editThis('org_position')"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="edit-footer">
                            <button class="btn btn-info btn-xs" wire:click="editThis('password')">Change Password</button>  
                            <button class="btn btn-danger btn-xs" wire:click.live="deleteDialog">Delete Account</button>  
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($openEditProfile)
        <div class="anns anns-fixed">
            <div class="close-form" wire:click="closeEditProfileForm"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Profile Picture</h4>
                            <button type="button" class="close" wire:click="closeEditProfileForm">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form enctype="multipart/form-data" wire:submit='editProfilePic({{ $user->user_id }})'>
                            <div class="card card-primary">
                                <div class="card-body">

                                    <div class="row">
                                        <img src="" alt="" class="selected-image">
                                    </div>

                                    <div class="row">     
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="label">Select picture</label>
                                                <input type="file" accept="image/*" id="profile_picture" wire:model.live='profile_picture'/>
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

    @if($toBeEdited)
        <div class="anns anns-fixed">
            <div class="close-form" wire:click="closeEditProfileForm"></div>
            <div class="add-announcement-container">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($toBeEdited === "permanent_selectedProvince")
                            <h4 class="modal-title">Edit permanent address</h4>
                        @elseif($toBeEdited === "residential_selectedProvince")
                            <h4 class="modal-title">Edit residential address</h4>
                        @else
                            <h4 class="modal-title">Edit {{ $formattedData }}</h4>
                        @endif
                        <button type="button" class="close" wire:click="closeEditThis">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateInfo('{{ $toBeEdited }}')">
                        <div class="card card-primary">
                            <div class="card-body">

                                @if($toBeEdited === "date_of_birth")
                                    <div class="row1">
                                        <div class="col2">
                                            <label class="label">date of birth</label>
                                            <div class="input-group-icon">
                                                <input class="input--style-4" type="date" wire:model="thisData" name="date_of_birth">
                                            </div>
                                            @error('thisData') <span class="text-danger small" style="color: red;">The date of birth field is required</span>@enderror
                                        </div>
                                    </div>
                                @elseif($toBeEdited === "civil_status")
                                    <div class="row1">
                                        <div class="col2">
                                            <label class="label">civil status</label>
                                                <select id="civil_status" class="label select-status" wire:model="thisData" required>
                                                    <option class="label" value="">Select Civil Status</option>
                                                    <option class="label" value="Single">Single</option>
                                                    <option class="label" value="Married">Married</option>
                                                    <option class="label" value="Widowed">Widowed</option>
                                                    <option class="label" value="Legally Separated">Legally Separated</option>
                                                </select>
                                            @error('thisData') 
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @elseif($toBeEdited === "sex")
                                    <div class="row1">
                                        <div class="col2">
                                            <label class="label">Sex at birth</label>
                                                <select id="civil_status" class="label select-status" wire:model="thisData" required>
                                                    <option class="label" value="">Sex at birth</option>
                                                    <option class="label" value="Male">Male</option>
                                                    <option class="label" value="Female">Female</option>
                                                </select>
                                            @error('thisData') 
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @elseif($toBeEdited === "status")
                                    <div class="row1">
                                        <div class="col2">
                                            <label class="label">Status</label>
                                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                                <select class="label select-status" id="status" wire:model.live="thisData" name="status">
                                                    <option selected value="" class="label">Choose option</option>
                                                    <option value="Student" class="label">Student</option>
                                                    <option value="Professional" class="label">Professional</option>
                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                            @error('status') <span class="text-danger small" style="color: red;">The status field is required</span> @enderror
                                        </div>
                                    </div>

                                    @if($thisData === "Student")
                                        <div class="row1">
                                            <div class="col2">
                                                <label class="label">School name</label>
                                                <input class="input--style-4" type="text" wire:model.live="name_of_school" name="name_of_school">
                                            </div>
                                            <div class="col2">
                                                <label class="label">Course</label>
                                                <input class="input--style-4" type="text" wire:model.live="course" name="course">
                                            </div>
                                        </div>
                                    @elseif($thisData === "Professional")
                                        <div class="row1">
                                            <div class="col2">
                                                <label class="label">Nature of work</label>
                                                <input class="input--style-4" type="text" wire:model.live="nature_of_work" name="nature_of_work">        
                                            </div>
                                            <div class="col2">
                                                <label class="label">Employer</label>
                                                <input class="input--style-4" type="text" wire:model.live="employer" name="employer">                          
                                            </div>
                                        </div>
                                    @endif
                                @elseif($toBeEdited === "permanent_selectedProvince")
                                    <div class="row1">
                                        <div class="col2"> 
                                            <label class="label">Province</label>
                                            <select wire:model.live="selectedProvince" id="province" class="form-control">
                                                <option value="">Select Province</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->province_description }}">{{ $province->province_description }}</option>
                                                @endforeach
                                            </select>
                                            @error('permanent_selectedProvince') <span class="text-danger small" style="color: red;">The Province Field is required</span>@enderror
                                            <label class="label">City</label>
                                            <select id="city" class="form-control" wire:model.live="selectedCity">
                                                <option value="">Select City</option>
                                                @if($cities)
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->city_municipality_description }}">{{ $city->city_municipality_description }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('permanent_selectedCity') <span class="text-danger small" style="color: red;">The Province Field is required</span>@enderror
                                            <label class="label">House number | Street | Subdivision | Barangay</label>
                                            <input class="input--style-4" type="text" wire:model="p_street_barangay" name="p_street_barangay" >
                                            @error('p_street_barangay') <span class="text-danger small" style="color: red;">The Street and Barangay field is required</span>@enderror
                                        </div>
                                    </div>
                                @elseif($toBeEdited === "residential_selectedProvince")
                                    <div class="row1">
                                        <div class="col2"> 
                                            <label class="label">Province</label>
                                            <select wire:model.live="selectedProvince" id="province" class="form-control">
                                                <option value="">Select Province</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->province_description }}">{{ $province->province_description }}</option>
                                                @endforeach
                                            </select>
                                            @error('residential_selectedProvince') <span class="text-danger small" style="color: red;">The Province Field is required</span>@enderror
                                            <label class="label">City</label>
                                            <select id="city" class="form-control" wire:model.live="selectedCity">
                                                <option value="">Select City</option>
                                                @if($cities)
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->city_municipality_description }}">{{ $city->city_municipality_description }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('residential_selectedCity') <span class="text-danger small" style="color: red;">The Province Field is required</span>@enderror
                                            <label class="label">House number | Street | Subdivision | Barangay</label>
                                            <input class="input--style-4" type="text" wire:model="p_street_barangay" name="p_street_barangay" >
                                            @error('r_street_barangay') <span class="text-danger small" style="color: red;">The Street and Barangay field is required</span>@enderror
                                        </div>
                                    </div>
                                @elseif($toBeEdited === "password")
                                    <div class="row1">
                                        <div class="col2">
                                            <label class="label label-formatted">Current Password</label>
                                            <input class="input--style-4" type="password" wire:model.live="password" required>
                                        </div>
                                        <div class="col2">
                                            <label class="label label-formatted">New Password</label>
                                            <input class="input--style-4" type="password" wire:model.live="new_password" required>
                                        </div>
                                        <div class="col2">
                                            <label class="label label-formatted">Confirm New Password</label>
                                            <input class="input--style-4" type="password" wire:model.live="c_new_pass" required>
                                        </div>
                                    </div>
                                    @error('new_password') 
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                @else
                                    <div class="row1">
                                        <div class="col2">
                                                <label class="label label-formatted">{{ $formattedData }}</label>
                                                <input class="input--style-4" type="text" wire:model.live="thisData" value="{{ $thisData }}" required>
                                        </div>
                                        @error('thisData') 
                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer justify-content-between">
                                <button class="btn btn-infos" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($deleteAccDialog)
        <div class="anns anns-fixed">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info delete-message">

                <div class="row1 row-header">
                    <div class="col1">
                        <label class="label">Are you sure you want to delete your account?</label>
                    </div>
                </div>                   
                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            <button class="btn btn-danger btn-xs" wire:click="deleteAccount" wire:loading.attr="disabled">Yes</button>
                            <button class="btn btn-success btn-xs" wire:click="hideDeleteDialog">Cancel</button>
                        </div>
                    </div>
                
                </div>

            </div>
        </div>    
    @endif

</section>
