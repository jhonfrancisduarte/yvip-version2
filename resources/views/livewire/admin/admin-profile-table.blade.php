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
                    <button class="btn btn-info btn-xs" wire:click.live="openEditMyInfo"><i class="nav-icon bi bi-pencil-square"></i> Edit Profile</button>
                </div>

                @if($myInfo)
                    <div class="user-info">
                        <div class="row1 row-header">
                            <div class="col1">
                                <label class="label">Position: 
                                    <span>
                                        @if($user['user_role'] === "sa")
                                            Super Admin
                                        @elseif($user['user_role'] === "vs")
                                            Volunteer Secretariat
                                        @elseif($user['user_role'] === "vsa")
                                            Volunteer Secretariat Assistant
                                        @elseif($user['user_role'] === "ips")
                                            International Program Secretariat
                                        @endif
                                    </span>
                                </label>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Email: <span>{{ $user ? $user['email'] : '' }}</span></label>
                                </div>
                            </div>
                        </div>
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
                                    <label class="label">Firstname: <span>{{ $user ? $user['first_name'] : '' }}</span> <i class="nav-icon bi bi-pencil-square" wire:click="editThis('first_name')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Lastname: <span>{{ $user ? $user['last_name'] : '' }}</span> <i class="nav-icon bi bi-pencil-square" wire:click="editThis('last_name')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Middlename: <span>{{ $user ? $user['middle_name'] : '' }}</span> <i class="nav-icon bi bi-pencil-square" wire:click="editThis('middle_name')"></i></label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Email: <span>{{ $user ? $user['email'] : '' }}</span> <i class="nav-icon bi bi-pencil-square" wire:click="editThis('email')"></i></label>
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
                                                <input type="file" accept="image/*" id="profile_picture" wire:model.live='profile_picture' required/>
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
