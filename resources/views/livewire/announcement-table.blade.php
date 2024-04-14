<div>
    <section class="content announcement-content">
        <div class="container-fluid">
            <div class="announcement-header">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(session('user_role') == 'yv')
                            Volunteer Announcements
                        @elseif(session('user_role') == 'yip')
                            International Program Announcements
                        @endif
                    </h3> 
                </div>
            </div>



            {{-- Announcements are displayed here --}}
            @foreach($announcements as $announcement)
                <div class="announcement-container">
                    <div class="announcement-box">

                        <div class="author">
                            <img src="{{ $announcement->profile_picture }}">
                            <div class="author-info">
                                <h4>{{ $announcement->first_name }} {{ $announcement->last_name }}</h4>
                                <p>{{ $announcement->formatted_created_at }} <i class="nav-icon fas fa-clock"></i></p>
                            </div>
                        </div>
                        <div class="featured-image" style="background-image: url({{ $announcement->featured_image }})">
                        </div>

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
                <div class="add-announcement-container">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Announcement</h4>
                                <button type="button" class="close" wire:click="closeAddForm">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form enctype="multipart/form-data" wire:submit.prevent='createAnnouncement'>
                                <div class="card card-primary">
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" row="5" wire:model='title' placeholder="Title...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Your Announcement</label>
                                                    <textarea class="form-control" rows="5" wire:model="content" placeholder="Enter announcement..."></textarea>                                        </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category</label>
                                                    <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                                        <select  class="form-control select-status" id="category" wire:model.blur="category" name="category">
                                                            <option selected class="form-control">Choose option</option>
                                                            <option value="Training" class="form-control">Training</option>
                                                            <option value="Event" class="form-control">Event</option>    
                                                        </select>
                                                        <div class="select-dropdown"></div>
                                                        @error('category') 
                                                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="label">Add Featured Image</label>
                                                    <input type="file" id="featured_image" wire:model='featured_image'/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="label">Attach File</label>
                                                    <input type="file" id="file" wire:model='file'/>
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
                                    <button class="btn-danger btn-50" wire:click="deleteVolunteer({{ $deleteAnnouncementId }})" wire:loading.attr="disabled">Yes
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
</div>