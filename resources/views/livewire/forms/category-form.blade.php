<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add your skillset</h3>
                            <button type="button" class="btn btn-success btn-sm btn-add-skill" data-toggle="modal" data-target="#add">Add Skill</button>
                            <div class="modal fade" id="add">
                                <div class="modal-dialog modal-sm form-width">
                                    <form wire:submit.prevent="submit">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Skillset</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="column-skill-form">
                                                    @foreach($skills as $skill)
                                                        <div class="skill-checkbox">
                                                            <input type="checkbox" id="{{ $skill->id }}" wire:model="selectedSkills" value="{{ $skill->id }}" class="every-checkbox">
                                                            <label for="{{ $skill->id }}" class="every-label">{{ $skill->all_skills_name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                        class="fa fa-times"></i> Close</button>
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-check" ></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="table-header">
                                        <th>My Category</th>
                                        <th>My Skills</th>
                                        <th width="20%">Experience</th>
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
                                                    <p>{{ $skillName }}</p>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="expColumn">
                                            <ul>
                                                @foreach($volunteerExperiences as $experience)
                                                    <li>{{ $experience->volunteer_experience }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="actionColumn">
                                                <button type="button" class="btn btn-info btn-xs mr-2" data-toggle="modal"
                                                    data-target="#update">Edit Experience
                                                </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal fade" id="update">
                                <div class="modal-dialog modal-sm">
                                    <form wire:submit.prevent="updateCategoryDescription">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Your Experience</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Volunteer experience input -->
                                                <div class="form-group">
                                                    <label for="experience">Experience</label>
                                                    <textarea class="form-control" id="experience" name="experience" wire:model.defer="experience"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
