<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="table-wrapper">

        <div class="table-container">

            <div class="table-header">
                <h3 class="table-title">Admin Management</h3> 
            </div>

            <div class="table-header justify-left">
                <div class="table-buttons">
                    <button type="button" class="open-dialog-btn table-button" wire:click="openAddForm" style="margin-right: 15px;">
                        <div class="is-mobile-view">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="is-desktop-view">
                            Register an Admin
                        </div>
                    </button>
                    <button type="button" class="table-button" wire:click="deactivatedAccounts">
                        @if($active_status === 1)
                            <div class="is-mobile-view">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <div class="is-desktop-view">
                                Deactivated Accounts
                            </div>
                        @else
                            <div class="is-mobile-view">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="is-desktop-view">
                                Active Accounts
                            </div>
                        @endif
                    </button>
                </div>
            </div>

            <div class="table-header justify-left">
                <div class="col-md-4">
                    <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search...">
                </div>
                <div class="mx-2"></div>
                <div class="col-md-3">
                    <select class="panel-input-1 w" wire:model.live="admin_position">
                        <option selected value="">Position</option>
                        <option value="sa">Super Admin</option>
                        <option value="vs">Volunteer Secretariat</option>
                        <option value="vsa">Volunteer Secretariat Assistant</option>
                        <option value="ips">IP Secretariat</option>
                    </select>
                    <i class="bi bi-caret-down select-icon"></i>
                </div>
            </div>

            <div class="table-header table-header-2">
                <label class="table-label">Number of Results: <span>{{ count($admins )}}</span></label>
            </div>

            <div class="table-table" id="table-table">
                <div class="table">
                    @foreach($admins as $admin)
                        <div class="table-tr" wire:key="volunteer-{{ $admin->id }}" style="height: @if(in_array($admin->id, $expandedRows)) fit-content @else 90px @endif;">
                            <div class="table-overlay"></div>
                            <div class="tr" wire:click="toggleRow('{{ $admin->id }}')">

                                <div class="primary-data">
                                    <img src="{{ $admin->profile_picture }}" style="height: 70px; width: 70px; border-radius: 50%;">
                                    <div class="data-row full-w-on-mobile p-data">
                                        <p class="table-tr-data main-data data-col-full">{{ $admin->first_name }} {{ $admin->middle_name }} {{ $admin->last_name }}</p>
                                        <p class="table-tr-data data-col-full">{{ $admin->passport_number }}</p>
                                    </div>
                                </div>

                                <div class="secondary-data @if(!in_array($admin->id, $expandedRows)) display-none @endif">
                                    <div class="data-row on-mobile m-margin-top">
                                        <p class="table-tr-data"><span>Email: </span>{{ $admin->email }}</p>
                                        <p class="table-tr-data"><span>Position: </span>
                                            @if($admin->user_role === "sa")
                                                Super Admin
                                            @elseif($admin->user_role === "vs")
                                                Volunteer Secretariat
                                            @elseif($admin->user_role === "vsa")
                                                Volunteer Secretariat Assistant
                                            @elseif($admin->user_role === "ips")
                                                IP Secretariat
                                            @endif
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="table-action-buttons">
                                <div class="mx-2"></div>
                                @if($active_status === 2)
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-success" wire:click="reactivateDialog('{{ $admin->user_id }}')">
                                            <i class="bi bi-person-check"></i>
                                        </button>
                                        <p class="hover-p">Activate</p>
                                    </div>
                                @elseif($active_status === 1)
                                    <div class="table-btn-g">
                                        <button class="open-dialog-btn table-action-button t-a-b-warning" wire:click="deleteDialog('{{ $admin->user_id }}')">
                                            <i class="bi bi-ban"></i>
                                        </button>
                                        <p class="hover-p">Deactivate</p>
                                    </div>
                                @endif
                            </div>

                            <div class="see-more">
                                <div class="see-more-bar" wire:click="toggleRow('{{ $admin->id }}')">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="m-3">
                {{ $admins->links('livewire::bootstrap') }}
            </div>

        </div>
        <div class="mt-5"></div>
    </div>

    <div class="popup popup-modal" @if(!$deleteAdminId) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="hideDeleteDialog"></div>
        <div class="popup-modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirm Deactivation</h5>
                <button type="button" class="close-dialog-btn close" wire:click="hideDeleteDialog">
                    <span></span>
                </button>
            </div>

            <div class="modal-body">
                @if($deleteMessage)
                    <p style="color: green;">{{ $deleteMessage }}</p>
                @else
                    <p>Are you sure you want to deactivate this admin?</p>
                @endif
            </div>

            <div class="modal-footer">
                @if($disableButton == "No")
                    <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                    <button class="close-dialog-btn btn-warning" wire:click="deleteAdmin('{{ $deleteAdminId }}')">Deactivate</button>
                @else
                    <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Close</button>
                @endif
            </div>

        </div>
    </div>

    <div class="popup popup-modal" @if(!$reactivateAdminId) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="hideReactivateDialog"></div>
        <div class="popup-modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Activation</h5>
                    <button type="button" class="close-dialog-btn close" wire:click="hideDeleteDialog">
                        <span></span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($deleteMessage)
                        <p style="color: green;">{{ $deleteMessage }}</p>
                    @else
                        <p>Are you sure you want to activate this admin?</p>
                    @endif
                </div>

                <div class="modal-footer">
                    @if($disableButton == "No")
                        <button class="close-dialog-btn btn-success" wire:click="reactivateVolunteer('{{ $reactivateAdminId }}')" wire:loading.attr="disabled">Yes
                        </button>
                        <button class="close-dialog-btn btn-cancel" wire:click="hideReactivateDialog">Cancel</button>
                    @else
                        <button class="close-dialog-btn btn-cancel" wire:click="hideReactivateDialog">Close</button>
                    @endif
                </div>

        </div>
    </div>

    <div class="popup popup-panel" @if(!$openAddAdminForm) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeAddForm"></div>
        <div class="panel-content-wrapper h-fit-content">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h3 class="table-title">Register an Admin</h3>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeAddForm">
                        <span>&times;</span>
                    </button>
                </div>

                <form enctype="multipart/form-data" wire:submit.prevent='create'>

                    <div class="panel-form-group block-on-mobile">
                        <div class="panel-form-group-3">
                            <span>Firstname <span class="required-mark">*</span></span>
                            <input type="text" class="panel-input-1" row="5" wire:model.live='first_name' placeholder="Firstname" required>
                            @error('first_name')
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-3">
                            <span>Lastname <span class="required-mark">*</span></span>
                            <input type="text" class="panel-input-1" row="5" wire:model.live='last_name' placeholder="Lastname" required>
                            @error('last_name')
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-3">
                            <span>Middlename</span>
                            <input type="text" class="panel-input-1" row="5" wire:model.live='middle_name' placeholder="Middlename">
                            @error('middle_name')
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="panel-form-group block-on-mobile m-top">
                        <div class="panel-form-group-2">
                            <span>Email <span class="required-mark">*</span></span>
                            <input type="text" class="panel-input-1" row="5" wire:model.live='email' placeholder="Email" required>
                            @error('email')
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-2">
                            <span>Position <span class="required-mark">*</span></span>
                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                <select  class="panel-input-1" id="position" wire:model.blur="position" name="position" required>
                                    <option selected>Choose option</option>
                                    <option value="sa">Super Admin</option>
                                    <option value="vs">Volunteer Secretariat</option>
                                    <option value="vsa">Volunteer Secretariat Assistant</option>
                                    <option value="ips">IP Secretariat</option>
                                </select>
                                <i class="bi bi-caret-down select-icon"></i>
                            </div>
                            @error('position')
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="panel-form-group block-on-mobile m-top">
                        <div class="panel-form-group-2">
                            <span>Password <span class="required-mark">*</span></span>
                            <input type="password" class="panel-input-1" row="5" wire:model.live='password' placeholder="Password" required>
                            @error('password')
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-2">
                            <span>Confirm Password <span class="required-mark">*</span></span>
                            <input type="password" class="panel-input-1" row="5" wire:model.live='c_password' placeholder="Confirm Password" required>
                            @error('c_password')
                                <span class="text-danger small" style="color: red;">Passwords didn't match!</span>
                            @enderror
                        </div>
                    </div>
         
                    <div class="popup-panel-footer">
                            <button class="close-dialog-btn btn-success btn-overide float-right" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
