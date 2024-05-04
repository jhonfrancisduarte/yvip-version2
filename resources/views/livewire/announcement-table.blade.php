<section class="content announcement-content">
        <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
            <button type="button" class="close" wire:click="closePopup">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>{{ $popup_message }}</p>
        </div>
            @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa' || session('user_role') == 'ips')
                <div class="container-fluid">
                    <div class="announcement-header">
                        <div class="card-header">
                            @if($dashboardType === "yv")
                                <h3 class="card-title">Volunteer Announcements</h3>
                            @else
                                <h3 class="card-title">International Program Announcements</h3>
                            @endif 
                        </div>
                        <div class="card-header header-sticky-top">
                            <div class="col-md-3">
                                <input type="search" class="form-control" wire:model.live="search" placeholder="Search announcement...">
                            </div>
                            <button class="btn-submit" wire:click="openAddForm"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            @endif

            @foreach($announcements as $announcement)
                <div class="announcement-container">
                    <div class="announcement-box">

                        @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa' || session('user_role') == 'ips')
                            <div class="admin-btn">
                                <p class="light-blue" wire:click.live="openEditForm({{ $announcement->id }})"><i class="bi bi-pencil-square"></i>
                                </p>
                                <p class="red" wire:click.live="deleteDialog({{ $announcement->id }})"><i class="bi bi-trash3"></i> 
                                </p>
                            </div>
                        @endif

                        <div class="author">
                            <img src="{{ $announcement->profile_picture }}">
                            <div class="author-info">
                                <h4>{{ $announcement->first_name }} {{ $announcement->last_name }}</h4>
                                <p>{{ $announcement->formatted_created_at }} <i class="bi bi-clock"></i> • {{ $announcement->category }} <i class="bi bi-bookmark"></i></p>
                            </div>
                        </div>

                        <div class="content">
                            <h3>{{ $announcement->title }}</h3>
                            @if(strlen($announcement->content) > 300)
                                @if($contentIndexes[$announcement->id])
                                    <p>{{ $announcement->content }}</p>
                                    <a href="#" wire:click.prevent="toggleContent({{ $announcement->id }})">
                                        See less
                                    </a>
                                @else
                                    <p>{{ substr($announcement->content, 0, 300) }}...</p>
                                    <a href="#" wire:click.prevent="toggleContent({{ $announcement->id }})">
                                        See more
                                    </a>
                                @endif
                            @else
                                <p>{{ $announcement->content }}</p>
                            @endif
                        </div>

                        @if($announcement->attached_file)
                            <div class="attached-file">
                                <p>Attached File: <span>{{ pathinfo(asset($announcement->attached_file), PATHINFO_FILENAME) }}.{{ pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) }}</span> <i class="nav-icon fas fa-file"></i></p>
                                
                                <div class="anns-buttons">
                                    <a href="{{ asset($announcement->attached_file) }}" download>
                                        <i class="bi bi-file-earmark-arrow-down"></i> Download
                                    </a>
                                    
                                    <!-- Preview button (for image files) -->
                                    @if(pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'pdf' ||
                                        pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'docx' ||
                                        pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'txt' ||
                                        pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'csv')
                                        <a href="#" onclick="window.open('{{ asset($announcement->attached_file) }}', '_blank')"><i class="bi bi-eye"></i> Preview</a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($announcement->featured_image)
                            <div class="featured-image" style="background-image: url({{ $announcement->featured_image }})">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>

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
                                                    <textarea id="announcement" class="form-control" rows="5" wire:model.live="content" placeholder="Enter announcement..." required></textarea>
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
                                                    <div wire:loading wire:target="featured_image" class="loading-container">
                                                        <div class="loading-spinner"></div>
                                                    </div>
                                                    <label class="label">Add Featured Image</label>
                                                    <input type="file" accept="image/*" wire:model.live='featured_image'/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div wire:loading wire:target="file" class="loading-container">
                                                        <div class="loading-spinner"></div>
                                                    </div>
                                                    <label class="label">Attach File</label>
                                                    <input type="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button class="btn-success" type="submit" wire:loading.attr="disabled">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                                                    <div wire:loading wire:target="featured_image" class="loading-container">
                                                        <div class="loading-spinner"></div>
                                                    </div>
                                                    <label class="label">Add Featured Image</label>
                                                    <input type="file" accept="image/*" id="featured_image" wire:model.live='featured_image'/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">     
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div wire:loading wire:target="file" class="loading-container">
                                                        <div class="loading-spinner"></div>
                                                    </div>
                                                    <label class="label">Attach File</label>
                                                    <input type="file" id="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button class="btn-success" type="submit" wire:loading.attr="disabled">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($deleteAnnouncementId)
            <div class="users-data-all-container no-padding">
                <div class="close-form" wire:click="hideDeleteDialog"></div>
                <div class="user-info user-infos">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close" aria-label="Close" wire:click="hideDeleteDialog">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if($deleteMessage)
                            <p style="color: green;">{{ $deleteMessage }}</p>
                        @else
                            <p>Are you sure you want to delete this announcement?</p>
                        @endif
                    </div>
                    
                    <div class="modal-footer">
                        @if($disableButton == "No")
                            <button class="btn-delete" wire:click="deleteAnnouncement({{ $deleteAnnouncementId }})" wire:loading.attr="disabled">Yes
                            </button>
                            <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                        @else
                            <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                        @endif
                    </div>
                </div>
            </div>    
        @endif

</section>