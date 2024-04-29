<section class="content volunteers-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="container-fluid">
        <div class="row volunteer-row">
            <div class="col-md-12 table-contain">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Skills and Categories Management</h3> 
                        <button type="button" class="btn-submit float-right" wire:click="openAddForm">Add Skills and Category
                        </button>
                        
                    </div>
                    <div class="card-header card-header1">
                        <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                        <div class="col-md-3">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table">
                        <table id="volunteers-table" class="table-main">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Skills / Task</th>
                                    <th width="7%" class="action-btn th-action-btn"></th>
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
                                        <td class="action-btn width">
                                            <div class="btn-group-2" role="group">
                                                <div class="btn-g">
                                                    <button class="btn-submit" wire:click="openEditForm({{ $category->id }})">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <span class="span span-delete">Edit</span>
                                                </div>
                                                <div class="mx-2"></div>
                                                <div class="btn-g">
                                                    <button class="btn-delete" wire:click="deleteDialog({{ $category->id }})">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                    <span class="span span-delete">Delete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($deleteCategoryId)
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
    @endif

    @if($openAddSkillsAndCategories)
        <div class="anns">
            <div class="close-form" wire:click="closeAddForm"></div>
            <div class="add-announcement-container">
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
                                                    <input type="text" class="form-control skill-form-control" wire:model="newSkills.{{ $index }}" placeholder="Add skill/task" required>
                                                    <button type="button" class="close" wire:click="removeSkill({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                            @endforeach
                                            <button type="button" class="btn-submit" wire:click="addSkill">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
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
                                                        <input type="text" class="form-control skill-form-control" wire:model="newSkills.{{ $index }}" value="{{ $skill }}" placeholder="Add skill/task" required>
                                                        <button type="button" class="close" wire:click="removeSkill({{ $index }})"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                @endforeach
                                                <button type="button" class="btn-submit" wire:click="addSkill">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
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
        </div>
    @endif

</section>
