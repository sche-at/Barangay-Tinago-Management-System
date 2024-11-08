@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-archive me-1"></i>
                        Archived Blotters
                    </div>
                    <a href="{{ route('blooter.blooters') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Blotters
                    </a>
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
                                <th>Archived Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($archivedBlooters as $blooter)
                                <tr>
                                    <td>{{ $blooter->id }}</td>
                                    <td>{{ $blooter->blotters_name }}</td> 
                                    <td>{{ $blooter->reported_by }}</td>
                                    <td>{{ date('F j, Y', strtotime($blooter->incident_date)) }}</td>
                                    <td>{{ date('h:i A', strtotime($blooter->incident_time)) }}</td>
                                    <td>{{ $blooter->incident_type }}</td>
                                    <td>{{ $blooter->location }}</td>
                                    <td>{{ $blooter->description }}</td>
                                    <td>{{ date('F j, Y', strtotime($blooter->deleted_at)) }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="restoreBlooter({{ $blooter->id }})">Restore</button>
                                        <button class="btn btn-danger btn-sm" onclick="permanentlyDeleteBlooter({{ $blooter->id }})">Delete Permanently</button>
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
                            <label for="incidentDate" class="form-label">Date of Incident</label>
                            <input type="date" class="form-control" id="incidentDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="incidentTime" class="form-label">Time of Incident</label>
                            <input type="time" class="form-control" id="incidentTime" required>
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
function restoreBlooter(id) {
    if (confirm('Are you sure you want to restore this blotter?')) {
        fetch(`/blotters/${id}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Blotter restored successfully!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error restoring blotter!');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!');
        });
    }
}

function permanentlyDeleteBlooter(id) {
    if (confirm('Are you sure you want to permanently delete this blotter? This action cannot be undone!')) {
        fetch(`/blotters/${id}/force-delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Blotter permanently deleted!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting blotter!');
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
