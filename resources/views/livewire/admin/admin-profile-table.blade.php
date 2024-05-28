<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="table-wrapper">
        <div class="table-container">
            <div class="cover">
                <img class="cover-yvip-logo" src="images/yvip_logo.png" width="70">
            </div>

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
                    <button class="btn" wire:click.live="openEditMyInfo"><i class="nav-icon bi bi-pencil-square"></i> Edit Profile</button>
                </div>

                @if($myInfo)
                    <div class="user-info">
                        <div class="row1">
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
                        <div class="modal-header">
                            <h5 class="modal-title">Edit profile</h5>
                            <button class="btn-cancel" wire:click.live="closeEditMyInfo">Cancel</button>  
                        </div>
                        
                        <div class="row1" style="margin-top: 10px">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Fullname: 
                                        <span>{{ $user ? $user['first_name'] : '' }} {{ $user ? $user['middle_name'] : '' }} {{ $user ? $user['last_name'] : '' }}
                                            <i class="nav-icon bi bi-pencil-square" wire:click="editThis('full_name')"></i>
                                        </span> 
                                    </label>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Nickname: <span>{{ $user ? $user['nickname'] : '' }}</span> <i class="nav-icon bi bi-pencil-square" wire:click="editThis('nickname')"></i></label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row1">
                            <div class="col2">
                                <div class="user-data">
                                    <label class="label">Email: <span>{{ $user ? $user['email'] : '' }}</span> <i class="nav-icon bi bi-pencil-square" wire:click="editThis('email')"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="edit-footer">
                            <button class="btn-submit" wire:click="editThis('password')">Change Password</button>  
                            <button class="btn-delete" wire:click.live="deleteDialog">Delete Account</button>  
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="popup popup-modal" @if(!$openEditProfile) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeEditProfileForm"></div>
        <div class="popup-modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Update Profile Picture</h3>
                <button type="button" class="close-dialog-btn close" wire:click="closeEditProfileForm">
                    <span>&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="editProfilePic('{{ $user->user_id }}')">

                <div class="panel-form-group">
                    <div wire:loading wire:target="featured_image" class="loading-container">
                        <div class="loading-spinner"></div>
                    </div>
                    <input id="profile_picture" type="file" accept="image/*" wire:model.live='profile_picture' style="display: none"/>
                    <button type="button" class="file-btn" onclick="document.getElementById('profile_picture').click()"> 
                        @if($profile_picture)
                            {{ $profile_picture->getClientOriginalName() }}
                        @else
                            <i class="bi bi-upload"style="margin-left: -2px"></i>
                        @endif
                    </button>
                </div>
                @error('profile_picture') <span class="red">Wait until file is uploaded</span> @enderror

                <div class="modal-footer justify-content-between">
                    <button class="btn-submit" type="submit" {{ $profile_picture ? '' : 'disabled' }}>
                        Save
                    </button>
                    <div wire:loading wire:target="profile_picture" class="loading-container">
                        <div class="loading-spinner"></div>
                    </div>
                </div>
                    
            </form>
    
        </div>
    </div>


    <div class="popup popup-panel" @if(!$toBeEdited) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeEditProfileForm"></div>
        <div class="panel-content-wrapper h-fit-content">
            <div class="popup-panel-content" style="margin-left: 5px">
                
                <div class="popup-panel-header">
                    <h3 class="table-title">Edit info</h3>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeEditProfileForm">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="updateInfo('{{ $toBeEdited }}')">
                    @if($toBeEdited === "password")
                      
                        <div class="panel-form-group">
                            <span class="span-label">Current Password <span class="required-mark">*</span></span>
                            <input class="panel-input-1" type="password" wire:model.live="password" required>
                        </div>
                        <div class="panel-form-group">
                            <span class="span-label">New Password <span class="required-mark">*</span></span>
                            <input class="panel-input-1" type="password" wire:model.live="new_password" required>
                        </div>
                        <div class="panel-form-group">
                            <span class="span-label">Confirm New Password <span class="required-mark">*</span></span>
                            <input class="panel-input-1" type="password" wire:model.live="c_new_pass" required>
                        </div>
      
                        @error('new_password') 
                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                        @enderror
                    @elseif($toBeEdited === "full_name")
                        <div class="row1">
                            <div class="panel-form-group">
                                <span class="span-label">Firstname <span class="required-mark">*</span></span>
                                <input class="panel-input-1" type="text" wire:model.live="first_name" required value="{{ $first_name }}">
                            </div>
                            @error('first_name') 
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror

                            <div class="panel-form-group">
                                <span class="span-label">Middlename</span>
                                <input class="panel-input-1" type="text" wire:model.live="middle_name" value="{{ $middle_name }}">
                            </div>
                            @error('middle_name') 
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror

                            <div class="panel-form-group">
                                <span class="span-label">Lastname <span class="required-mark">*</span></span>
                                <input class="panel-input-1" type="text" wire:model.live="last_name" required value="{{ $last_name }}">
                            </div>
                            @error('last_name') 
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="panel-form-group">
                            <span class="span-label label-formatted">{{ $formattedData }} <span class="required-mark">*</span></span>
                            <input class="panel-input-1" type="text" wire:model.live="thisData" value="{{ $thisData }}" required>
                        </div>
                        @error('thisData') 
                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                        @enderror

                    @endif                     

                    <div class="popup-panel-footer">
                        <button class="close-dialog-btn btn-success btn-overide float-right" type="submit" wire:loading.attr="disabled" style="margin-right: 10px">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="popup popup-modal" @if(!$deleteAccDialog) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="hideDeleteDialog"></div>
        <div class="popup-modal-content">
            
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close-dialog-btn close" wire:click="hideDeleteDialog">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete your account?</p>
                </div>

                <div class="modal-footer">
                    <button class="close-dialog-btn btn-delete" wire:click="deleteAccount" wire:loading.attr="disabled">Yes</button>
                    <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                </div>

        </div>
    </div>    

</div>
