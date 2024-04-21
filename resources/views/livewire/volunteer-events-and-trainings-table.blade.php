<div>
    <div class="card-header">
        <h3 class="card-title">Volunteers Events and Trainings Announcement</h3> 
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" style="margin-left:20px; font-family:'Arial', sans !important;">
            <i class="fa fa-plus"></i> Add
        </button>

        <div class="modal fade" id="add">
            <div class="modal-dialog modal-md">
                <form wire:submit.prevent="create" id="add-volunteer-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Events and Trainings</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Event Type</label>
                                            <select class="form-control" id="event-type" wire:model.defer="eventType">
                                                <option value="Event">Event</option>
                                                <option value="Training">Training</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name of Event</label>
                                            <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Enter Event Name" wire:model.defer="eventName">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Organizer/Facilitator</label>
                                            <input type="text" class="form-control" name="organizer" placeholder="Enter Organizer/Facilitator" wire:model.defer="organizer">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" name="start_date" id="start-date" wire:model.defer="startDate">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" name="end_date" id="end-date" wire:model.defer="endDate" min="{{ $startDate ? $startDate : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Number of applicable volunteering hours</label>
                                            <input type="number" class="form-control" name="volunteering_hours" placeholder="Enter Number of Hours" wire:model.defer="volunteerHours">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Volunteer category who can join</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" id="toggle-tags-button"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-12" style="display: none;" id="tags-container">
                                        <div class="form-group">
                                            <div class="tag-box">
                                                <button type="button" class="tag btn btn-light" data-value="Support">Support</button>
                                                <button type="button" class="tag btn btn-light" data-value="Logistics">Logistics</button>
                                                <button type="button" class="tag btn btn-light" data-value="Management">Management</button>
                                                <button type="button" class="tag btn btn-light" data-value="Highly Technical">Highly Technical</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="added-tags" style="display:none;">
                                        <label>Added Tags: </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updatePlaceholder(eventType) {
            var eventNameInput = document.getElementById('event-name');
            if (eventType === 'Event') {
                eventNameInput.placeholder = 'Enter Event Name';
            } else if (eventType === 'Training') {
                eventNameInput.placeholder = 'Enter Training Name';
            }
        }

        $('#toggle-tags-button').on('click', function() {
            var button = $(this);
            var tagsContainer = $('#tags-container');
            if (tagsContainer.is(':visible')) {
                tagsContainer.slideUp();
                button.text('+').find('i').removeClass('fa-minus').addClass('fa-plus');
            } else {
                tagsContainer.slideDown();
                button.text('-').find('i').removeClass('fa-plus').addClass('fa-minus');
            }
        });

        $('#event-type').on('change', function() {
            var eventType = $(this).val();
            updatePlaceholder(eventType);
        });

        $('#tags-container').on('click', '.tag', function() {
            $(this).toggleClass('selected');
            var tag = $(this).data('value');
            var addedTags = $('#added-tags');
            if ($(this).hasClass('selected')) {
                addedTags.append('<button type="button" class="added-tag btn btn-primary mr-2">' + tag + ' <i class="fa fa-times"></i></button>');
                addedTags.slideDown(); 
                $('#added-tags-label').slideDown(); 
            } else {                
                addedTags.find('button:contains("' + tag + '")').remove();
                if ($('#added-tags button').length === 0) {
                    $('#added-tags-label').slideUp(); 
                }
            }
        });

        $('#added-tags').on('click', '.added-tag', function() {
            var tag = $(this).text().trim(); 
            $(this).remove(); 
            $('#tags-container').find('.tag[data-value="' + tag + '"]').removeClass('selected'); 
            if ($('#added-tags button').length === 0) {
                $('#added-tags-label').slideUp(); 
            }
        });

        $('#start-date').on('change', function() {
            var startDate = $(this).val();
            $('#end-date').attr('min', startDate);
        });

        updatePlaceholder($('#event-type').val());
    });

    document.addEventListener('livewire:load', function () {
        Livewire.on('modalClosed', function () {
            $('#add').modal('hide');
        });
    });

</script>
