@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Barangay Blotter
                    </div>
                    <!-- Add Blotter Button -->
                    <button class="btn btn-primary" id="addBlotterBtn" data-bs-toggle="modal" data-bs-target="#blotterModal">Add Blotter</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Blotter Id</th>
                                <th>Respondent</th> 
                                <th>Complainant</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Incident Type</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bloters as $blooter)
                                <tr>
                                    <td>{{ $blooter->id }}</td>
                                    <td>{{ $blooter->blotters_name }}</td> 
                                    <td>{{ $blooter->reported_by }}</td>
                                    <td>{{ $blooter->created_at->format('F j, Y') }}</td> <!-- For the full month name and year -->
                                    <td>{{ $blooter->created_at->format('h:i A') }}</td> <!-- For time with AM/PM -->
                                    <td>{{ $blooter->incident_type }}</td>
                                    <td>{{ $blooter->location }}</td>
                                    <td>{{ $blooter->description }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deleteBlooter({{ $blooter->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="blotterModal" tabindex="-1" aria-labelledby="blotterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blotterModalLabel">Add Blotter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="blotterForm">
                        <div class="mb-3">
                            <label for="blottersName" class="form-label">Respondent</label>
                            <input type="text" class="form-control" id="blottersName" required>
                        </div>
                        <div class="mb-3">
                            <label for="incidentType" class="form-label">Incident Type</label>
                            <input type="text" class="form-control" id="incidentType" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="reportedBy" class="form-label">Complainant</label>
                            <input type="text" class="form-control" id="reportedBy" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBlotterBtn">Save Blotter</button>
                </div>
            </div>
        </div>
    </div>

@include('templates.footer')
</div>

<script>
// Handle the save button click
document.getElementById('saveBlotterBtn').addEventListener('click', function() {
    const data = {
        blotters_name: document.getElementById('blottersName').value,
        incident_type: document.getElementById('incidentType').value,
        location: document.getElementById('location').value,
        reported_by: document.getElementById('reportedBy').value,
        description: document.getElementById('description').value
    };

    fetch('/blotteradd', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            $('#blotterModal').modal('hide');
            alert('Blotter saved successfully!'); // Alert success message
            location.reload(); // Reload the page after saving
        } else {
            return response.json().then(data => {
                alert(data.message || 'Error saving blotter!'); // Alert error message
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
        fetch(`/blotters/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Blotter deleted successfully!'); // Alert success message
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
