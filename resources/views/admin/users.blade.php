@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-balance-scale-right"></i>
                        User Management
                    </div>
                    <!-- Add User Button -->
                    <button class="btn btn-primary" id="addEventBtn" data-bs-toggle="modal" data-bs-target="#UserModal">Add User</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Date Registered</th>
                                <th>Time Registered</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->user_type }}</td>
                                    <td>{{ $row->created_at->format('F j, Y') }}</td> <!-- For the full month name and year -->
                                    <td>{{ $row->created_at->format('h:i A') }}</td> <!-- For time with AM/PM -->
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="resetPassword({{ $row->id }})">Reset Password</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $row->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">User Type</label>
                        <select class="form-control" id="userType" name="user_type" required>
                            <option value="">Select user type</option>
                            <option value="health_worker">Health Worker</option>
                            <option value="event_handler">Event Handler</option>
                            <option value="treasurer">Treasurer</option>
                            <option value="secretary">Secretary</option>
                            <option value="captain">Captain</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Default Password : <span class="text-danger fw-semibold">btms@2024</span></label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveUserBtn">Save Users</button>
            </div>
        </div>
    </div>
</div>


@include('templates.footer')
</div>

<script>
    document.getElementById('saveUserBtn').addEventListener('click', function() {
        const data = {
            fullName: document.getElementById('fullName').value,
            username: document.getElementById('username').value,
            email: document.getElementById('email').value,
            userType: document.getElementById('userType').value,
            contact: document.getElementById('contact').value
        };
    
        fetch('/insertuser', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (response.ok) {
                $('#UserModal').modal('hide');
                alert('User saved successfully!'); // Alert success message
                location.reload(); // Reload the page after saving
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error saving user!'); // Alert error message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!'); // Alert error message for unexpected errors
        });
    });
    
    // Function to delete a blotter
    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            fetch(`/userdelete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert('User deleted successfully!'); // Alert success message
                        location.reload(); // Reload the page after deletion
                } else {
                    return response.json().then(data => {
                        alert(data.message || 'Error deleting user!'); // Alert error message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred!'); // Alert error message for unexpected errors
            });
        }
    }

    function resetPassword(id) {
        if (confirm('Are you sure you want to reset the password of this user?')) {
            $.ajax({
                url: `/users/reset/${id}`,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('User password successfully reset!');
                    location.reload(); // Refresh the page to show updated data
                },
                error: function(xhr) {
                    alert('An error occurred while resetting the users password: ' + xhr.responseJSON.message);
                }
            });
        }
    }
</script>