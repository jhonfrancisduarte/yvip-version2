<<<<<<< HEAD
<div class="content announcement-content">
    <div class="container-fluid">
        <div class="announcement-header">
            <div class="card-header">
                <h3 class="card-title">Volunteer Events and Trainings List</h3>
            </div>
            <div class="card-header header-sticky-top">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addEventModal"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        {{-- Volunteer Events and Trainings are displayed here --}}
        <!-- Include your code for displaying volunteer events and trainings here -->

    </div>

    <!-- Add Volunteer Event or Training Form Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Volunteer Event or Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding volunteer event or training -->
                    <form>
                        <div class="form-group">
                            <label for="eventType">Type of Event</label>
                            <select class="form-control" id="eventType">
                                <option value="event">Volunteer Event</option>
                                <option value="training">Training</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label id="eventNameLabel" for="eventName">Name of Event</label>
                            <input type="text" class="form-control" id="eventName" placeholder="Enter event name">
                        </div>
                        <div class="form-group">
                            <label for="organizer">Organizer/Facilitator</label>
                            <input type="text" class="form-control" id="organizer" placeholder="Enter organizer/facilitator name">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date">
                        </div>
                        <div class="form-group">
                            <label for="volunteeringHours">Number of applicable volunteering hours</label>
                            <input type="number" class="form-control" id="volunteeringHours" placeholder="Enter number of hours">
                        </div>
                        <div class="form-group">
                            <label for="volunteerCategory">Volunteer category who can join</label>
                            <div id="tagContainer">
                                <!-- Include your tag buttons here -->
                                <button type="button" class="btn btn-outline-primary" onclick="addTag('Support')">Support</button>
                                <button type="button" class="btn btn-outline-primary" onclick="addTag('Logistics')">Logistics</button>
                                <button type="button" class="btn btn-outline-primary" onclick="addTag('Management')">Management</button>
                                <button type="button" class="btn btn-outline-primary" onclick="addTag('Highly Technical')">Highly Technical</button>
                            </div>
                            <button type="button" class="btn btn-outline-primary" id="addTagButton" onclick="toggleTagContainer()">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Add Volunteer Event or Training Form Modal -->

    <!-- Delete Volunteer Event or Training Dialog -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventModalLabel">Delete Volunteer Event or Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for deleting volunteer event or training -->
                    <p>Are you sure you want to delete this event or training?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Delete Volunteer Event or Training Dialog -->

</div>

<script>
    function toggleTagContainer() {
        var tagContainer = document.getElementById('tagContainer');
        var addTagButton = document.getElementById('addTagButton');
        if (tagContainer.style.display === 'none') {
            tagContainer.style.display = 'block';
            addTagButton.style.display = 'none'; // Hide the plus button when the tag container is shown
        } else {
            tagContainer.style.display = 'none';
            addTagButton.style.display = 'block'; // Show the plus button when the tag container is hidden
        }
    }

    function addTag(tagName) {
        var volunteerCategoryInput = document.getElementById('volunteerCategory');
        if (volunteerCategoryInput.value.trim() === '') {
            volunteerCategoryInput.value = tagName;
        } else {
            volunteerCategoryInput.value += ', ' + tagName;
        }

        // Check the number of tags added and hide the plus button if the limit is reached
        var tags = volunteerCategoryInput.value.split(', ');
        if (tags.length >= 4) {
            document.getElementById('addTagButton').style.display = 'none';
        }
    }
=======
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
>>>>>>> master
</script>
