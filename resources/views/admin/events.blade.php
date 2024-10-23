@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Event Schedule
                    </div>
                    <!-- Add Blotter Button -->
                    <button class="btn btn-primary" id="addEventBtn" data-bs-toggle="modal" data-bs-target="#EventModal">Add Event</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Event No.</th>
                                <th>Type of Event</th>
                                <th>Venue</th>
                                <th>Task Assigned</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->event_type }}</td>
                                    <td>{{ $row->event_venue }}</td>
                                    <td>{{ $row->task_assigned }}</td>
                                    <td>{{ $row->created_at->format('F j, Y') }}</td> <!-- For the full month name and year -->
                                    <td>{{ $row->created_at->format('h:i A') }}</td> <!-- For time with AM/PM -->
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deleteBlooter({{ $row->id }})">Delete</button>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="EventModal" tabindex="-1" aria-labelledby="EventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EventModalLabel">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Event Type</label>
                        <input type="text" class="form-control" id="eventType" name="event_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventVenue" class="form-label">Event Venue</label>
                        <input type="text" class="form-control" id="eventVenue" name="event_venue" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskAssigned" class="form-label">Task Assigned</label>
                        <input type="text" class="form-control" id="taskAssigned" name="task_assigned" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEventBtn">Save Event</button>
            </div>
        </div>
    </div>
</div>


@include('templates.footer')
</div>

<script>
document.getElementById('saveEventBtn').addEventListener('click', function() {
    const data = {
        event_type: document.getElementById('eventType').value, // Match event_type
        event_venue: document.getElementById('eventVenue').value, // Match event_venue
        task_assigned: document.getElementById('taskAssigned').value // Match task_assigned
    };

    fetch('/insertevent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            $('#EventModal').modal('hide');
            alert('Event saved successfully!'); // Alert success message
            location.reload(); // Reload the page after saving
        } else {
            return response.json().then(data => {
                alert(data.message || 'Error saving event!'); // Alert error message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred!'); // Alert error message for unexpected errors
    });
});

// Function to delete a blotter
function deleteBlooter(id) {
    if (confirm('Are you sure you want to delete this blotter?')) {
        fetch(`/eventdelete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Event deleted successfully!'); // Alert success message
                    location.reload(); // Reload the page after deletion
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting blotter!'); // Alert error message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!'); // Alert error message for unexpected errors
        });
    }
}
</script>

