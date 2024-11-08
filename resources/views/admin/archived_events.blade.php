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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        
                        <div>
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('events') }}'">View Events</button>
                            {{-- <button class="btn btn-primary" id="addEventBtn" data-bs-toggle="modal" data-bs-target="#EventModal">Add Event</button> --}}
                        </div>
                    </div>             
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Event No.</th>
                                <th>Event Name</th>
                                <th>Venue</th>
                                <th>Task Assigned</th>
                                <th>Date</th>
                                <th>Time</th>
                                {{-- <th>Status</th> --}}
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
                                    <td>{{ date('F j, Y', strtotime($row->event_date)) }}</td>
                                    <td>{{ date('h:i A', strtotime($row->event_time)) }}</td>
                                    {{-- <td>{{ $row->status }}</td> --}}
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="restoreEvent({{ $row->id }})"><i class="fas fa-undo me-1"></i>Restore</button>
                                        <button class="btn btn-danger btn-sm" onclick="permanentDelete({{ $row->id }})"><i class="fas fa-trash me-1"></i>Delete Permanently</button>
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
                            <label for="eventType" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="eventType" name="event_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventVenue" class="form-label">Event Venue</label>
                            <input type="text" class="form-control" id="eventVenue" name="event_venue" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskAssigned" class="form-label">Task Assigned</label>
                            <select name="task_assigned" type="text" class="form-control" id="taskAssigned" required>
                                <option value="">Select Kagawad</option>
                                <option value="Kagawad 1">Kagawad 1</option>
                                <option value="Kagawad 2">Kagawad 2</option>
                                <option value="Kagawad 3">Kagawad 3</option>
                                <option value="Kagawad 4">Kagawad 4</option>
                                <option value="Kagawad 5">Kagawad 5</option>
                                <option value="Kagawad 6">Kagawad 6</option>
                                <option value="Kagawad 7">Kagawad 7</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="eventDate" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="eventDate" name="event_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventTime" class="form-label">Event Time</label>
                            <input type="time" class="form-control" id="eventTime" name="event_time" required>
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
function restoreEvent(id) {
    if (confirm('Are you sure you want to restore this event?')) {
        fetch(`/event/restore/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Event restored successfully!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error restoring event!');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!');
        });
    }
}

function permanentDelete(id) {
    if (confirm('Are you sure you want to permanently delete this event? This action cannot be undone!')) {
        fetch(`/event/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Event permanently deleted!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting event!');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!');
        });
    }
}
</script>