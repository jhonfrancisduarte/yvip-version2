<div>

    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center block-on-mobile">

                <div class="col-6">
                    <div class="card" style="border-radius: 20px; overflow: hidden;">
    
                        <div class="card-header">
                            <button type="button" class="btn-submit float-right" wire:click="openAddSkillForm('{{ auth()->user()->id }}')">Add Skill</button>
                        </div>
                
                        <div class="card-body scroll-table">
                            <table id="volunteers-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th class="th-border-rad">Category</th>
                                        <th class="th-action-btn">Skills</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupedSkills as $categoryName => $skills)
                                        <tr class="recordRow">
                                            <td class="categoryColumn">
                                                <div>
                                                    <p>{{ $categoryName }}</p>
                                                </div>
                                            </td>
                                            <td class="skillsColumn">
                                                <div>
                                                @foreach($skills as $skill)
                                                    <li>{{ $skill->all_skills_name }}</li>
                                                @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
    
                    </div>
                </div>

                <div class="mt-5"></div>

                <div class="col-6">
                    <div class="card" style="border-radius: 20px; overflow: hidden;">
    
                        <div class="card-header">
                            <button type="button" class="btn-submit float-right" required wire:click="openExperienceForm('{{ auth()->user()->id }}')">Add Experience</button>
                        </div>
                
                        <div class="card-body scroll-table">
                            <table id="volunteers-table" class="table-main">
                                <thead>
                                    <tr>
                                        <th class="th-border-rad-2">My Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="recordRow">
                                        <td class="expColumn">
                                            <ul class="exp-list">
                                                @foreach($volunteerExperiences as $experience)
                                                    <li>{{ $experience->volunteer_experience }}
                                                        <button class="btn btn-xs edit-exp-btn" wire:click="editExpForm({{ $experience->id }})">
                                                            <i class="nav-icon bi bi-pencil-square"></i>
                                                        </button>
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

                <div class="mt-5"></div>

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
                            <button type="button" class="close" wire:click="closeAddSkillForm" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="column-skill-form">
                                @foreach($allSkills as $skill)
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

</div>

