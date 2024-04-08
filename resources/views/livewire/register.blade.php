<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>

                    <form wire:submit.prevent="create">
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">First Name</label>
                                    <input class="input--style-4" type="text" wire:model="first_name" name="first_name">
                                    @error('first_name') 
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" wire:model="last_name" name="last_name">
                                    @error('last_name')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">middle name</label>
                                    <input class="input--style-4" type="text" wire:model="middle_name" name="middle_name">
                                    @error('middle_name')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">nickname</label>
                                    <input class="input--style-4" type="text" wire:model="nickname" name="nickname">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Date of Birth</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" wire:model.lazy="date_of_birth" name="birthday">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                        @error('date_of_birth')
                                            <span class="error" style="color: red;">Please select a date</span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">civil status</label>
                                    <input class="input--style-4" type="text" wire:model="civil_status" name="civil_status">
                                    @error('civil_status')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">age</label>
                                    <input class="input--style-4" type="number" wire:model="age" name="age">
                                    @error('age')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">nationality</label>
                                    <input class="input--style-4" type="text" wire:model="nationality" name="nationality">
                                    @error('nationality')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Tel Number</label>
                                    <input class="input--style-4" type="text" wire:model="tel_number" name="tel_number">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Mobile Number</label>
                                    <input class="input--style-4" type="text" wire:model="mobile_number" name="mobile_number">
                                    @error('mobile_number')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="text" wire:model="email" name="email">
                                    @error('email')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>

                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Blood type</label>
                                    <input class="input--style-4" type="text" wire:model="blood_type" name="blood_type">
                                    @error('blood_type')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>

                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Sex at birth</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" value="Male" checked="checked" wire:model="sex" name="sex">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" value="Female" wire:model="sex" name="sex">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    @error('sex')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">permanent Address</label>
                                    <input class="input--style-4" type="text" wire:model="permanent_address" name="permanent_address">
                                    @error('permanent_address')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">residential Address</label>
                                    <input class="input--style-4" type="text" wire:model="residential_address" name="residential_address">
                                    @error('residential_address')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">Educational background</label>
                                    <input class="input--style-4" type="text" wire:model="educational_background" name="educational_background">
                                    @error('educational_background')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                            
                        <div class="input-group">
                            <label class="label">Status</label>
                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                <select class="label select-status" id="status" wire:model="status" name="status">
                                    <option selected class="label">Choose option</option>
                                    <option value="Student" class="label">Student</option>
                                    <option value="Professional" class="label">Professional</option>
                                </select>
                                <div class="select-dropdown"></div>
                                
                            </div>
                            @error('status')
                                <span class="error" style="color: red;">Please select at least one option</span>
                            @enderror
                        </div>

                        <div class="row row-space professional-details" wire:ignore.self>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nature of work</label>
                                    <input class="input--style-4" type="text" wire:model="nature_of_work" name="nature_of_work">
                                    @error('nature_of_work')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Employer</label>
                                    <input class="input--style-4" type="text" wire:model="employer" name="employer">
                                    @error('employer')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space student-details" wire:ignore.self>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">School name</label>
                                    <input class="input--style-4" type="text" wire:model="name_of_school" name="name_of_school">
                                    @error('name_of_school')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Course</label>
                                    <input class="input--style-4" type="text" wire:model="course" name="course">
                                    @error('course')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">An organization member</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Yes
                                            <input class="org-r1" type="radio" checked="checked" name="org_option">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">No
                                            <input class="org-r2" type="radio" name="org_option">
                                            <span class="checkmark"></span>
                                        </label>
                                        @error('org_option')
                                            <span class="error" style="color: red;">Please fill out this field</span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space org-detail">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Organization name</label>
                                    <input class="input--style-4" type="text" wire:model="organization_name" name="organization_name">
                                    @error('organization_name')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">position</label>
                                    <input class="input--style-4" type="text" wire:model="org_position" name="employer">
                                    @error('employer')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="input-group">
                                <label class="label label-nc">Are you a</label>
                                <div class="p-t-10">
                                    <label class="checkbox-container">Youth Volunteer?
                                        <input type="checkbox" wire:model="is_volunteer" name="is_volunteer">
                                    </label>
                                    <label class="checkbox-container">International Program Participant?
                                        <input type="checkbox" wire:model="is_ip_participant" name="is_ip_participant">
                                    </label>
                                    @if ($errors->has('is_volunteer') || $errors->has('is_ip_participant'))
                                        <span class="error" style="color: red;">Please select at least one option.</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">password</label>
                                    <input class="input--style-4" type="password" wire:model="password" name="password">
                                    @error('password') 
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">confirm password</label>
                                    <input class="input--style-4" type="password" wire:model="c_password" name="c_password">
                                    @error('c_password') 
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="p-t-15">
                                    <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="to-login-button">
                                    <b><a href="/" style="color:#2c6ed5">I already have an Account.</a></b>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
</div>