<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa' || session('user_role') == 'ips')
        <div class="search-bar-wrapper">
            <div class="search-bar-container">
                <input type="search" class="table-search-bar" wire:model.live="search" placeholder="Search announcement...">
                <button class="theme-btn open-dialog-btn" wire:click="openAddForm"><i class="bi bi-plus-lg"></i></button>
            </div>
        </div>
    @endif

    @foreach($announcements as $announcement)
        <div class="announcement-container">
            <div class="announcement-box">

                @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa' || session('user_role') == 'ips')
                    <div class="admin-btn">
                        <p class="open-dialog-btn table-action-button t-a-b-submit" wire:click.live="openEditForm({{ $announcement->id }})"><i class="bi bi-pencil-square"></i>
                        </p>
                        <p class="open-dialog-btn table-action-button t-a-b-danger" wire:click.live="deleteDialog({{ $announcement->id }})"><i class="bi bi-trash3"></i> 
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

    <div class="mt-5"></div>
    
    <div class="popup popup-panel" @if(!$openAddAnnouncementForm) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeAddForm"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h3 class="table-title">Add Announcement</h3>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeAddForm">
                        <span>&times;</span>
                    </button>
                </div>

                <form enctype="multipart/form-data" wire:submit='createAnnouncement'>          

                    <div class="panel-form-group">
                        <span>Title <span class="required-mark">*</span></span>
                        <input type="text" class="panel-input-1" row="5" wire:model.live='title' placeholder="Title..." required>
                        @error('title') 
                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="panel-form-group">
                        <span>Your Announcement <span class="required-mark">*</span></span>
                        <textarea id="announcement" class="panel-input-1 textarea" rows="5" wire:model.live="content" placeholder="Enter announcement..." required></textarea>
                        @error('content') 
                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="panel-form-group block-on-mobile">
                        <div class="panel-form-group-3">
                            <span>Category <span class="required-mark">*</span></span>
                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                <select  class="panel-input-1" id="category" wire:model.blur="category" name="category" required>
                                    <option selected>Choose option</option>
                                    <option value="Training">Training</option>
                                    <option value="Event">Event</option>    
                                </select>
                                <i class="bi bi-caret-down select-icon"></i>
                            </div>
                            @error('category') 
                                <span class="text-danger small" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-3">
                            <div wire:loading wire:target="featured_image" class="loading-container">
                                <div class="loading-spinner"></div>
                            </div>
                            <span>Add Featured Image</span>
                            <input id="featured-img" type="file" accept="image/*" wire:model.live='featured_image' style="display: none"/>
                            <button type="button" class="file-btn" onclick="document.getElementById('featured-img').click()"> 
                                @if($featured_image)
                                    {{ $featured_image->getClientOriginalName() }}
                                @else
                                    <i class="bi bi-upload"style="margin-left: -2px"></i>
                                @endif
                            </button>
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-3">
                            <div wire:loading wire:target="file" class="loading-container">
                                <div class="loading-spinner"></div>
                            </div>
                            <span>Attach File</span>
                            <input id="file-attachment" type="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="display: none"/>
                            <button type="button" class="file-btn" onclick="document.getElementById('file-attachment').click()">
                                @if($file)
                                    {{ $file->getClientOriginalName() }}
                                @else
                                    <i class="bi bi-upload"style="margin-left: -2px"></i>
                                @endif
                            </button>
                        </div>
                    </div>

                    <div class="popup-panel-footer">
                        <button class="close-dialog-btn btn-success btn-overide float-right" type="submit" wire:loading.attr="disabled">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="popup popup-panel" @if(!$openEditAnnouncementForm) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeEditForm"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                <div class="popup-panel-header">
                    <h4 class="table-title">Edit Announcement</h4>
                    <button type="button" class="close-dialog-btn close close-2" wire:click="closeEditForm">
                        <span>&times;</span>
                    </button>
                </div>

                <form enctype="multipart/form-data" wire:submit.prevent='editAnnouncement'>

                    <div class="panel-form-group">
                        <span>Title <span class="required-mark">*</span></span>
                        <input type="text" class="panel-input-1" row="5" wire:model.live='title' placeholder="Title..." value="{{ $title }}" required>
                        @error('title') 
                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="panel-form-group">
                        <span>Your Announcement <span class="required-mark">*</span></span>
                        <textarea class="panel-input-1 textarea" rows="5" wire:model.live="content" required>{{ $content }}</textarea>
                        @error('content') 
                            <span class="text-danger small" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="panel-form-group block-on-mobile">
                        <div class="panel-form-group-3">
                            <span>Category <span class="required-mark">*</span></span>
                            <div class="rs-select2 js-select-simples select--no-search" wire:ignore>
                                <select  class="panel-input-1" id="category" wire:model.blur="category" name="category" required>
                                    <option selected>Choose option</option>
                                    <option value="Training">Training</option>
                                    <option value="Event">Event</option>    
                                </select>
                                <i class="bi bi-caret-down select-icon"></i>
                            </div>
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-3">
                            <div wire:loading wire:target="featured_image" class="loading-container">
                                <div class="loading-spinner"></div>
                            </div>
                            <span>Add Featured Image</span>
                            <input id="featured-img-2" type="file" accept="image/*" id="featured_image" wire:model.live='featured_image' style="display: none"/>
                            <button type="button" class="file-btn" onclick="document.getElementById('featured-img-2').click()"> 
                                @if($featured_image)
                                    {{ $featured_image->getClientOriginalName() }}
                                @else
                                    <i class="bi bi-upload"style="margin-left: -2px"></i>
                                @endif
                            </button>
                        </div>
                        <div class="v-spacer"></div>
                        <div class="panel-form-group-3">
                            <div wire:loading wire:target="file" class="loading-container">
                                <div class="loading-spinner"></div>
                            </div>
                            <span>Attach File</span>
                            <input type="file" id="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="display: none"/>
                            <button type="button" class="file-btn" onclick="document.getElementById('file').click()">
                                @if($file)
                                    {{ $file->getClientOriginalName() }}
                                @else
                                    <i class="bi bi-upload"style="margin-left: -2px"></i>
                                @endif
                            </button>
                        </div>
                    </div>

                    <div class="popup-panel-footer">
                        <button class="close-dialog-btn btn-success btn-overide float-right" type="submit" wire:loading.attr="disabled">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="popup popup-modal" @if(!$deleteAnnouncementId) style="display: none;" @endif>
        <div class="close-dialog-btn modal-overlay" wire:click="hideDeleteDialog"></div>
        <div class="popup-modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close-dialog-btn close" wire:click="hideDeleteDialog">
                    <span>&times;</span>
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
                    <button class="close-dialog-btn btn-delete" wire:click="deleteAnnouncement({{ $deleteAnnouncementId }})" wire:loading.attr="disabled">Yes
                    </button>
                    <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                @else
                    <button class="close-dialog-btn btn-cancel" wire:click="hideDeleteDialog">Close</button>
                @endif
            </div>

        </div>
    </div>
            
</div>