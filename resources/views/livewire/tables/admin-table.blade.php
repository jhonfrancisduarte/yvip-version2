<section class="content volunteers-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="container-fluid">
        <div class="row volunteer-row">
            <div class="col-12 table-contain">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admin and Secretariat Management</h3> 
                        <button type="button" class="btn btn-success btn-sm btn-register" wire:click="openAddForm">Register an Admin</i>
                        </button>
                        
                    </div>
                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model.live="admin_position">
                                <option selected value="">Position</option>
                                <option class="label" value="sa">Super Admin</option>
                                <option class="label" value="vs">Volunteer Secretariat</option>
                                <option class="label" value="vsa">Volunteer Secretariat Assistant</option>
                                <option class="label" value="aps">IP Secretariat</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-header card-header1">
                        <label class="label">Number of Results: <span>{{ count($admins )}}</span></label>
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table-main">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th width="10%" class="action-btn"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->first_name }}</td>
                                        <td>{{ $admin->middle_name }}</td>
                                        <td>{{ $admin->last_name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @if($admin->user_role === "sa")
                                                <p class="green">Super Admin</p>
                                            @elseif($admin->user_role === "vs")
                                                <p class="blue">Volunteer Secretariat</p>
                                            @elseif($admin->user_role === "vsa")
                                                <p class="light-blue">Volunteer Secretariat Assistant</p> 
                                            @elseif($admin->user_role === "ips")
                                                <p class="orange">IP Secretariat</p> 
                                            @endif
                                        </td>
                                        <td width="10%" class="action-btn">
                                            <button class="btn btn-xs light-blue" wire:click="showUserData({{ $admin->user_id }})"><i class="bi bi-eye"></i> View</button>
                                            <button class="btn btn-xs red" wire:click="deleteDialog({{ $admin->user_id }})"><i class="bi bi-trash3"></i> Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($deleteAdminId)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info">
                <div class="row1 row-header">
                    <div class="col1">
                        @if($deleteMessage)
                            <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                        @else
                            <label class="label">Are you sure you want to delete this admin?</label>
                        @endif
                    </div>
                </div>
                
                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            @if($disableButton == "No")
                                <button class="btn-danger btn-50" wire:click="deleteAdmin({{ $deleteAdminId }})" wire:loading.attr="disabled">Yes
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
            <div class="close-form" wire:click="hideUserData"></div>
            <div class="user-info">
                <div class="row1 row-header">
                    <div class="col1">
                        <img src="{{ $selectedUserDetails['profile_picture'] }}" alt="" width="100" style="border-radius: 10px;">
                        <label class="label">Position: 
                            <span>
                                @if($selectedUserDetails['user_role'] === "sa")
                                    Super Admin
                                @elseif($selectedUserDetails['user_role'] === "vs")
                                    Volunteer Secretariat
                                @elseif($selectedUserDetails['user_role'] === "vsa")
                                    Volunteer Secretariat Assistant
                                @elseif($selectedUserDetails['user_role'] === "ips")
                                    IP Secretariat
                                @endif
                            </span>
                        </label>
                    </div>
                </div>

                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Firstname: <span>{{ $selectedUserDetails ? $selectedUserDetails['first_name'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Lastname: <span>{{ $selectedUserDetails ? $selectedUserDetails['last_name'] : '' }}</span></label>
                        </div>
                    </div>
                </div>
                
                <div class="row1">
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Middlename: <span>{{ $selectedUserDetails ? $selectedUserDetails['middle_name'] : '' }}</span></label>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="user-data">
                            <label class="label">Email: <span>{{ $selectedUserDetails ? $selectedUserDetails['email'] : '' }}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            <button class="btn-close-user-data" wire:click="hideUserData">Close</button>
                            <button class="btn-danger" wire:click="deleteDialog({{ $selectedUserDetails['user_id'] }})" wire:loading.attr="disabled">Delete Admin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif

    @if($openAddAdminForm)
        <div class="anns">
            <div class="close-form" wire:click="closeAddForm"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Register an Admin</h4>
                            <button type="button" class="close" wire:click="closeAddForm">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form enctype="multipart/form-data" wire:submit.prevent='create'>
                            <div class="card card-primary">
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" row="5" wire:model.live='first_name' placeholder="Firstname" required>
                                                @error('first_name') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" class="form-control" row="5" wire:model.live='middle_name' placeholder="Middlename" required>
                                                @error('middle_name') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" row="5" wire:model.live='last_name' placeholder="Lastname" required>
                                                @error('last_name') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" row="5" wire:model.live='email' placeholder="Email" required>
                                                @error('email') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Position</label>
                                                <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                                    <select  class="form-control select-status" id="position" wire:model.blur="position" name="position" required>
                                                        <option selected class="form-control">Choose option</option>
                                                        <option value="sa" class="form-control">Super Admin</option>
                                                        <option value="vs" class="form-control">Volunteer Secretariat</option>    
                                                        <option value="vsa" class="form-control">Volunteer Secretariat Assistant</option>    
                                                        <option value="ips" class="form-control">IP Secretariat</option>    
                                                    </select>
                                                    <div class="select-dropdown"></div>
                                                </div>
                                                @error('position') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" row="5" wire:model.live='password' placeholder="Password" required>
                                                @error('password') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" row="5" wire:model.live='c_password' placeholder="Confirm Password" required>
                                                @error('c_password') 
                                                    <span class="text-danger small" style="color: red;">Passwords didn't match!</span>
                                                @enderror
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

</section>
