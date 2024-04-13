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
</script>
