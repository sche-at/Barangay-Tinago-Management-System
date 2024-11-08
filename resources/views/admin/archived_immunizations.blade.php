@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-archive me-1"></i>
                        Archived Immunization Records
                    </div>
                    <a href="{{ route('immunize') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Active Records
                    </a>
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
                                <th>Archived Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($archivedImmunizes as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->vaccine }}</td>
                                    <td>{{ $row->age }}</td>
                                    <td>{{ $row->dosage }}</td>
                                    <td>{{ $row->venue }}</td>
                                    <td>{{ $row->notes }}</td>
                                    <td>{{ $row->date }}</td>
                                    <td>{{ $row->time }}</td>
                                    <td>{{ $row->deleted_at->format('F j, Y') }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="restoreImmunize({{ $row->id }})">
                                            <i class="fas fa-undo me-1"></i>Restore
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="permanentDeleteImmunize({{ $row->id }})">
                                            <i class="fas fa-trash me-1"></i>Delete Permanently
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
function restoreImmunize(id) {
    if (confirm('Are you sure you want to restore this immunization record?')) {
        fetch(`/immunize/restore/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Immunization restored successfully!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error restoring immunization!');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!');
        });
    }
}

function permanentDeleteImmunize(id) {
    if (confirm('Are you sure you want to permanently delete this immunization? This action cannot be undone!')) {
        fetch(`/immunize/force-delete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Immunization permanently deleted!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting immunization!');
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

@include('templates.footer')