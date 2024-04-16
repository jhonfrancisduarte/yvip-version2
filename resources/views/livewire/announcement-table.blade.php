<section class="content announcement-content">
        <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
            <button type="button" class="close" wire:click="closePopup">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>{{ $popup_message }}</p>
        </div>
        <div class="container-fluid">
            <div class="announcement-header">
                <div class="card-header">
                    <h3 class="card-title">Volunteer Announcements</h3> 
                </div>
                <div class="card-header header-sticky-top">
                    <button class="btn btn-success btn-sm" wire:click="openAddForm"><i class="fa fa-plus"></i></button>
                    <div class="col-md-3">
                        <input type="search" class="form-control" wire:model.live="search" placeholder="Search announcement...">
                    </div>
                </div>
            </div>

            {{-- Announcements are displayed here --}}
            @foreach($announcements as $announcement)
                <div class="announcement-container">
                    <div class="announcement-box">

                        @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa' || session('user_role') == 'ips')
                            <div class="admin-btn">
                                <button class="btn btn-info btn-xs" wire:click.live="openEditForm({{ $announcement->id }})"><i class="fa fa-pencil-alt"></i> 
                                </button>
                                <button class="btn btn-danger btn-xs" wire:click.live="deleteDialog({{ $announcement->id }})"><i class="fa fa-trash"></i> 
                                </button>
                            </div>
                        @endif

                        <div class="author">
                            <img src="{{ $announcement->profile_picture }}">
                            <div class="author-info">
                                <h4>{{ $announcement->first_name }} {{ $announcement->last_name }}</h4>
                                <p>{{ $announcement->formatted_created_at }} <i class="nav-icon fas fa-clock"></i></p>
                            </div>
                        </div>

                        @if($announcement->featured_image)
                            <div class="featured-image" style="background-image: url({{ $announcement->featured_image }})">
                            </div>
                        @endif

                        <div class="content">
                            <h3>{{ $announcement->title }}</h3>
                            <p>{{ $announcement->content }}</p>
                        </div>

                        @if($announcement->attached_file)
                            <div class="attached-file">
                                <p>Attached File: <span>{{ pathinfo(asset($announcement->attached_file), PATHINFO_FILENAME) }}.{{ pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) }}</span> <i class="nav-icon fas fa-file"></i></p>

                                <a href="{{ asset($announcement->attached_file) }}" download>
                                    <button class="btn btn-info btn-xs">Download</button>
                                </a>
                                
                                <!-- Preview button (for image files) -->
                                @if(pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'pdf' ||
                                    pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'docx' ||
                                    pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'txt' ||
                                    pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'csv')
                                    <button class="btn btn-info btn-xs btn-resized" onclick="window.open('{{ asset($announcement->attached_file) }}', '_blank')">Preview</button>
                                @endif

                            </div>
                        @endif

                        <div class="announcement-info">
                            <p>Category: {{ $announcement->category }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Add Announcement Form --}}
        @if($openAddAnnouncementForm)
            <div class="anns">
                <div class="close-form" wire:click="closeAddForm"></div>
                <div class="add-announcement-container">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Announcement</h4>
                                <button type="button" class="close" wire:click="closeAddForm">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form enctype="multipart/form-data" wire:submit='createAnnouncement'>
                                <div class="card card-primary">
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" row="5" wire:model.live='title' placeholder="Title..." required>
                                                    @error('title') 
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Your Announcement</label>
                                                    <textarea class="form-control" rows="5" wire:model.live="content" placeholder="Enter announcement..." required></textarea>
                                                    @error('content') 
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category</label>
                                                    <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                                        <select  class="form-control select-status" id="category" wire:model.blur="category" name="category" required>
                                                            <option selected class="form-control">Choose option</option>
                                                            <option value="Training" class="form-control">Training</option>
                                                            <option value="Event" class="form-control">Event</option>    
                                                        </select>
                                                        <div class="select-dropdown"></div>
                                                    </div>
                                                    @error('category') 
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="label">Add Featured Image</label>
                                                    <input type="file" id="featured_image" wire:model.live='featured_image'/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="label">Attach File</label>
                                                    <input type="file" id="file" wire:model.live='file'/>
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

        {{-- Add Announcement Form --}}
        @if($openEditAnnouncementForm)
            <div class="anns">
                <div class="close-form" wire:click="closeEditForm"></div>
                <div class="add-announcement-container">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Announcement</h4>
                                <button type="button" class="close" wire:click="closeEditForm">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form enctype="multipart/form-data" wire:submit.prevent='editAnnouncement'>
                                <div class="card card-primary">
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" row="5" wire:model.live='title' placeholder="Title..." value="{{ $title }}" required>
                                                    @error('title') 
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Your Announcement</label>
                                                    <textarea class="form-control" rows="5" wire:model.live="content" required>{{ $content }}</textarea>
                                                    @error('content') 
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category</label>
                                                    <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                                        <select  class="form-control select-status" id="category" wire:model.blur="category" name="category" required>
                                                            <option selected class="form-control">Choose option</option>
                                                            <option value="Training" class="form-control">Training</option>
                                                            <option value="Event" class="form-control">Event</option>    
                                                        </select>
                                                        <div class="select-dropdown"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="label">Add Featured Image</label>
                                                    <input type="file" id="featured_image" wire:model.live='featured_image' value="{{ $featured_image }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="label">Attach File</label>
                                                    <input type="file" id="file" wire:model.live='file' value="{{ $file }}"/>
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

        @if($deleteAnnouncementId)
            <div class="users-data-all-container">
                <div class="close-form" wire:click="hideDeleteDialog"></div>
                <div class="user-info">

                    <div class="row1 row-header">
                        <div class="col1">
                            @if($deleteMessage)
                                <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                            @else
                                <label class="label">Are you sure you want to delete this announcement?</label>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row1 row-footer">
                        <div class="col">
                            <div class="user-data">
                                @if($disableButton == "No")
                                    <button class="btn-danger btn-50" wire:click="deleteAnnouncement({{ $deleteAnnouncementId }})" wire:loading.attr="disabled">Yes
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

</section>