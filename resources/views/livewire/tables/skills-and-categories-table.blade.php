<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="table-wrapper">
        <div class="table-container">

            <div class="table-header bordered-bottom">
                <h3 class="table-title">Skills and Categories</h3> 
            </div>

            <div class="table-header justify-space-between">
                <div class="col-md-4">
                    <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search...">
                </div>
                <div class="top-buttons">
                    <button type="button" class="open-dialog-btn table-button" wire:click="openAddForm">Add Skills and Category
                    </button>
                </div> 
            </div>

            <div class="table-table" id="table-table">
                <div class="table">

                        @foreach($categories as $category)
                            <div class="s-c-row">
                                <div class="table-overlay"></div>
                                <p class="table-tr-data main-data"><i class="bi bi-tag"></i> {{ $category->all_categories_name }}</p>
                                <div class="skills-list">
                                    <p>{{ $category->description }}</p>
                                    <div>
                                        <span style="font-weight: 500">Skill/Task</span>
                                        <ul>
                                            @foreach($category->all_skills as $skill)
                                                <li>{{ $skill->all_skills_name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="s-c-buttons">
                                        <div class="btn-group-2" role="group">

                                            <div class="table-btn-g">
                                                <button class="open-dialog-btn table-action-button t-a-b-submit" wire:click="openEditForm({{ $category->id }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <p class="hover-p">Edit</p>
                                            </div>
                                            <div class="mx-2"></div>
                                            <div class="table-btn-g">
                                                <button class="open-dialog-btn table-action-button t-a-b-danger" wire:click="deleteDialog({{ $category->id }})" style="margin-left: -10px">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                <span class="hover-p">Delete</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>

            <div class="mt-5"></div>

        </div>
    </div>

    <div class="popup popup-modal" @if(!$deleteCategoryId) style="display: none;" @endif>
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
                        <p>Are you sure you want to deactivate this category?</p>
                    @endif
                </div>

                <div class="modal-footer">
                    @if($disableButton == "No")
                        <button class="btn-delete" wire:click="deleteCategory" wire:loading.attr="disabled">Yes</button>
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Cancel</button>
                    @else
                        <button class="btn-cancel" wire:click="hideDeleteDialog">Close</button>
                    @endif
                </div>

        </div>
    </div>

    <div class="popup popup-panel" @if(!$openAddSkillsAndCategories) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeAddForm"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                    <div class="popup-panel-header">
                        <h3 class="table-title">Add skills and category</h3>
                        <button type="button" class="close-dialog-btn close close-2" wire:click="closeAddForm">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form wire:submit.prevent='createCategory'>
        
                        <div class="panel-form-group">
                            <span>Category Name <span class="required-mark">*</span></span>
                            <input type="text" class="panel-input-1" row="5" wire:model.live='category_name' placeholder="Category name..." required>
                            @error('category_name')
                                <p class="text-danger small" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="panel-form-group">
                            <span>Description <span class="required-mark">*</span></span>
                            <textarea class="panel-input-1" row="5" wire:model.live='description' placeholder="Description" required></textarea>
                            @error('description')
                                <p class="text-danger small" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="panel-form-group">
                            <span>Add Skills / Tasks <span class="required-mark">*</span></span>
                            @foreach($newSkills as $index => $skill)
                                <div class="add-edit-skill-input">
                                    <input type="text" class="panel-input-1 skill-form-control" wire:model="newSkills.{{ $index }}" placeholder="Add skill/task" required>
                                    <button type="button" class="close" wire:click="removeSkill({{ $index }})"><i class="bi bi-x-lg"></i></button>
                                </div>
                            @endforeach
                            <p class="btn-submit" wire:click="addSkill">
                                <i class="bi bi-plus-lg"></i>
                            </p>
                        </div>
              
                    </form>

                    <div class="popup-panel-footer">
                        <button class="btn-success btn-overide float-right" type="submit" wire:loading.attr="disabled">Submit</button>
                    </div>

            </div>
        </div>
    </div>

    <div class="popup popup-panel" @if(!$openEditSkillsAndCategories) style="display: none;" @endif>
        <div class="close-dialog-btn popup-panel-overlay" wire:click="closeEditForm"></div>
        <div class="panel-content-wrapper">
            <div class="popup-panel-content" style="margin-left: 5px">

                    <div class="popup-panel-header">
                        <h3 class="table-title">Edit skills and category</h3>
                        <button type="button" class="close-dialog-btn close close-2" wire:click="closeEditForm">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form wire:submit.prevent='editCategory'>

                        <div class="panel-form-group">
                            <span>Category Name <span class="required-mark">*</span></span>
                            <input type="text" class="panel-input-1" row="5" wire:model.live='category_name' placeholder="Category name..." value="{{ $category_name }}" required>
                            @error('category_name')
                                <p class="text-danger small" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="panel-form-group">
                            <span>Description <span class="required-mark">*</span></span>
                            <textarea class="panel-input-1" row="10" wire:model.live='description' required>{{ $description }}</textarea>
                            @error('description')
                                <p class="text-danger small" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="panel-form-group">
                            <span>Edit Skills / Tasks <span class="required-mark">*</span></span>
                            @foreach($newSkills as $index => $skill)
                                <div class="add-edit-skill-input">
                                    <input type="text" class="panel-input-1 skill-form-control" wire:model="newSkills.{{ $index }}" value="{{ $skill }}" placeholder="Add skill/task" required>
                                    <button type="button" class="close" wire:click="removeSkill({{ $index }})"><i class="bi bi-x-lg"></i></button>
                                </div>
                            @endforeach
                            <button type="button" class="btn-submit" wire:click="addSkill">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>

                    </form>

                    <div class="popup-panel-footer">
                        <button class="btn-success btn-overide float-right" type="submit" wire:loading.attr="disabled">Submit</button>
                    </div>

            </div>
        </div>
    </div>

</div>
