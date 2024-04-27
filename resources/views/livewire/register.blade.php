<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="reg-logo-container">
                <img src="images/yvip_logo.png" width="100"/>
            </div>
            <div class="card-body">
                <center><h2 class="title reg-title">Registration Form</h2></center>


                <form wire:submit="create" >

                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">first name</label>
                                <input class="input--style-4" type="text" wire:model.blur="first_name" name="first_name">
                                @error('first_name') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">last name</label>
                                <input class="input--style-4" type="text" wire:model.blur="last_name" name="last_name">
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
                                    <input class="input--style-4" type="date" wire:model="date_of_birth" name="date_of_birth" style="height: 50px;">
                                    @error('date_of_birth') <span class="text-danger small" style="color: red;">The date of birth field is required</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">civil status</label>
                                    <select id="civil_status" class="label select-status" wire:model="civil_status">
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
                                <input class="input--style-4" type="number" wire:model.blur="age" name="age">
                                @error('age') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">nationality</label>
                                <input class="input--style-4" type="text" wire:model.blur="nationality" name="nationality">
                                @error('nationality') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
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
                                <input class="input--style-4" type="text" wire:model.blur="mobile_number" name="mobile_number">
                                @error('mobile_number') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Email</label>
                                <input class="input--style-4" type="text" wire:model.blur="email" wire:change="onBlurEmail" name="email" >
                                @error('email') <span class="text-danger small" style="color: red;">{{ $message }}</span>@enderror
                            </div>
                        </div>

                         <div class="col-2">
                            <div class="input-group">
                                <label class="label">Blood type</label>
                                <input class="input--style-4" type="text" wire:model.blur="blood_type" name="blood_type">
                                @error('blood_type') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>

                         <div class="col-2">
                            <div class="input-group">
                                <label class="label">Sex at birth</label>
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">Male
                                        <input type="radio" value="Male" checked="checked" wire:model.blur="sex" name="sex">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">Female
                                        <input type="radio" value="Female" wire:model.blur="sex" name="sex">
                                        <span class="checkmark"></span>
                                    </label>
                                    <br>@error('sex') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <fieldset class="fieldset">
                            <legend class="label">Permanent Address</legend>
                            <div class="row row-space">
                                <div class="col-4" style="width: 100%">
                                    <div class="input-group">
                                        <label class="label" for="permanent_province">Select Province:</label>
                                        <select class="label select select-status" wire:model.live="permanent_selectedProvince" id="permanent_province" name="permanent_selectedProvince">
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
                                        <select class="label select-status" wire:model.live="permanent_selectedCity" id="permanent_city" name="permanent_selectedCity">
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
                                        <input class="input--style-4" type="text" wire:model="p_street_barangay" name="p_street_barangay" >
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
                                        <select class="label select-status" wire:model.live="residential_selectedProvince" id="residential_province" name="residential_selectedProvince">
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
                                        <select class="label select-status" wire:model.live="residential_selectedCity" id="residential_city" name="residential_selectedCity">
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
                                        <input class="input--style-4" type="text" wire:model="r_street_barangay" name="r_street_barangay" >
                                        @error('r_street_barangay') <span class="text-danger small" style="color: red;">The Street and Barangay field is required</span>@enderror
                                    </div>
                                </div>
                            </div>
                    </fieldset>

                    <div class="row row-space">
                        <div class="col-4" style="width: 100%">
                            <div class="input-group">
                                <label class="label">Educational background</label>
                                <input class="input--style-4" type="text" wire:model.blur="educational_background" name="educational_background">
                                @error('educational_background') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label">Status</label>
                        <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                            <select class="label select-status" id="status" wire:model="status" name="status">
                                <option selected value="" class="label">Choose option</option>
                                <option value="Student" class="label">Student</option>
                                <option value="Professional" class="label">Professional</option>
                            </select>
                            <div class="select-dropdown"></div>
                            @error('status') <span class="text-danger small" style="color: red;">The status field is required</span> @enderror
                        </div>
                    </div>

                    <div class="row row-space student-details" @if($status != 'Student') style="display: none;" @endif>
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

                    <div class="row row-space professional-details" @if($status != 'Professional') style="display: none;" @endif>
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
                                        <input class="org-r1" type="radio" wire:model="is_org_member" value="yes">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        No
                                        <input class="org-r2" type="radio" wire:model="is_org_member" value="no">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-space org-detail" @if($is_org_member == 'no') style="display: none;" @endif>
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
                            <div class="input-group">
                                <label class="label">password</label>
                                <input class="input--style-4" type="password" wire:model="password" name="password">

                                @error('password')
                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group input-group-register">
                                <label class="label">confirm password</label>
                                <input class="input--style-4" type="password" wire:model="c_password" name="c_password">
                                @error('c_password') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-space">
                        <div class="col-2">
                            <div wire:loading.delay.longest>
                                <label class="label" style="font-style: italic; color: green;">Submitting ...</label>
                            </div>
                            <div class="p-t-15" wire:loading.attr="disabled">

                                <button  class="btn btn--radius-2 btn--blue" type="submit" >Submit</button>

                            </div>

                        </div>
                        <div class="col-2">
                            <div class="to-login-button">
                                <b><a href="/" style="color:#2c6ed5" wire:navigate>I already have an Account.</a></b>
                            </div>
                        </div>
                    </div>
                    @if(session()->has('successMessage'))
                        <br>
                        <div class="alert alert-success" role="alert" style="background-color: #dff0d8; border-color: #d6e9c6; color: #3c763d; padding: 15px; display: flex; justify-content: center; align-items: center;">
                            {{ session('successMessage') }}
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
