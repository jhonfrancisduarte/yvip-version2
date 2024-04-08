<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>

                    <form wire:submit.prevent="create">
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
<<<<<<< HEAD
                                    <label class="label">First Name</label>
                                    <input class="input--style-4" type="text" wire:model="first_name" name="first_name">
                                    @error('first_name') 
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" wire:model.blur="first_name" name="first_name">
                                    @error('first_name') <span class="text-danger small" style="color: red;">{{ $message }}</span>
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                                
                                    
                                

                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="last_name" name="last_name">
                                    @error('last_name')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="last_name" name="last_name">
                                    @error('last_name') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">middle name</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="middle_name" name="middle_name">
                                    @error('middle_name')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="middle_name" name="middle_name">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
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
                                    <label class="label">Date of Birth</label>
                                    <div class="input-group-icon">
<<<<<<< HEAD
                                        <input class="input--style-4 js-datepicker" type="text" wire:model.lazy="date_of_birth" name="birthday">
=======
                                        <input class="input--style-4 js-datepicker" type="text" wire:model.blur="date_of_birth" name="birthday">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
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
<<<<<<< HEAD
                                    @error('civil_status')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    @error('civil_status') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">age</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="number" wire:model="age" name="age">
                                    @error('age')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="number" wire:model.blur="age" name="age">
                                    @error('age') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">nationality</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="nationality" name="nationality">
                                    @error('nationality')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="nationality" name="nationality">
                                    @error('nationality') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
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
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="mobile_number" name="mobile_number">
                                    @error('mobile_number')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="mobile_number" name="mobile_number">
                                    @error('mobile_number') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="email" name="email">
                                    @error('email')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="email" name="email">
                                    @error('email') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>

                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Blood type</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="blood_type" name="blood_type">
                                    @error('blood_type')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="blood_type" name="blood_type">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
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
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="permanent_address" name="permanent_address">
                                    @error('permanent_address')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="permanent_address" name="permanent_address">
                                    @error('permanent_address') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">residential Address</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="residential_address" name="residential_address">
                                    @error('residential_address')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="residential_address" name="residential_address">
                                    @error('residential_address') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">Educational background</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="educational_background" name="educational_background">
                                    @error('educational_background')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    <input class="input--style-4" type="text" wire:model.blur="educational_background" name="educational_background">
                                    @error('educational_background') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                        </div>
                            
                        <div class="input-group">
                            <label class="label">Status</label>
                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
<<<<<<< HEAD
                                <select class="label select-status" id="status" wire:model="status" name="status">
=======
                                <select  class="label select-status" id="status" wire:model.blur="status" name="status">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    <option selected class="label">Choose option</option>
                                    <option value="Student" class="label">Student</option>
                                    <option value="Professional" class="label">Professional</option>
                                </select>
                                <div class="select-dropdown"></div>
<<<<<<< HEAD
                                
=======
                                @error('status') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                            </div>
                            @error('status')
                                <span class="error" style="color: red;">Please select at least one option</span>
                            @enderror
                        </div>

                        <div class="row row-space professional-details" wire:ignore.self>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nature of work</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="nature_of_work" name="nature_of_work">
                                    @error('nature_of_work')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="nature_of_work" name="nature_of_work">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Employer</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="employer" name="employer">
                                    @error('employer')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
=======
                                    <input class="input--style-4" type="password" wire:model.blur="employer" name="employer">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                </div>
                            </div>
                        </div>

                        <div class="row row-space student-details" wire:ignore.self>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">School name</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="name_of_school" name="name_of_school">
                                    @error('name_of_school')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="name_of_school" name="name_of_school">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Course</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="course" name="course">
                                    @error('course')
                                        <span class="error" style="color: red;">Please fill out this field</span>
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="course" name="course">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
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
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="organization_name" name="organization_name">
                                    @error('organization_name')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="organization_name" name="organization_name">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">position</label>
<<<<<<< HEAD
                                    <input class="input--style-4" type="text" wire:model="org_position" name="employer">
                                    @error('employer')
                                        <span class="error" style="color: red;">Please fill out this field</span> 
                                    @enderror
=======
                                    <input class="input--style-4" type="text" wire:model.blur="org_position" name="employer">
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="input-group">
                                <label class="label label-nc">Are you a</label>
                                <div class="p-t-10">
                                    <label class="checkbox-container">Youth Volunteer?
                                        <input type="checkbox" wire:model.blur="is_volunteer" name="is_volunteer">
                                    </label>
                                    <label class="checkbox-container">International Program Participant?
                                        <input type="checkbox" wire:model.blur="is_ip_participant" name="is_ip_participant">
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
<<<<<<< HEAD
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">confirm password</label>
                                    <input class="input--style-4" type="password" wire:model="c_password" name="c_password">
<<<<<<< HEAD
                                    @error('c_password') 
                                        <span class="error" style="color: red;">Please fill out this field</span> 
=======
                                    @error('c_password') <span class="text-danger small" style="color: red;">{{ $message }}</span>

>>>>>>> 326207829443e6a009cc5c8f116be3e217ae3d04
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
                        @if (session('success'))
                        <br>
                        <div class="alert alert-success" role="alert">
                            <span class="font-medium">{{ session('success') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </form>


                </div>
            </div>
        </div>
</div>