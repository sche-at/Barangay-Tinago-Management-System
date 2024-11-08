@include('templates.header')

<style>
    body {
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    #layoutSidenav {
        flex: 1 0 auto;
        display: flex;
        flex-direction: column;
    }
    #layoutSidenav_content {
        flex: 1 0 auto;
        display: flex;
        flex-direction: column;
        padding: 2rem 0;
        background-color: #f3f4f6;
    }
    .main-content {
        flex: 1 0 auto;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    .announcement-title {
        text-align: center;
        margin: 20px 0 30px;
        font-size: 2.25rem;
        font-weight: bold;
        color: #2563eb;
        font-family: 'Inter', sans-serif;
    }
    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .form-label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        transition: border-color 0.15s ease-in-out;
    }
    .form-control:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }
    .request-group {
        background: #f8fafc;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e5e7eb;
    }
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-primary {
        background: #2563eb;
        color: white;
        border: none;
    }
    .btn-primary:hover {
        background: #1d4ed8;
    }
    .btn-secondary {
        background: #6b7280;
        color: white;
        border: none;
    }
    .btn-secondary:hover {
        background: #4b5563;
    }
    .remove-request {
        color: #dc2626;
        cursor: pointer;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        margin-top: 0.5rem;
    }
    .remove-request:hover {
        color: #b91c1c;
    }
    .total-section {
        background: #f0f9ff;
        border-radius: 8px;
        padding: 1rem;
        margin: 1.5rem 0;
        border: 1px solid #bae6fd;
    }
    .price-tag {
        display: inline-block;
        background: #dbeafe;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-weight: 500;
        color: #1e40af;
        margin-left: 0.5rem;
    }
    .alert {
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .alert-success {
        background-color: #ecfdf5;
        color: #065f46;
        border: 1px solid #6ee7b7;
    }
    footer {
        flex-shrink: 0;
        background: #1f2937;
        color: white;
        padding: 1rem 0;
        margin-top: auto;
        text-align: center;
    }
</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <div class="main-content">
            <div class="announcement-title">Document Request Form</div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="totalPayable" id="totalPayable" value="0">
                    
                    <div id="requests-container">
                        <div class="request-group">
                            <div class="mb-3">
                                <label class="form-label">Request Type</label>
                                <select class="form-control request-type" name="request_type[]" required>
                                    <option value="">Select Request Type</option>
                                    <option value="Barangay Clearance">Barangay Clearance (₱50)</option>
                                    <option value="Barangay Certificate">Barangay Certificate (₱50)</option>
                                    <option value="Lot Clearance">Lot Clearance (₱50)</option>
                                    <option value="Certificate of Indigency">Certificate of Indigency (₱50)</option>
                                    <option value="Others">Others (₱50)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Purpose</label>
                                <textarea class="form-control" name="purpose[]" required rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="total-section">
                        <h3 class="font-semibold text-lg mb-2">Total Payable Amount: <span id="displayTotal" class="text-blue-600">₱0.00</span></h3>
                    </div>

                    <button type="button" class="btn btn-secondary mb-3" id="add-request" disabled>
                        <i class="fas fa-plus mr-1"></i> Add Another Request
                    </button>

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
                        <div id="gcash_upload_section" class="mt-3" style="display: none;">
                            <label class="form-label">Upload GCash Payment Reciept</label>
                            <input type="file" class="form-control" id="gcash_file" name="gcash_file">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

    @include('templates.footer')




<script>
    const requestOptions = [
        { value: "Barangay Clearance", text: "Barangay Clearance (₱50)", price: 50 },
        { value: "Barangay Certificate", text: "Barangay Certificate (₱50)", price: 50 },
        { value: "Lot Clearance", text: "Lot Clearance (₱50)", price: 50 },
        { value: "Certificate of Indigency", text: "Certificate of Indigency (₱50)", price: 50 },
        { value: "Others", text: "Others (₱50)", price: 50 }
    ];

    function updateTotal() {
        const selectedRequests = document.querySelectorAll('.request-type');
        let total = 0;
        selectedRequests.forEach(select => {
            if (select.value) {
                total += 50; // Each request costs ₱50
            }
        });
        document.getElementById('displayTotal').textContent = `₱${total.toFixed(2)}`;
        document.getElementById('totalPayable').value = 50;
    }

    document.getElementById('mode_payment').addEventListener('change', function() {
        const gcashUploadSection = document.getElementById('gcash_upload_section');
        gcashUploadSection.style.display = this.value === 'GCash' ? 'block' : 'none';
    });

    document.getElementById('add-request').addEventListener('click', function() {
        const requestContainer = document.getElementById('requests-container');
        
        const newRequestGroup = document.createElement('div');
        newRequestGroup.classList.add('request-group');
        
        newRequestGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Request Type</label>
                <select class="form-control request-type" name="request_type[]" required>
                    <option value="">Select Request Type</option>
                </select>
                <span class="remove-request" onclick="removeRequest(this)">
                    <i class="fas fa-trash-alt mr-1"></i> Remove Request
                </span>
            </div>
            <div class="mb-3">
                <label class="form-label">Purpose</label>
                <textarea class="form-control" name="purpose[]" required rows="3"></textarea>
            </div>
        `;
        
        requestContainer.appendChild(newRequestGroup);
        updateRequestTypeOptions();
        updateTotal();
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('request-type')) {
            updateRequestTypeOptions();
            validateAddRequestButton();
            updateTotal();
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
        updateTotal();
    }

    updateRequestTypeOptions();
    validateAddRequestButton();
    updateTotal();

    
</script>
