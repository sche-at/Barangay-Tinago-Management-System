@include('templates.header')

<style>
    .announcement-title {
        text-align: center;
        margin: 20px 0;
        font-size: 2rem;
        font-weight: bold;
        color: #007bff;
    }
    .remove-request {
        color: #dc3545;
        cursor: pointer;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="announcement-title">Request</div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                @csrf
                <div id="requests-container">
                    <div class="request-group mb-4">
                        <div class="mb-3">
                            <label class="form-label">Request Type</label>
                            <select class="form-control request-type" name="request_type[]" required>
                                <option value="">Select Request Type</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Barangay Certificate">Barangay Certificate</option>
                                <option value="Lot Clearance">Lot Clearance</option>
                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Purpose</label>
                            <textarea class="form-control" name="purpose[]" required rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-request" disabled>Add Another Request</button>

                <div class="mb-3">
                    <label class="form-label">Purok</label>
                    <select class="form-control" name="purok" required>
                        <option value="">Select Purok</option>
                        @for ($x=1; $x<=7; $x++)
                            <option>Purok {{ $x }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mode of Payment</label>
                    <select class="form-control" name="mode_payment" id="mode_payment" required>
                        <option value="">Select Mode of Payment</option>
                        <option value="Cash">Cash</option>
                        <option value="GCash">GCash</option>
                    </select>
                    <input type="file" class="mt-3" id="gcash_file" name="gcash_file" style="display: none;">
                </div>

                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </main>
@include('templates.footer')

<script>
    const requestOptions = [
        { value: "Barangay Clearance", text: "Barangay Clearance" },
        { value: "Barangay Certificate", text: "Barangay Certificate" },
        { value: "Lot Clearance", text: "Lot Clearance" },
        { value: "Certificate of Indigency", text: "Certificate of Indigency" },
        { value: "Others", text: "Others" }
    ];

    document.getElementById('mode_payment').addEventListener('change', function() {
        const modePayment = this.value;
        const gcashFileInput = document.getElementById('gcash_file');
        
        if (modePayment === 'GCash') {
            gcashFileInput.style.display = 'block';
        } else {
            gcashFileInput.style.display = 'none';
        }
    });

    document.getElementById('add-request').addEventListener('click', function() {
        const requestContainer = document.getElementById('requests-container');
        
        const newRequestGroup = document.createElement('div');
        newRequestGroup.classList.add('request-group', 'mb-4');
        
        newRequestGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Request Type</label>
                <select class="form-control request-type" name="request_type[]" required>
                    <!-- Options will be dynamically populated -->
                </select>
                <span class="remove-request" onclick="removeRequest(this)">Remove</span>
            </div>
            <div class="mb-3">
                <label class="form-label">Purpose</label>
                <textarea class="form-control" name="purpose[]" required rows="3"></textarea>
            </div>
        `;
        
        requestContainer.appendChild(newRequestGroup);
        updateRequestTypeOptions();
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('request-type')) {
            updateRequestTypeOptions();
            validateAddRequestButton();
        }
    });

    function updateRequestTypeOptions() {
        const selectedValues = Array.from(document.querySelectorAll('.request-type'))
            .map(select => select.value)
            .filter(value => value !== "");
        
        document.querySelectorAll('.request-type').forEach(select => {
            const currentValue = select.value;
            select.innerHTML = `<option value="">Select Request Type</option>`;
            
            requestOptions.forEach(option => {
                if (!selectedValues.includes(option.value) || option.value === currentValue) {
                    const opt = document.createElement('option');
                    opt.value = option.value;
                    opt.text = option.text;
                    opt.selected = option.value === currentValue;
                    select.appendChild(opt);
                }
            });
        });
    }

    function validateAddRequestButton() {
        const allSelected = Array.from(document.querySelectorAll('.request-type')).every(select => select.value !== "");
        document.getElementById('add-request').disabled = !allSelected;
    }

    function removeRequest(element) {
        element.closest('.request-group').remove();
        updateRequestTypeOptions();
        validateAddRequestButton();
    }

    updateRequestTypeOptions();
    validateAddRequestButton();
</script>
