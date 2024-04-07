<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    
                    
                    <form wire:submit="create">
                    
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
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" wire:model.blur="date_of_birth" name="birthday">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">civil status</label>
                                    <input class="input--style-4" type="text" wire:model="civil_status" name="civil_status">
                                    @error('civil_status') <span class="text-danger small" style="color: red;">{{ $message }}</span>

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
                                    <input class="input--style-4" type="text" wire:model.blur="email" name="email">
                                    @error('email') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                    
                                </div>
                            </div>

                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Blood type</label>
                                    <input class="input--style-4" type="text" wire:model.blur="blood_type" name="blood_type">
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

                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">permanent Address</label>
                                    <input class="input--style-4" type="text" wire:model.blur="permanent_address" name="permanent_address">
                                    @error('permanent_address') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-4" style="width: 100%">
                                <div class="input-group">
                                    <label class="label">residential Address</label>
                                    <input class="input--style-4" type="text" wire:model.blur="residential_address" name="residential_address">
                                    @error('residential_address') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                        </div>

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
                                <select  class="label select-status" id="status" wire:model.blur="status" name="status">
                                    <option selected class="label">Choose option</option>
                                    <option value="Student" class="label">Student</option>
                                    <option value="Professional" class="label">Professional</option>    
                                </select>
                                <div class="select-dropdown"></div>
                                @error('status') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>

                        <div class="row row-space professional-details">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nature of work</label>
                                    <input class="input--style-4" type="text" wire:model.blur="nature_of_work" name="nature_of_work">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Employer</label>
                                    <input class="input--style-4" type="password" wire:model.blur="employer" name="employer">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space student-details">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">School name</label>
                                    <input class="input--style-4" type="text" wire:model.blur="name_of_school" name="name_of_school">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Course</label>
                                    <input class="input--style-4" type="text" wire:model.blur="course" name="course">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space org-detail">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Organization name</label>
                                    <input class="input--style-4" type="text" wire:model.blur="organization_name" name="organization_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">position</label>
                                    <input class="input--style-4" type="text" wire:model.blur="org_position" name="employer">
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
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">password</label>
                                    <input class="input--style-4" type="password" wire:model="password" name="password">
                                    @error('password') <span class="text-danger small" style="color: red;">{{ $message }}</span>

                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">confirm password</label>
                                    <input class="input--style-4" type="password" wire:model="c_password" name="c_password">
                                    @error('c_password') <span class="text-danger small" style="color: red;">{{ $message }}</span>

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