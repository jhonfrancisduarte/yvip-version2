<div>

    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                        <h3 class="card-title">Admin Management</h3>
                        <div class="top-buttons">
                            <button type="button" class="btn-submit" wire:click="openAddForm" style="margin-right: 15px;">
                                <div class="is-mobile-view">
                                    <i class="bi bi-plus-lg"></i>
                                </div>
                                <div class="is-desktop-view">
                                    Register an Admin
                                </div>
                            </button>
                            <button type="button" class="btn-submit btn-accounts" style="float: right;" wire:click="deactivatedAccounts">
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
                            @if($active_status === 1)
                                {{-- <span style="color:white; background-color: {{ count($deactivatedAdmin) > 0 ? 'red' : 'rgb(245, 245, 245)' }}">{{ count($deactivatedAdmin) }}</span> --}}
                            @endif
                        </div>
                    </div>

                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                        <div class="mx-2"></div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model.live="admin_position">
                                <option selected value="">Position</option>
                                <option class="label" value="sa">Super Admin</option>
                                <option class="label" value="vs">Volunteer Secretariat</option>
                                <option class="label" value="vsa">Volunteer Secretariat Assistant</option>
                                <option class="label" value="ips">IP Secretariat</option>
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
                                    <th class="th-border-rad">Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th width="8%" class="action-btn2 th-action-btn"></th>
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
                                                Super Admin
                                            @elseif($admin->user_role === "vs")
                                                Volunteer Secretariat
                                            @elseif($admin->user_role === "vsa")
                                                Volunteer Secretariat Assistant
                                            @elseif($admin->user_role === "ips")
                                                IP Secretariat
                                            @endif
                                        </td>
                                        <td width="8%" class="action-btn2 width">
                                            <div class="btn-group" role="group">
                                                <div class="btn-g">
                                                    <button class="btn-submit" wire:click="showUserData('{{ $admin->user_id }}')">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <span class="span span-submit">View</span>
                                                </div>
                                                <div class="mx-1"></div>
                                                @if($active_status === 2)
                                                    <div class="btn-g">
                                                        <button class="btn-success" wire:click="reactivateDialog('{{ $admin->user_id }}')">
                                                            <i class="bi bi-person-check"></i>
                                                        </button>
                                                        <span class="span span-delete">Activate</span>
                                                    </div>
                                                @elseif($active_status === 1)
                                                    <div class="btn-g">
                                                        <button class="btn-warning" wire:click="deleteDialog('{{ $admin->user_id }}')">
                                                            <i class="bi bi-ban"></i>
                                                        </button>
                                                        <span class="span span-delete">Deactivate</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="m-3">
                        {{ $admins->links('livewire::bootstrap') }}
                    </div>
                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

    @if($deleteAdminId)
        <div class="users-data-all-container no-padding">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info user-infos">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deactivation</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                        <span aria-hidden="true">&times;</span>
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
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                        <button class="btn-warning" wire:click="deleteAdmin('{{ $deleteAdminId }}')">Deactivate</button>
                    @else
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if($reactivateAdminId)
        <div class="users-data-all-container no-padding">
            <div class="close-form" wire:click="hideReactivateDialog"></div>
            <div class="user-info user-infos">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Activate</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                        <span aria-hidden="true">&times;</span>
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
                        <button class="btn-success" wire:click="reactivateVolunteer('{{ $reactivateAdminId }}')" wire:loading.attr="disabled">Yes
                        </button>
                        <button class="btn-cancel" wire:click="hideReactivateDialog">Cancel</button>
                    @else
                        <button class="btn-cancel" wire:click="hideReactivateDialog">Close</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if($selectedUserDetails)
        <div class="users-data-all-container no-padding">
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
                            <button class="btn-cancel" wire:click="hideUserData">Close</button>
                            @if($active_status === 2)
                                <button class="btn-success" wire:click="reactivateDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Activate</button>
                            @else
                                <button class="btn-warning" wire:click="deleteDialog('{{ $selectedUserDetails['user_id'] }}')" wire:loading.attr="disabled">Deactivate</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($openAddAdminForm)
        <div class="anns anns-full-h">
            <div class="close-form" wire:click="closeAddForm"></div>
            <div class="add-announcement-container">
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" row="5" wire:model.live='first_name' placeholder="Firstname" required>
                                            @error('first_name')
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Middlename</label>
                                            <input type="text" class="form-control" row="5" wire:model.live='middle_name' placeholder="Middlename">
                                            @error('middle_name')
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" row="5" wire:model.live='password' placeholder="Password" required>
                                            @error('password')
                                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
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
                                <button class="btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
