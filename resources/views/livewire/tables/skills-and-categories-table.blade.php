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
                        <h3 class="card-title">Skills and Categories Management</h3> 
                        <button type="button" class="btn btn-success btn-sm btn-add-skills" wire:click="openAddForm">Add Skills and Category
                        </button>
                        
                    </div>
                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Skills / Task</th>
                                    <th width="7%" class="action-btn">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->all_categories_name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td class="skills-list">
                                            <ul>
                                                @foreach($category->all_skills as $skill)
                                                    <li>{{ $skill->all_skills_name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="action-btn">
                                            <button class="btn btn-info btn-xs" wire:click="openEditForm({{ $category->id }})">Edit</button>
                                            <button class="btn btn-danger btn-xs" wire:click="deleteDialog({{ $category->id }})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Skills / Task</th>
                                    <th width="7%" class="action-btn">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($deleteCategoryId)
        <div class="users-data-all-container">
            <div class="close-form" wire:click="hideDeleteDialog"></div>
            <div class="user-info">
                <div class="row1 row-header">
                    <div class="col1">
                        @if($deleteMessage)
                            <label class="label" style="color: green;">{{ $deleteMessage }}</label>
                        @else
                            <label class="label">Are you sure you want to delete this category and skills?</label>
                        @endif
                    </div>
                </div>
                
                <div class="row1 row-footer">
                    <div class="col">
                        <div class="user-data">
                            @if($disableButton == "No")
                                <button class="btn-danger btn-50" wire:click="deleteAnnouncement" wire:loading.attr="disabled">Yes</button>
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

    @if($openAddSkillsAndCategories)
        <div class="anns">
            <div class="close-form" wire:click="closeAddForm"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add skills and category</h4>
                            <button type="button" class="close" wire:click="closeAddForm">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form wire:submit.prevent='createCategory'>
                            <div class="card card-primary">
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" row="5" wire:model.live='category_name' placeholder="Category name..." required>
                                                @error('category_name') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" row="5" wire:model.live='description' placeholder="Description" required></textarea>
                                                @error('description') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Add Skills / Task</label>
                                                @foreach($newSkills as $index => $skill)
                                                    <div class="add-edit-skill-input">
                                                        <input type="text" class="form-control skill-form-control" wire:model="newSkills.{{ $index }}" placeholder="Add skill" required>
                                                        <button type="button" class="close" wire:click="removeSkill({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                @endforeach
                                                <button type="button" class="btn btn-success btn-sm" wire:click="addSkill">
                                                    <i class="nav-icon fas fa-plus"></i>
                                                </button>
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

    @if($openEditSkillsAndCategories)
        <div class="anns">
            <div class="close-form" wire:click="closeEditForm"></div>
            <div class="add-announcement-container">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit skills and category</h4>
                            <button type="button" class="close" wire:click="closeEditForm"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form wire:submit.prevent='editCategory'>
                            <div class="card card-primary">
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" row="5" wire:model.live='category_name' placeholder="Category name..." value="{{ $category_name }}" required>
                                                @error('category_name') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" row="10" wire:model.live='description' required>{{ $description }}</textarea>
                                                @error('description') 
                                                    <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Edit Skills / Task</label>
                                                @foreach($newSkills as $index => $skill)
                                                    <div class="add-edit-skill-input">
                                                        <input type="text" class="form-control skill-form-control" wire:model="newSkills.{{ $index }}" value="{{ $skill }}" placeholder="Add skill" required>
                                                        <button type="button" class="close" wire:click="removeSkill({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                @endforeach
                                                <button type="button" class="btn btn-success btn-sm" wire:click="addSkill">
                                                    <i class="nav-icon fas fa-plus"></i>
                                                </button>
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
