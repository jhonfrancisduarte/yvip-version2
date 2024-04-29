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
                            <a href="#" wire:click="openActionForm"><i class="fas fa-ellipsis-h nav-for-action" width="10%"></i></a>
                            @if($actionForm)
                                <div class="actions-container">
                                    <button type="button" class="btn-submit btn-add-skill" wire:click="openAddSkillForm('{{ auth()->user()->id }}')">Add Skill</button>
                                    <button type="button" class="btn-submit btn-add-experience" required wire:click="openExperienceForm('{{ auth()->user()->id }}')">Add Experience</button>
                                </div>
                            @endif
                        </div>
                
                        <div class="card-body">

                            <table class="table-main table-full-width">
                                <thead>
                                    <tr class="table-header">
                                        <th width="30%">My Category</th>
                                        <th width="30%">My Skills</th>
                                        <th width="30%">Experience</th>
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
                                                        <button class="btn btn-xs edit-exp-btn" wire:click="editExpForm({{ $experience->id }})"> <i class="nav-icon bi bi-pencil-square"></i> </i></button>
                                                    </li>
                                                @endforeach
                                            </ul>
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
                                <button type="submit" class="btn-submit">Submit</button>
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
                            <h4 class="modal-title">Add Experience</h4>
                            <button type="button" class="close" wire:click="closeExperienceForm"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="experience">Your experience</label>
                                <textarea class="form-control" id="experience" name="experience" wire:model.defer="experience"></textarea>
                                @error('experience') <span class="text-danger small" style="color: red;">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn-submit">Submit</button>
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
                                <button type="submit" class="btn-submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </section>

