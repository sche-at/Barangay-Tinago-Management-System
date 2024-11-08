@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Immunization Schedule
                    </div>
                    <div>
                        <a href="{{ route('archived_immunizations') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-archive me-1"></i>View Archived
                        </a>
                        <button class="btn btn-primary" id="addimmunizeBtn" data-bs-toggle="modal" data-bs-target="#ImmunizeModal">
                            <i class="fas fa-plus me-1"></i>Add Event
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Vaccine</th>
                                <th>Recommended Age</th>
                                <th>Dosage</th>
                                <th>Venue</th>
                                <th>Notes</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($immunizes as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->vaccine }}</td>
                                    <td>{{ $row->age }}</td>
                                    <td>{{ $row->dosage }}</td>
                                    <td>{{ $row->venue }}</td>
                                    <td>{{ $row->notes }}</td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($row->schedule_at)->format('F j, Y') }}</td> <!-- Display Date -->
                                    <td>{{ \Carbon\Carbon::parse($row->schedule_at)->format('h:i A') }}</td> <!-- Display Time --> --}}
                                    <td>{{ $row->date }}</td> <!-- Display Date -->
                                    <td>{{ $row->time }}</td> <!-- Display Time -->
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deleteImmunize({{ $row->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="ImmunizeModal" tabindex="-1" aria-labelledby="ImmunizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ImmunizeModalLabel">Add Immunization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="immunizationForm">
                        <div class="mb-3">
                            <label for="vaccine" class="form-label">Vaccine</label>
                            <input type="text" class="form-control" id="vaccine" name="vaccine" placeholder="Enter vaccine name" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="dosage" class="form-label">Dosage</label>
                            <input type="text" class="form-control" id="dosage" name="dosage" placeholder="Enter dosage" required>
                        </div>
                        <div class="mb-3">
                            <label for="venue" class="form-label">Venue</label>
                            <input type="text" class="form-control" id="venue" name="venue" placeholder="Enter venue" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Additional notes (optional)"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveImmunizeBtn">Save Immunization</button>
                </div>
            </div>
        </div>
    </div>

@include('templates.footer')
</div>

<script>
document.getElementById('saveImmunizeBtn').addEventListener('click', function() {
    const data = {
        vaccine: document.getElementById('vaccine').value,
        age: document.getElementById('age').value,
        dosage: document.getElementById('dosage').value,
        venue: document.getElementById('venue').value,
        notes: document.getElementById('notes').value,
        date: document.getElementById('date').value, // New date field
        time: document.getElementById('time').value  // New time field
    };

   

    fetch('/insertimmunize', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            $('#ImmunizeModal').modal('hide');
            alert('Immunization saved successfully!'); // Alert success message
            location.reload(); // Reload the page after saving
        } else {
            return response.json().then(data => {
                alert(data.message || 'Error saving immunization!'); // Alert error message
            }).catch(() => {
                alert('An error occurred while saving!'); // Fallback error message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred!'); // Alert error message for unexpected errors
    });
});

function deleteImmunize(id) {
    if (confirm('Are you sure you want to delete this immunization?')) {
        fetch(`/immunizedelete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Immunization deleted successfully!'); // Alert success message
                location.reload(); // Reload the page after deletion
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting immunization!'); // Alert error message
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


