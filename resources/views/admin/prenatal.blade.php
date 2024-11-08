@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Prenatal Schedule
                    </div>
                    <button class="btn btn-primary" id="addPrenatalBtn" data-bs-toggle="modal" data-bs-target="#PrenatalModal">Add Event</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Activity</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prenatals as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->activity }}</td>
                                    <td>{{ $row->venue }}</td>
                                    <td>{{ date('F j, Y', strtotime($row->schedule_date)) }}</td>
                                    <td>{{ date('h:i A', strtotime($row->schedule_time)) }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deletePrenatal({{ $row->id }})">Delete</button>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="PrenatalModal" tabindex="-1" aria-labelledby="PrenatalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="PrenatalModalLabel">Add Prenatal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="PrenatalForm">
                            <div class="mb-3">
                                <label for="activity" class="form-label">Activity</label>
                                <input type="text" class="form-control" id="activity" name="activity" placeholder="Enter activity" required>
                            </div>
                            <div class="mb-3">
                                <label for="venue" class="form-label">Venue</label>
                                <input type="text" class="form-control" id="venue" name="venue" placeholder="Enter venue" required>
                            </div>
                            <div class="mb-3">
                                <label for="scheduleDate" class="form-label">Schedule Date</label>
                                <input type="date" class="form-control" id="scheduleDate" name="schedule_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="scheduleTime" class="form-label">Schedule Time</label>
                                <input type="time" class="form-control" id="scheduleTime" name="schedule_time" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="savePrenatalBtn">Save Prenatal</button>
                    </div>
                </div>
            </div>
        </div>

@include('templates.footer')
</div>

<script>
document.getElementById('savePrenatalBtn').addEventListener('click', function() {
    const data = {
        activity: document.getElementById('activity').value,
        venue: document.getElementById('venue').value,
        schedule_date: document.getElementById('scheduleDate').value,
        schedule_time: document.getElementById('scheduleTime').value
    };

    fetch('/insertprenatal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            $('#PrenatalModal').modal('hide');
            alert('Prenatal saved successfully!');
            location.reload();
        } else {
            return response.json().then(data => {
                alert(data.message || 'Error saving Prenatal!');
            }).catch(() => {
                alert('An error occurred while saving!');
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred!');
    });
});

function deletePrenatal(id) {
    if (confirm('Are you sure you want to delete this prenatal?')) {
        fetch(`/prenataldelete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Prenatal deleted successfully!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting prenatal!');
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
