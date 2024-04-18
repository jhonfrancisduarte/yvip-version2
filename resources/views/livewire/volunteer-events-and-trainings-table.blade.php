<div>
    <div class="card-header">
        <h3 class="card-title">Volunteers Events and Trainings Announcement</h3> 
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" style="margin-left:20px; font-family:'Arial', sans !important;">
            <i class="fa fa-plus"></i> Add
        </button>

        <div class="modal fade" id="add">
            <div class="modal-dialog modal-md">
                <form action="" method="post" id="add-volunteer-form">
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
                                            <select class="form-control" id="event-type">
                                                <option value="Event">Event</option>
                                                <option value="Training">Training</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name of Event</label>
                                            <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Enter Event Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Organizer/Facilitator</label>
                                            <input type="text" class="form-control" name="organizer" placeholder="Enter Organizer/Facilitator">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Number of applicable volunteering hours</label>
                                            <input type="number" class="form-control" name="volunteering_hours" placeholder="Enter Number of Hours">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <!-- Other input fields here -->
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
                                        <!-- Selected tags will be displayed here -->
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
        // Function to update placeholder based on event type
        function updatePlaceholder(eventType) {
            var eventNameInput = document.getElementById('event-name');
            if (eventType === 'Event') {
                eventNameInput.placeholder = 'Enter Event Name';
            } else if (eventType === 'Training') {
                eventNameInput.placeholder = 'Enter Training Name';
            }
        }

        // Toggle tags container visibility and change button text
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

        // Listen for change event on event type dropdown
        $('#event-type').on('change', function() {
            var eventType = $(this).val();
            updatePlaceholder(eventType);
        });

        // Listen for click events on tags
        $('#tags-container').on('click', '.tag', function() {
            $(this).toggleClass('selected');
            var tag = $(this).data('value');
            var addedTags = $('#added-tags');
            if ($(this).hasClass('selected')) {
                // If tag is selected, add it to the added tags section
                addedTags.append('<button type="button" class="added-tag btn btn-primary mr-2">' + tag + ' <i class="fa fa-times"></i></button>');
                addedTags.slideDown(); // Show added tags section
                $('#added-tags-label').slideDown(); // Show the label
            } else {
                // If tag is deselected, remove it from the added tags section
                addedTags.find('button:contains("' + tag + '")').remove();
                // Check if there are any remaining selected tags
                if ($('#added-tags button').length === 0) {
                    $('#added-tags-label').slideUp(); // Hide the label
                }
            }
        });

        // Listen for click events on added tags for deselection
        $('#added-tags').on('click', '.added-tag', function() {
            var tag = $(this).text().trim(); // Get the text of the clicked tag
            $(this).remove(); // Remove the clicked tag from the added tags section
            $('#tags-container').find('.tag[data-value="' + tag + '"]').removeClass('selected'); // Deselect the corresponding tag in the tags container
            // Check if there are any remaining selected tags
            if ($('#added-tags button').length === 0) {
                $('#added-tags-label').slideUp(); // Hide the label
            }
        });

        // Initialize placeholder based on default event type
        updatePlaceholder($('#event-type').val());
    });
</script>
