@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-balance-scale-right"></i>
                        Budget Planning
                    </div>
                    <!-- Add Blotter Button -->
                    <button class="btn btn-primary" id="addEventBtn" data-bs-toggle="modal" data-bs-target="#PlaningModal">Add Planning</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Title Plan</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets as $row)
                                <tr>
                                    <td>{{ $row->title_plan }}</td>
                                    <td>{{ $row->created_at->format('F j, Y') }}</td> <!-- For the full month name and year -->
                                    <td>{{ $row->created_at->format('h:i A') }}</td> <!-- For time with AM/PM -->
                                    <td>
                                        <a href="{{ route('budget.exportbudget', ['id' => $row->id]) }}" class="btn btn-success btn-sm">Proceed</a>
                                        <button class="btn btn-danger btn-sm" onclick="deletePlanning({{ $row->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="PlaningModal" tabindex="-1" aria-labelledby="PlaningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PlaningModalLabel">Add Planning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Budget Plan Heading</label>
                        <input type="text" class="form-control" id="titlePlan" name="title_plan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePlanningBtn">Save Planning</button>
            </div>
        </div>
    </div>
</div>


@include('templates.footer')
</div>

<script>
document.getElementById('savePlanningBtn').addEventListener('click', function() {
    const data = {
        title_plan: document.getElementById('titlePlan').value, // Match title_plan
    };

    fetch('/insertplanning', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            $('#PlaningModal').modal('hide');
            alert('Budget plan heading saved successfully!'); // Alert success message
            location.reload(); // Reload the page after saving
        } else {
            return response.json().then(data => {
                alert(data.message || 'Error saving heading!'); // Alert error message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred!'); // Alert error message for unexpected errors
    });
});

// Function to delete a blotter
function deletePlanning(id) {
    if (confirm('Are you sure you want to delete this planning?')) {
        fetch(`/palnningdelete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Budget plan heading deleted successfully!'); // Alert success message
                    location.reload(); // Reload the page after deletion
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error deleting planning!'); // Alert error message
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


