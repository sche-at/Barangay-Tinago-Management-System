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
                    <div>
                    <button class="btn btn-secondary me-2" onclick="window.location.href='{{ route('archived_blooters') }}'"><i class="fas fa-archive me-1"></i>View Archived</button>
                    <button class="btn btn-success me-2" onclick="generateReport()">
                        <i class="fas fa-file-pdf me-1"></i>Generate Report
                    </button>
                    <button class="btn btn-primary" id="addBlotterBtn" data-bs-toggle="modal" data-bs-target="#blotterModal">Add Blotter</button>
                </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Blotter Id</th>
                                <th>Complainant</th>
                                <th>Defendant</th> 
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
                                    <td>{{ $blooter->reported_by }}</td>
                                    <td>{{ $blooter->blotters_name }}</td> 
                                    <td>{{ date('F j, Y', strtotime($blooter->incident_date)) }}</td>
                                    <td>{{ date('h:i A', strtotime($blooter->incident_time)) }}</td>
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

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Barangay Blotter Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reportContent">
                    <!-- Report content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printReport()">Print Report</button>
                </div>
            </div>
        </div>
    </div>

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
                            <label for="reportedBy" class="form-label">Complainant</label>
                            <input type="text" class="form-control" id="reportedBy" required>
                        </div>
                        <div class="mb-3">
                            <label for="blottersName" class="form-label">Defendant</label>
                            <input type="text" class="form-control" id="blottersName" required>
                        </div>
                        <div class="mb-3">
                            <label for="incidentType" class="form-label">Incident Type</label>
                            <select class="form-control" id="incidentType" name="incidentType" onchange="toggleOtherField()" required>
                                <option disabled selected value="">Select a Type of Incident</option>
                                <option value="Theft">Theft</option>
                                <option value="Assault">Assault</option>
                                <option value="Burglary">Burglary</option>
                                <option value="Domestic Violence">Domestic Violence</option>
                                <option value="Vandalism">Vandalism</option>
                                <option value="Disturbance">Disturbance</option>
                                <option value="Traffic Violation">Traffic Violation</option>
                                <option value="Fraud">Fraud</option>
                                <option value="Drunk and Disorderly">Drunk and Disorderly</option>
                                <option value="Noise Complaint">Noise Complaint</option>
                                <option value="Trespassing">Trespassing</option>
                                <option value="Harassment">Harassment</option>
                                <option value="Public Intoxication">Public Intoxication</option>
                                <option value="Missing Person">Missing Person</option>
                                <option value="Other">Other</option>
                            </select>
                            <div id="otherIncidentDiv" style="display: none;" class="mt-2">
                                <label for="otherIncidentType" class="form-label">Please Specify Other Incident Type</label>
                                <input type="text" class="form-control" id="otherIncidentType" name="otherIncidentType">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" required>
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
                            <textarea class="form-control" id="description" rows="3"></textarea>
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
    function toggleOtherField() {
        const selectElement = document.getElementById('incidentType');
        const otherDiv = document.getElementById('otherIncidentDiv');
        const otherInput = document.getElementById('otherIncidentType');
        
        if (selectElement.value === 'Other') {
            otherDiv.style.display = 'block';
            otherInput.setAttribute('required', 'required');
        } else {
            otherDiv.style.display = 'none';
            otherInput.removeAttribute('required');
            otherInput.value = ''; // Clear the input when hidden
        }
    }
    
    // Single event listener for save button
    document.getElementById('saveBlotterBtn').addEventListener('click', function() {
        const selectElement = document.getElementById('incidentType');
        const otherInput = document.getElementById('otherIncidentType');
        
        // Get the incident type value
        let incidentTypeValue;
        if (selectElement.value === 'Other') {
            incidentTypeValue = otherInput.value.trim();
            if (!incidentTypeValue) {
                alert('Please specify the other incident type');
                return;
            }
        } else {
            incidentTypeValue = selectElement.value;
        }
    
        // Create the data object
        const data = {
            blotters_name: document.getElementById('blottersName').value,
            incident_type: incidentTypeValue,
            location: document.getElementById('location').value,
            reported_by: document.getElementById('reportedBy').value,
            incident_date: document.getElementById('incidentDate').value,
            incident_time: document.getElementById('incidentTime').value,
            description: document.getElementById('description').value || ''
        };
    
        // Validate required fields
        if (!data.blotters_name || !data.location || !data.reported_by || 
            !data.incident_date || !data.incident_time || !data.incident_type) {
            alert('Please fill in all required fields');
            return;
        }
    
        // Log the data being sent (for debugging)
        console.log('Sending data:', data);
    
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
                alert('Blotter saved successfully!');
                location.reload();
            } else {
                return response.json().then(data => {
                    alert(data.message || 'Error saving blotter!');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred!');
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
                    alert('Blotter deleted successfully!');
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
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleOtherField();
    });
    
    // Add form reset handler when modal is closed
    document.getElementById('blotterModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('blotterForm').reset();
        toggleOtherField(); // Reset the other field visibility
    });

   function generateReport() {
    const rows = document.querySelectorAll('#datatablesSimple tbody tr');
    const currentDate = new Date().toLocaleDateString();
    
    let reportHTML = `
        <div class="report-container">
            <div class="report-header">
                <h4 style="margin: 10px 0;">Republic of the Philippines</h4>
                <h4 style="margin: 10px 0;">Province of Bohol</h4>
                <h4 style="margin: 10px 0;">Municipality of Dauis</h4>
                <h3 style="margin: 15px 0;">OFFICE OF THE BARANGAY CAPTAIN</h3>
                <h2 style="margin: 20px 0;">BARANGAY BLOTTER REPORT</h2>
                <p style="margin: 10px 0;">Date Generated: ${currentDate}</p>
            </div>

            <table class="report-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">Blotter ID</th>
                        <th style="width: 12%;">Complainant</th>
                        <th style="width: 12%;">Defendant</th>
                        <th style="width: 12%;">Date</th>
                        <th style="width: 10%;">Time</th>
                        <th style="width: 12%;">Incident Type</th>
                        <th style="width: 12%;">Location</th>
                        <th style="width: 22%;">Description</th>
                    </tr>
                </thead>
                <tbody>
    `;

    rows.forEach(row => {
        const cells = row.cells;
        reportHTML += `
            <tr>
                <td>${cells[0].textContent}</td>
                <td>${cells[1].textContent}</td>
                <td>${cells[2].textContent}</td>
                <td>${cells[3].textContent}</td>
                <td>${cells[4].textContent}</td>
                <td>${cells[5].textContent}</td>
                <td>${cells[6].textContent}</td>
                <td>${cells[7].textContent}</td>
            </tr>
        `;
    });

    reportHTML += `
                </tbody>
            </table>

            <div class="report-footer">
                <strong>Total Number of Cases: ${rows.length}</strong>
                
                <div class="signatures">
                    <div class="signature-block">
                        <div class="signature-line"></div>
                        <strong>Prepared by:</strong><br>
                        Barangay Secretary
                    </div>
                    
                    <div class="signature-block">
                        <div class="signature-line"></div>
                        <strong>Certified Correct:</strong><br>
                        Barangay Chairman
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('reportContent').innerHTML = reportHTML;
    new bootstrap.Modal(document.getElementById('reportModal')).show();
}

function printReport() {
    window.print();
}

// Optional: Add event listener to close modal after printing
window.onafterprint = function() {
    document.querySelector('#reportModal .btn-close').click();
};
    </script>
<!-- Add this updated CSS -->
<style>
    /* General styling */
    <!-- Updated CSS preserving their structure -->
<style>
    .report-container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Times New Roman', Times, serif;
        top: 0px;
    }

    .report-header {
        text-align: center;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .report-header h2, 
    .report-header h3, 
    .report-header h4 {
        margin: 8px 0;
        font-family: 'Times New Roman', Times, serif;
    }

    .report-header h2 {
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        margin: 20px 0;
    }

    .report-header h3 {
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        margin: 15px 0;
    }

    .report-header h4 {
        font-size: 16px;
        font-weight: normal;
        margin: 10px 0;
    }

    .report-header p {
        font-size: 14px;
        margin: 15px 0;
        font-style: italic;
    }
    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 14px;
    }

    .report-table th,
    .report-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .report-table th {
        background-color: #f4f4f4;
    }

    .report-footer {
        margin-top: 50px;
        
    }

    .signatures {
        display: flex;
        justify-content: space-between;
        margin-top: 100px;
        width: 100%;
    }

    .signature-block {
        width: 250px;
        text-align: center;
    }

    .signature-line {
        border-top: 1px solid #000;
        margin-bottom: 5px;
    }

    /* Print specific styles */
    @media print {
        @page {
            size: A4;
            margin: 2cm;
        }

        body * {
            visibility: hidden;
        }

        #reportContent, 
        #reportContent * {
            visibility: visible;
        }

        #reportContent {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
        }

        .report-table {
            page-break-inside: auto;
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0; /* Remove auto margins */
            margin-left: -90px; /* Shift table to the left */
        }

        .report-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .report-table th {
            background-color: #f4f4f4 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .no-print {
            display: none !important;
        }

        .report-header {
            margin-bottom: 30px;
        }

        .signatures {
            position: fixed;
            bottom: 100px;
            left: 0;
            right: 0;
            margin: 0 50px;
        }
    }
</style>