@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        {{-- @dd($budgetDetails) --}}
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
                                        <a href="{{ route('budget.exportbudget', ['id' => $row->id]) }}" class="btn btn-success btn-sm">Print</a>
                                        {{-- <button class="btn btn-danger btn-sm" onclick="deletePlanning({{ $row->id }})">Delete</button> --}}
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PlaningModalLabel">Add Planning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form id="eventForm">
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Budget Plan Heading</label>
                        <input type="text" class="form-control" id="titlePlan" name="title_plan" required>
                    </div>
            
                   @php echo $budgetDetails @endphp
                    @foreach($budgetDetails as $details)
                    <div class="card shadow-sm mb-2">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                {{ $details->budget_details }} 
                                 <button type="button" class="btn btn-primary float-end" onclick="addInputRow(this, '{{ $details->id }}')">
                                    <i class="fa fa-plus-circle fs-4"></i>
                                </button>
                                <button type="button" class="btn btn-primary float-end" onclick="addInputRow(this, 1)">
                                    <i class="fa fa-plus-circle fs-4"></i>
                                </button>
                            </h5>
                        </div> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Transaction Detials</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </form> --}}

                <form id="eventForm">
                    <div class="mb-3 fw-bold text-center">
                        <label for="eventType" class="form-label text-primary" style="font-size: 1.5rem;">Budget Plan Heading</label>
                        <input type="text" class="form-control" id="titlePlan" name="title_plan" required>
                    </div>
            
                    @foreach($budgetDetails as $details)
                    <div class="card shadow-sm mb-2">
                        <div class="card-header text-white" style="background-color: #088F8F;">

                            <h5 class="card-title mb-0">
                                {{ $details->budget_details }}
                                <button type="button" class="btn  float-end" style="background-color: #088F8F;" onclick="addInputRow(this, '{{ $details->id }}')">
                                    <i class="fa fa-plus-circle fs-4"></i>
                                </button>
                            </h5>
                        </div> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-success">
                                        <tr>
                                            <th scope="col">Transaction Details</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="budget-details-body" data-budget-id="{{ $details->id }}"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

$('#PlaningModal').on('show.bs.modal', function() {
    // Select all tbody elements within the modal and clear their contents
    $(this).find('tbody').each(function() {
        $(this).empty(); // Clear all rows
    });
});

// document.getElementById('savePlanningBtn').addEventListener('click', function() {
//     const titlePlan = document.getElementById('titlePlan').value;

    

//     // Collect all trans_id, trans_details, and trans_amt values
//     const transIds = Array.from(document.querySelectorAll('input[name="trans_id[]"]')).map(input => input.value);
//     const transDetails = Array.from(document.querySelectorAll('input[name="trans_details[]"]')).map(input => input.value);
//     const transAmounts = Array.from(document.querySelectorAll('input[name="trans_amt[]"]')).map(input => input.value);

//     // Build the data object to send
//     const data = {
//         title_plan: titlePlan,
//         trans_id: transIds,
//         trans_details: transDetails,
//         trans_amt: transAmounts,
//     };

//     fetch('/insertplanning', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': '{{ csrf_token() }}'
//         },
//         body: JSON.stringify(data)
//     })  
//     .then(response => {
//         if (response.ok) {
//             console.log(data);
//             $('#PlaningModal').modal('hide');
//             alert('Budget Plan Heading Added successfully!'); // Alert success message
//            // location.reload(); // Reload the page after saving
//         } else {
//             return response.json().then(data => {
//                 alert(data.message || 'Error saving heading!'); // Alert error message
//             });
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('An unexpected error occurred!'); // Alert error message for unexpected errors
//     });
// });

document.getElementById('savePlanningBtn').addEventListener('click', async function() {
    const titlePlan = document.getElementById('titlePlan').value;
    if (!titlePlan) {
        alert('Please enter a title plan');
        return;
    }

    // Create arrays to store the transaction details
    const transData = {
        title_plan: titlePlan,
        trans_id: [],
        trans_details: [],
        trans_amt: []
    };

    // Collect data from all budget detail sections
    document.querySelectorAll('.budget-details-body').forEach(tbody => {
        const budgetId = tbody.getAttribute('data-budget-id');
        
        tbody.querySelectorAll('tr').forEach(row => {
            const detailsInput = row.querySelector('input[name="trans_details[]"]');
            const amountInput = row.querySelector('input[name="trans_amt[]"]');
            
            // Validate inputs
            if (!detailsInput.value || !amountInput.value) {
                return; // Skip empty rows
            }

            transData.trans_id.push(budgetId);
            transData.trans_details.push(detailsInput.value);
            transData.trans_amt.push(parseFloat(amountInput.value));
        });
    });

    // Validate if there are any transaction details
    if (transData.trans_id.length === 0) {
        alert('Please add at least one transaction detail');
        return;
    }

    try {
        console.log('Sending data:', transData); // Debug log

        const response = await fetch('/insertplanning', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(transData)
        });

        const responseData = await response.json();
        console.log('Response:', responseData); // Debug log

        if (response.ok && responseData.success) {
            $('#PlaningModal').modal('hide');
            alert('Budget Plan added successfully!');
            location.reload();
        } else {
            throw new Error(responseData.message || 'Error saving budget plan');
        }
    } catch (error) {
        console.error('Error details:', error);
        alert(error.message || 'An unexpected error occurred!');
    }
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

// Function to add a new input row in the corresponding table
// function addInputRow(button, id) {
//     const tbody = button.closest('.card').querySelector('tbody'); // Find the tbody within the same card
//     const newRow = document.createElement('tr'); // Create a new row
//     newRow.innerHTML = `
//         <td>
//             <input type="hidden" name="trans_id[]" value="${id}">
//             <input type="text" name="trans_details[]" class="form-control" placeholder="Transaction Details" required>
//         </td>
//         <td><input type="number" name="trans_amt[]" class="form-control" placeholder="Amount" required></td>
//         <td>
//             <button type="button" class="btn btn-danger" onclick="removeInputRow(this)">
//                 <i class="fas fa-trash"></i>
//             </button>
//         </td>
//     `;
//     tbody.appendChild(newRow); // Append the new row to the tbody
// }

function addInputRow(button, budgetId) {
    const tbody = button.closest('.card').querySelector('tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <input type="text" name="trans_details[]" class="form-control" placeholder="Transaction Details" required>
        </td>
        <td>
            <input type="number" name="trans_amt[]" class="form-control" placeholder="Amount" required>
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="removeInputRow(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
}


// Function to remove an input row
function removeInputRow(button) {
    const row = button.closest('tr'); // Find the closest row
    row.remove(); // Remove the row
}
</script>


