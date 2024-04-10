<section class="content volunteers-table-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Youth Volunteers Management</h3> 
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" style="margin-left:20px; font-family:'Arial', sans !important;"><i class="fa fa-plus">Add</i>
                        </button>

                        <div class="modal fade" id="add">
                            <div class="modal-dialog modal-md">
                                <form action="" method="post" id="add-volunteer-form" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="card card-primary">
                                            <div class="card-body">
                                            <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Fullname</label>
                                                <input type="text" class="form-control" row="5" id="" name="" placeholder="-          Firstname           -        Middlename         -         Lastname          -">
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Username ..">
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control" row="5" id="" name="" placeholder="Enter Password ..">
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Contact</label>
                                                <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Contact ..">
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Email ..">
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category</label>
                                                <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter User Category ..">
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control">
                                                <option>Active</option>
                                                <option>Inactive</option>
                                            </select>
                                            </div>
                                            </div>
                                            
                                            
                                            <div class="col-12">
                                            <div class="form-group">
                                                <input type="file" id="file" />
                                                <label for="file" class="btn-2"><i class="fa fa-file-image"></i> Avatar</label>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-header card-header1">
                        <label for="" class="label">Filter: </label>
                        <div class="col-md-2">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        <div class="col-md-1">
                            <select class="form-control" wire:model.live="civil_status">
                                <option selected disabled>Civil Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <select class="form-control" wire:model.live="age_range">
                                <option disabled selected>Age</option>
                                @foreach($ageRange as $age)
                                    <option value="{{ $age->age }}">{{ $age->age }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <select class="form-control" wire:model.live="municipality">
                                <option disabled selected>Municipality</option>
                                {{-- @foreach($ageRange as $age)
                                    <option value="{{ $age->age }}">{{ $age->age }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="col-md-1">
                            <select class="form-control" wire:model.live="province">
                                <option disabled selected>Province</option>
                                {{-- @foreach($ageRange as $age)
                                    <option value="{{ $age->age }}">{{ $age->age }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="card-header card-header1">
                        <label class="label">Number of Results: <span>{{ count($volunteers )}}</span></label>
                    </div>

                    <div class="card-body">
        
                        <table id="volunteers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="7%">Actions</th>
                                    <th>Passport Number</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Nickname</th>
                                    <th>Tel Number</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Sex at Birth</th>
                                    <th>Age</th>
                                    <th>Date of Birth</th>
                                    <th>Civil Status</th>
                                    <th>Nationality</th>
                                    <th>Blood Type</th>
                                    <th>Permanent Address</th>
                                    <th>Residential Address</th>
                                    <th>Educational Background</th>
                                    <th>Status</th>
                                    <th>Work/School</th>
                                    <th>Employer/Course</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    <tr>
                                        <td>
                                            <button class="btn btn-info btn-xs" wire:click="showUserData({{ $volunteer->user_id }})">View</button>
                                            <button class="btn btn-danger btn-xs" wire:click="deleteDialog({{ $volunteer->user_id }})">Delete</button>
                                        </td>
                                        <td>{{ $volunteer->passport_number }}</td>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->middle_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>{{ $volunteer->nickname }}</td>
                                        <td>{{ $volunteer->tel_number }}</td>
                                        <td>{{ $volunteer->mobile_number }}</td>
                                        <td>{{ $volunteer->email }}</td>
                                        <td>{{ $volunteer->sex }}</td>
                                        <td>{{ $volunteer->age }}</td>
                                        <td>{{ $volunteer->date_of_birth }}</td>
                                        <td>{{ $volunteer->civil_status }}</td>
                                        <td>{{ $volunteer->nationality }}</td>
                                        <td>{{ $volunteer->blood_type }}</td>
                                        <td>{{ $volunteer->permanent_address }}</td>
                                        <td>{{ $volunteer->residential_address }}</td>
                                        <td>{{ $volunteer->educational_background }}</td>
                                        <td>{{ $volunteer->status }}</td>
                                        @if($volunteer->status == "Professional")
                                            <td>{{ $volunteer->nature_of_work }}</td>
                                            <td>{{ $volunteer->employer }}</td>
                                        @endif
                                        @if($volunteer->status == "Student")
                                            <td>{{ $volunteer->name_of_school }}</td>
                                            <td>{{ $volunteer->course }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th width="7%">Actions</th>
                                    <th>Passport Number</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Nickname</th>
                                    <th>Tel Number</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Sex at Birth</th>
                                    <th>Age</th>
                                    <th>Date of Birth</th>
                                    <th>Civil Status</th>
                                    <th>Nationality</th>
                                    <th>Blood Type</th>
                                    <th>Permanent Address</th>
                                    <th>Residential Address</th>
                                    <th>Educational Background</th>
                                    <th>Status</th>
                                    <th>Work/School</th>
                                    <th>Employer/Course</th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="modal fade" id="update">
                            <div class="modal-dialog modal-md">
                                <form action=".php" method="post" id="edit-user-form">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card card-primary">
                                        <div class="card-body">
                                        <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" row="5" id="" name="" placeholder="-          Firstname           -        Middlename         -         Lastname          -">
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Username ..">
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password</label>
                                            <input type="password" class="form-control" row="5" id="" name="" placeholder="Enter Password ..">
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contact</label>
                                            <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Contact ..">
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter Email ..">
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category</label>
                                            <input type="text" class="form-control" row="5" id="" name="" placeholder="Enter User Category ..">
                                        </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                        </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="file" id="file" />
                                                <label for="file" class="btn-2"><i class="fa fa-file-image"></i> Avatar</label>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($deleteVolunteerId)
        <div class="users-data-all-container">
            <div class="user-info">

                <div class="row1 row-header">
                    <div class="col1">
                        @if($deleteMessage)
                            <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                        @else
                            <label class="label">Are you sure you want to delete this volunteer?</label>
                        @endif
                    </div>
                </div>
                
                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            @if($disableButton == "No")
                                <button class="btn-danger btn-50" wire:click="deleteVolunteer({{ $deleteVolunteerId }})" wire:loading.attr="disabled">Yes
                                    {{-- <div class="loader" wire:loading></div> --}}
                                </button>
                                <button class="btn-close-user-data btn-50" wire:click="hideDeleteDialog">Cancel</button>
                            @else
                                <button class="btn-close-user-data btn-50" wire:click="hideDeleteDialog">Close</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif

    @if($selectedUserDetails)
        <div class="users-data-all-container">
            <div class="user-info">
                <div class="row1 row-header">
                    <div class="col1">
                        <img src="{{ $selectedUserDetails['profile_picture'] }}" alt="" width="100" style="border-radius: 10px;">
                        <label class="label">Passport Number: <span>{{ $selectedUserDetails ? $selectedUserDetails['passport_number'] : '' }}</span></label>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Firstname: <span>{{ $selectedUserDetails ? $selectedUserDetails['first_name'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Middlename: <span>{{ $selectedUserDetails ? $selectedUserDetails['middle_name'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Date of Birth: <span>{{ $selectedUserDetails ? $selectedUserDetails['date_of_birth'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Age: <span>{{ $selectedUserDetails ? $selectedUserDetails['age'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Tel Number: <span>{{ $selectedUserDetails ? $selectedUserDetails['tel_number'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Email: <span>{{ $selectedUserDetails ? $selectedUserDetails['email'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Sex at Birth: <span>{{ $selectedUserDetails ? $selectedUserDetails['sex'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Lastname: <span>{{ $selectedUserDetails ? $selectedUserDetails['last_name'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Nickname: <span>{{ $selectedUserDetails ? $selectedUserDetails['nickname']: '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Civil Status: <span>{{ $selectedUserDetails ? $selectedUserDetails['civil_status'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Nationality: <span>{{ $selectedUserDetails ? $selectedUserDetails['nationality'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Mobile Number: <span>{{ $selectedUserDetails ? $selectedUserDetails['mobile_number'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Blood Type: <span>{{ $selectedUserDetails ? $selectedUserDetails['blood_type'] : '' }}</span></label>
                        </div>
                        <div class="user-data">
                            <label class="label">Educational Background: <span>{{ $selectedUserDetails ? $selectedUserDetails['educational_background'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1">
                    <div class="col1">
                        <label class="label">Permanent Adrress: <span>{{ $selectedUserDetails ? $selectedUserDetails['permanent_address'] : '' }}</span></label>
                    </div>
                </div>

                <div class="row1">
                    <div class="col1">
                        <label class="label">Residential Adrress: <span>{{ $selectedUserDetails ? $selectedUserDetails['residential_address'] : '' }}</span></label>
                    </div>
                </div>

                <div class="row1">
                    <div class="col1">
                        <label class="label">Status: <span>{{ $selectedUserDetails ? $selectedUserDetails['status'] : '' }}</span></label>
                    </div>
                </div>

                @if($selectedUserDetails['name_of_school'])
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">School Name: <span>{{ $selectedUserDetails ? $selectedUserDetails['name_of_school'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Course: <span>{{ $selectedUserDetails ? $selectedUserDetails['course'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                @endif

                @if($selectedUserDetails['nature_of_work'])
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Nature of Work: <span>{{ $selectedUserDetails ? $selectedUserDetails['nature_of_work'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Employer: <span>{{ $selectedUserDetails ? $selectedUserDetails['employer'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                @endif

                @if($selectedUserDetails['organization_name'])
                    <div class="row1">
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Organization Name: <span>{{ $selectedUserDetails ? $selectedUserDetails['organization_name'] : '' }}</span></label>
                            </div>
                        </div>
                        <div class="col2">
                            <div class="user-data">
                                <label class="label">Position: <span>{{ $selectedUserDetails ? $selectedUserDetails['org_position'] : '' }}</span></label>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            <button class="btn-green" wire:click="exportToPdf" wire:loading.attr="disabled">Export Data</button>
                            <button class="btn-close-user-data" wire:click="hideUserData">Close</button>
                            <button class="btn-danger" wire:click="deleteDialog({{ $selectedUserDetails['user_id'] }})" wire:loading.attr="disabled">Delete Volunteer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif

</section>
