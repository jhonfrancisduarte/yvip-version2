<section class="content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Add your skillset</h3>
                            <button type="button" class="btn btn-success btn-sm btn-add-skill" wire:click="openAddSkillForm({{ auth()->user()->id }})">Add Skill</button>
                        </div>
                
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr class="table-header">
                                        <th width="20%">My Category</th>
                                        <th width="20%">My Skills</th>
                                        <th>Experience</th>
                                        <th class="action" width="7%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="recordRow">
                                        <td class="categoryColumn">
                                            <div>
                                                <p>{{ $userCategories }}</p>
                                            </div>
                                        </td>

                                        <td class="skillsColumn">
                                            <div>
                                            @foreach($selectedSkillNames as $skillName)
                                                <li>{{ $skillName }}</li>
                                            @endforeach
                                            </div>
                                        </td>

                                        <td class="expColumn">
                                            <ul>
                                                @foreach($volunteerExperiences as $experience)
                                                    <li>{{ $experience->volunteer_experience }}
                                                    <button type="button" class="btn btn-primary btn-xs edit-exp-btn" wire:click="editExpForm({{ $experience->id }})">Edit</button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td class="actionColumn">
                                                <button type="button" class="btn btn-info btn-xs mr-2" required wire:click="openExperienceForm({{ auth()->user()->id }})">Add Experience
                                                </button>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if($addSkillForm)
            <div class="add-skill-form">
                <div class="close-form" wire:click="closeAddSkillForm"></div>
                    <div class="modal-dialog modal-sm form-width">
                    <form wire:submit.prevent="submit">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Skillset</h4>
                                <button type="button" class="close" wire:click="closeAddSkillForm"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="column-skill-form">
                                @foreach($skills as $skill)
                                    <div class="skill-checkbox">
                                        <input type="checkbox" id="{{ $skill->id }}" wire:model="selectedSkillIds" value="{{ $skill->id }}" class="every-checkbox" @if(in_array($skill->id, $selectedSkillIds)) checked @endif>
                                        <label for="{{ $skill->id }}" class="every-label">{{ $skill->all_skills_name }}</label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" wire:click="closeAddSkillForm"><i
                                        class="fa fa-times"></i> Close</button>
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-check" ></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if($addExperience)
            <div class="add-experience">
                <div class="close-form" wire:click="closeExperienceForm"></div>
                <div class="modal-dialog modal-sm">
                <form wire:submit.prevent="addExp" class="experience-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Your Experience</h4>
                            <button type="button" class="close" wire:click="closeExperienceForm"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="experience">Experience</label>
                                <textarea class="form-control" id="experience" name="experience" wire:model.defer="experience"></textarea>
                                @error('experience') <span class="text-danger small" style="color: red;">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" wire:click="closeExperienceForm">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        @endif

        @if($editId)
            <div class="edit-experience">
            <div class="close-form" wire:click="closeEditExpForm"></div>
                <div class="modal-dialog modal-sm">
                    <form wire:submit.prevent="updateExp" class="experience-form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Experience</h4>
                                <button type="button" class="close" wire:click="closeEditExpForm"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="editContent">Experience</label>
                                    <textarea class="form-control" id="editContent" name="editContent" wire:model.defer="editContent"></textarea>
                                    @error('editContent') <span class="text-danger small" style="color: red;">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" wire:click="closeEditExpForm">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </section>

