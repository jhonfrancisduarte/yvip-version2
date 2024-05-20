<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
                <div class="progress-colored" id="progress-colored" style="width: {{ $currentStep === 2 ? '33.333%' : '' }} {{ $currentStep === 3 ? '66.666%' : '' }} {{ $currentStep === 4 ? '100%' : '' }}"></div>

                <div class="circle {{ $currentStep >= 1 ? 'active' : '' }}">
                    <div class="dot {{ $currentStep >= 1 ? 'active' : '' }} {{ $section1Validated ? 'validated' : '' }}">     
                        <i class="fas fa-check {{ $section1Validated ? 'active' : '' }}"></i>
                    </div>
                    <span>Your Info</span>
                </div>

                <div class="circle {{ $currentStep >= 2 ? 'active' : '' }}">
                    <div class="dot {{ $section1Validated ? 'active' : '' }} {{ $section2Validated ? 'validated' : '' }}">
                        <i class="fas fa-check {{ $section2Validated ? 'active' : '' }}"></i>
                    </div>
                    <span>Contact Info</span>
                </div>

                <div class="circle {{ $currentStep >= 3 ? 'active' : '' }}">
                    <div class="dot {{ $section2Validated ? 'active' : '' }} {{ $section3Validated ? 'validated' : '' }}">
                        <i class="fas fa-check {{ $section3Validated ? 'active' : '' }}"></i>
                    </div>
                    <span>Background Info</span>
                </div>

                <div class="circle {{ $currentStep >= 4 ? 'active' : '' }}">
                    <div class="dot {{ $section3Validated ? 'active' : '' }}">
                    </div>
                    <span>Requirements</span>
                </div>
            </div>
        </div>
        <div class="progress-container-bg">
        </div>

        <div class="reg-logo-container">
            <img src="images/yvip_logo.png" width="60"/>
            <h2 class="reg-title">Registration Form</h2>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="create" >
  
                    <div class="form-section {{ $currentStep === 1 ? 'visible' : '' }}">
                        <div class="section-title">
                            <h4>Your information</h4>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" wire:model.blur="first_name" name="first_name" required>
                                    @error('first_name') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" wire:model.blur="last_name" name="last_name"  required>
                                    @error('last_name') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">middle name</label>
                                    <input class="input--style-4" type="text" wire:model.blur="middle_name" name="middle_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">nickname</label>
                                    <input class="input--style-4" type="text" wire:model.blur="nickname" name="nickname">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">date of birth</label>
                                    <div class="input-group">
                                        <input class="input--style-4" type="date" wire:model.blur="date_of_birth" name="date_of_birth" style="height: 50px;"  required>
                                        @error('date_of_birth') <span class="text-danger small" style="color: red;">The date of birth field is required</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">civil status</label>
                                        <select id="civil_status" class="label select-status" wire:model.blur="civil_status"  required>
                                            <option class="label" value="">Select Civil Status</option>
                                            <option class="label" value="Single">Single</option>
                                            <option class="label" value="Married">Married</option>
                                            <option class="label" value="Widowed">Widowed</option>
                                            <option class="label" value="Legally Separated">Legally Separated</option>
                                        </select>
                                    @error('civil_status')
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">age</label>
                                    <input class="input--style-4" type="number" wire:model.blur="age" name="age"  required>
                                    @error('age') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">nationality</label>
                                    <input class="input--style-4" type="text" wire:model.blur="nationality" name="nationality" required>
                                    @error('nationality') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Blood type</label>
                                    <input class="input--style-4" type="text" wire:model.blur="blood_type" name="blood_type"  required>
                                    @error('blood_type') <span class="text-danger small" style="color: red;">{{ $message }}</span>
    
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Sex at birth</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" value="Male" checked="checked" wire:model.blur="sex" name="sex" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" value="Female" wire:model.blur="sex" name="sex" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <br>
                                        @error('sex') <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-buttons">
                            <b><a href="/sign-in" style="color:#0061C4">I already have an Account.</a></b>
                            <button  class="register-button float-right" type="button" wire:click="nextSection(2)">Next<i class="bi bi-arrow-right-short"></i></button>
                        </div>
                    </div>

                    <div class="form-section {{ $currentStep === 2 ? 'visible' : '' }}">
                        <div class="section-title">
                            <h4>Contact information</h4>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Tel Number</label>
                                    <input class="input--style-4" type="text" wire:model.blur="tel_number" name="tel_number">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Mobile Number</label>
                                    <input class="input--style-4" type="text" wire:model.blur="mobile_number" name="mobile_number" required>
                                    @error('mobile_number') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2" style="width: 100% !important">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="text" wire:model.blur="email" wire:change="onBlurEmail" name="email" required >
                                    @error('email') <span class="text-danger small" style="color: red;">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        
                        <fieldset class="fieldset">
                                <legend class="label">Permanent Address</legend>
                                <div class="row row-space">
                                    <div class="col-4" style="width: 100%">
                                        <div class="input-group">
                                            <label class="label" for="permanent_province">Select Province:</label>
                                            <select class="label select select-status" wire:model.live="permanent_selectedProvince" id="permanent_province" name="permanent_selectedProvince" required>
                                                @if ($provinces)
                                                    <option class="label" value="" style="opacity: .6;">Select Province</option>
                                                    @foreach ($provinces->sortBy('province_description') as $province)
                                                        <option class="label" value="{{ $province->province_description }}">{{ $province->province_description }}</option>
                                                    @endforeach
                                                @else
                                                    <option class="label" value="">Select Province</option>
                                                @endif
                                            </select>
                                            @error('permanent_selectedProvince') <span class="text-danger small" style="color: red;">The Province Field is required</span>@enderror

                                            <label class="label" for="permanent_city">Select City:</label>
                                            <select class="label select-status" wire:model.live="permanent_selectedCity" id="permanent_city" name="permanent_selectedCity"  required>
                                                @if($pcities)
                                                    <option class="label" value="">Select City</option>
                                                    @foreach ($pcities as $city)
                                                        <option class="label" value="{{ $city->city_municipality_description }}">{{ $city->city_municipality_description }}</option>
                                                    @endforeach
                                                @else
                                                    <option class="label" value="">No cities available</option>
                                                @endif
                                            </select>
                                            @error('permanent_selectedCity') <span class="text-danger small" style="color: red;">The City field is required</span>@enderror

                                            <label class="label">Street, Barangay</label>
                                            <input class="input--style-4" type="text" wire:model="p_street_barangay" name="p_street_barangay" required >
                                            @error('p_street_barangay') <span class="text-danger small" style="color: red;">The Street and Barangay field is required</span>@enderror
                                        </div>
                                    </div>
                                </div>
                        </fieldset>

                        <fieldset class="fieldset">
                                <legend class="label">Residential Address</legend>
                                <div class="row row-space">
                                    <div class="col-4" style="width: 100%">
                                        <div class="input-group">
                                            <label class="label" for="residential_province">Select Province:</label>
                                            <select class="label select-status" wire:model.live="residential_selectedProvince" id="residential_province" name="residential_selectedProvince"  required wire:ignore>
                                                @if ($provinces)
                                                    <option class="label" value="">Select Province</option>
                                                    @foreach ($provinces->sortBy('province_description') as $province)
                                                        <option class="label" value="{{ $province->province_description }}">{{ $province->province_description }}</option>
                                                    @endforeach
                                                @else
                                                    <option class="label" value="">Select Province</option>
                                                @endif
                                            </select>
                                            @error('residential_selectedProvince') <span class="text-danger small" style="color: red;">The Province field is required</span>@enderror

                                            <label class="label" for="residential_city">Select City:</label>
                                            <select class="label select-status" wire:model.live="residential_selectedCity" id="residential_city" name="residential_selectedCity" required>
                                                @if($rcities)
                                                    <option class="label" value="">Select City</option>
                                                    @foreach ($rcities ->sortBy('city_municipality_descriptions') as $city)
                                                        <option class="label" value="{{ $city->city_municipality_description }}">{{ $city->city_municipality_description }}</option>
                                                    @endforeach
                                                @else
                                                    <option class="label" value="">No cities available</option>
                                                @endif
                                            </select>
                                            @error('residential_selectedCity') <span class="text-danger small" style="color: red;">The City field is required</span>@enderror

                                            <label class="label">Street, Barangay</label>
                                            <input class="input--style-4" type="text" wire:model="r_street_barangay" name="r_street_barangay"  required>
                                            @error('r_street_barangay') <span class="text-danger small" style="color: red;">The Street and Barangay field is required</span>@enderror
                                        </div>
                                    </div>
                                </div>
                        </fieldset>

                        <div class="section-buttons">
                            <button  class="register-button float-left" type="button" wire:click="prevSection"><i class="bi bi-arrow-left-short"></i>Prev</button>
                            <button  class="register-button float-right" type="button" wire:click="nextSection(3)">Next<i class="bi bi-arrow-right-short"></i></button>
                        </div>
                    </div>

                    <div class="form-section {{ $currentStep === 3 ? 'visible' : '' }}">
                        <div class="section-title">
                            <h4>Background Info</h4>
                        </div>

                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">Educational Background</label>
                                    <input class="input--style-4" type="text" wire:model.blur="educational_background" name="educational_background" required>
                                    @error('educational_background') <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="label">Status</label>
                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                <select class="label select-status" id="status" wire:model.defer="status" name="status" required>
                                    <option selected value="" class="label">Choose option</option>
                                    <option value="Student" class="label">Student</option>
                                    <option value="Professional" class="label">Professional</option>
                                </select>
                                <div class="select-dropdown"></div>
                                @error('status') <span class="text-danger small" style="color: red;">The status field is required</span> @enderror
                            </div>
                        </div>

                        <div class="row row-space student-details" style="{{ $status != 'Student' ? 'display: none' : '' }}">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">School name</label>
                                    <input class="input--style-4" type="text" wire:model="name_of_school" name="name_of_school">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Course</label>
                                    <input class="input--style-4" type="text" wire:model="course" name="course">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space professional-details" style="{{ $status != 'Professional' ? 'display: none' : '' }}">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nature of work</label>
                                    <input class="input--style-4" type="text" wire:model="nature_of_work" name="nature_of_work">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Employer</label>
                                    <input class="input--style-4" type="text" wire:model="employer" name="employer">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">An organization member</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            Yes
                                            <input class="org-r1" type="radio" wire:model.live="is_org_member" value="yes">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            No
                                            <input class="org-r2" type="radio" wire:model.live="is_org_member" value="no">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space org-detail" style="{{ $is_org_member === 'no' ? 'display: none' : '' }}">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Organization name</label>
                                    <input class="input--style-4" type="text" wire:model="organization_name" name="organization_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Position</label>
                                    <input class="input--style-4" type="text" wire:model="org_position" name="org_position">
                                </div>
                            </div>
                        </div>

                        <div class="section-buttons">
                            <button  class="register-button float-left" type="button" wire:click="prevSection"><i class="bi bi-arrow-left-short"></i>Prev</button>
                            <button  class="register-button float-right" type="button" wire:click="nextSection(4)">Next<i class="bi bi-arrow-right-short"></i></button>
                        </div>
                    </div>

                    <div class="form-section {{ $currentStep === 4 ? 'visible' : '' }}">
                        <div class="section-title">
                            <h4>Requirements</h4>
                        </div>

                        <div class="col-md-2 ten-advocacy-plans">
                            <label class="label">Advocacy Plans</label>
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="checkboxes p-t-10">
                                        <label class="checkbox-container">Health<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Health"></label>
                                        <label class="checkbox-container">Education<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Education"> </label>
                                        <label class="checkbox-container">Economic Empowerment<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Economic Empowerment"></label>
                                        <label class="checkbox-container">Social Inclusion and Equity<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Social Inclusion and Equity"></label>
                                        <label class="checkbox-container">Peace-building and Security<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Peace-building and Security"></label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="checkboxes p-t-10">
                                        <label class="checkbox-container">Governance<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Governance"></label>
                                        <label class="checkbox-container">Active Citizenship<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Active Citizenship"></label>
                                        <label class="checkbox-container">Environment<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Environment"></label>
                                        <label class="checkbox-container">Global Mobility<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Global Mobility"></label>
                                        <label class="checkbox-container">Agriculture<input type="checkbox" wire:model="selectedAdvocacyPlans" value="Agriculture"></label>
                                    </div>
                                </div>
                            </div>
                            @error('selectedAdvocacyPlans')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row row-space">
                            <div class="input-group">
                                <label class="label label-nc">Are you a</label>
                                <div class="p-t-10">
                                    <label class="checkbox-container">Youth Volunteer
                                        <input type="checkbox" wire:model="is_volunteer" name="is_volunteer" disabled>

                                    </label>
                                    @error('is_volunteer') <span class="text-danger small" style="color: red;">Youth Volunteer required</span>

                                    @enderror

                                    <label class="checkbox-container">International Program Participant?
                                        <input type="checkbox" wire:model="is_ip_participant" name="is_ip_participant">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="birth_certificate" class="name">Birth Certificate</label>
                                    <div class="d-flex align-items-center">
                                        <div class="file-box mr-2 d-flex align-items-center justify-content-center">
                                            <span class="file-name">{{ $birth_certificate ? $birth_certificate->getClientOriginalName() : 'No file chosen' }}</span>
                                            @if($birth_certificate)
                                                <button type="button" class="btn-cancel" wire:click.defer="removeBirthCertificate">&times;</button>
                                            @endif
                                        </div>
                                        <button type="button" class="btn-submit upload" onclick="document.getElementById('birth_certificate').click()">
                                            <i class="bi bi-upload"style="margin-left: -2px"></i>
                                        </button>
                                        <input type="file" id="birth_certificate" wire:model="birth_certificate" style="display: none;" accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                    @error('birth_certificate') <span style="color: red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="curriculum_vitae" class="col-form-label">Curriculum Vitae</label>
                                    <div class="d-flex align-items-center">
                                        <div class="file-box mr-2 d-flex align-items-center justify-content-between">
                                            <span class="file-name">{{ $curriculum_vitae ? $curriculum_vitae->getClientOriginalName() : 'No file chosen' }}</span>
                                            @if($curriculum_vitae)
                                            <button type="button" class="btn-cancel" wire:click="removeCurriculumVitae">&times;</button>
                                            @endif
                                        </div>
                                        <button type="button" class="btn-submit upload" onclick="document.getElementById('curriculum_vitae').click()">
                                            <i class="bi bi-upload"style="margin-left: -2px"></i>
                                        </button>
                                        <input type="file" id="curriculum_vitae" wire:model.defer="curriculum_vitae" style="display: none;" accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                    @error('curriculum_vitae') <span style="color: red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="good_moral_cert" class="col-form-label">Good Moral Certificate</label>
                                    <div class="d-flex align-items-center">
                                        <input type="file" id="good_moral_cert" wire:model.defer="good_moral_cert" style="display: none;" accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        <div class="file-box mr-2 d-flex align-items-center justify-content-between">
                                            <span class="file-name">{{ $good_moral_cert ? $good_moral_cert->getClientOriginalName() : 'No file chosen' }}</span>
                                            @if($good_moral_cert)
                                                <button type="button" class="btn-cancel" wire:click="removeGoodMoralCertificate">&times;</button>
                                            @endif
                                        </div>
                                        <button type="button" class="btn-submit upload" onclick="document.getElementById('good_moral_cert').click()" wire:loading.attr='disabled'>
                                            <i class="bi bi-upload"style="margin-left: -2px"></i>
                                        </button>
                                    </div>
                                    @error('good_moral_cert') <span style="color: red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="valid_Id" class="col-form-label">Valid ID</label>
                                    <div class="d-flex align-items-center">
                                        <div class="file-box mr-2 d-flex align-items-center justify-content-between">
                                            <span class="file-name">{{ $valid_Id ? $valid_Id->getClientOriginalName() : 'No file chosen' }}</span>
                                            @if($valid_Id)
                                            <button type="button" class="btn-cancel" wire:click="removeValidId">&times;</button>
                                            @endif
                                        </div>
                                        <button type="button" class="btn-submit upload" onclick="document.getElementById('valid_Id').click()">
                                            <i class="bi bi-upload"style="margin-left: -2px"></i>
                                        </button>
                                        <input type="file" id="valid_Id" wire:model.defer="valid_Id" style="display: none;" accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*">
                                    </div>
                                    @error('valid_Id') <span style="color: red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="other_document" class="col-form-label">Other</label>
                                    <div class="d-flex align-items-center">
                                        <div class="file-box d-flex flex-column align-items-start justify-content-between">
                                            @if($other_documents && count($other_documents) > 0)
                                            @foreach($other_documents as $index => $document)
                                                <div class="d-flex align-items-center w-100 mb-1">
                                                    <span class="file-name">{{ $document->getClientOriginalName() }}</span>
                                                    <button type="button" class="btn-cancel" wire:click="removeDocument({{ $index }})">&times;</button>
                                                </div>
                                            @endforeach
                                            @else
                                            <span class="file-name">No file chosen</span>
                                            @endif
                                        </div>
                                        <button type="button" class="btn-submit upload ml-2" onclick="document.getElementById('other_document').click()">
                                            <i class="bi bi-upload"style="margin-left: -2px"></i>
                                        </button>
                                        <input type="file" id="other_document" wire:model.defer="other_documents" style="display: none;" multiple accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                    @error('other_documents.*') <span style="color: red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">password</label>
                                    <input class="input--style-4" type="password" wire:model="password" name="password" required>
                                    @error('password') 
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">confirm password</label>
                                    <input class="input--style-4" type="password" wire:model="c_password" name="c_password" required>
                                    @error('c_password') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <center>
                                    <label class="labelPolicy">By clicking Sign Up, you agree to our 
                                        <a href="/terms-and-privacy-policy" target="_blank" style="color:#0061C4">Terms and Privacy Policy</a>
                                    </label>
                                </center>
                                <center>
                                    <div class="to-login-button">
                                        <b><a href="/sign-in" style="color:#0061C4">I already have an Account.</a></b>
                                    </div>
                                </center>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2" style="width: 100%">
                                <div class="p-t-15 reg-btn-holder">
                                    <button  class="register-button float-left" type="button" wire:click="prevSection"><i class="bi bi-arrow-left-short"></i>Prev</button>
                                    <button  class="register-button float-right" type="submit" wire:loading.attr="disabled">
                                        <span>Sign Up</span>
                                        <div class="loading-container {{ !$registering ? 'd-none' : '' }}">
                                            <div class="loading-spinner"></div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if(session()->has('successMessage'))
                            <br>
                            <div class="alert alert-success" role="alert" style="background-color: #dff0d8; border-color: #d6e9c6; color: #3c763d; padding: 15px; display: flex; justify-content: center; align-items: center;">
                                {{ session('successMessage') }}
                            </div>
                        @endif
                    </div>

            </form>
        </div>

    </div>
</div>
