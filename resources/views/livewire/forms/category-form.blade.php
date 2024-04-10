<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add your skillset</h3>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"
                                style="margin-left:83.5%">Add
                            </button>
                            <div class="modal fade" id="add">
                                <div class="modal-dialog modal-sm" style="max-width: 40%;">
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
                                                <div style="display: flex; justify-content: center;">
                                                    <div style="flex: 1;">
                                                        <div
                                                            style="max-width: 100%; justify-content: center;">
                                                            <!-- <form wire:submit.prevent="submit"> -->
                                                            <div style="column-count: 2;">
                                                                @foreach ($categories as $category => $categorySkills)
                                                                    @foreach ($categorySkills as $skill)
                                                                        <!-- <div style="border: 1px solid #ccc; margin-bottom: 5px; display: flex; width: 100%; border-radius: 3px;"> -->
                                                                            <div style="border: 1px solid #ccc; display: flex; align-items: center; border-radius: 3px; ">
                                                                                <label for="{{ $skill }}" style="margin-left: 0; margin-top: 5px; max-width: 100%; width: 100%">{{ $skill }}</label>
                                                                                <input type="checkbox" id="{{ $skill }}" value="{{ $skill }}" wire:model="selectedSkills">
                                                                            </div>
                                                                        <!-- </div> -->
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <!-- <button type="submit" style="background-color: #085c9c; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;">Submit</button> -->
                                                            <!-- </form> -->
                                                        </div>
                                                    </div>
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
                            <style>
                                .table th, .table td {
                                    padding: 10px;
                                }
                            </style>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 50%">My Category</th>
                                        <th style="width: 50%">Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoriesData as $category)
                                    <tr>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-info btn-xs mr-2" data-toggle="modal"
                                                    data-target="#update"><i class="fa fa-pencil-alt"></i>
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
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
                                            <div class="card card-primary">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Experience</label>
                                                        <input type="text" class="form-control" id="description" name="description" wire:model="description">

                                                    </div>
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
