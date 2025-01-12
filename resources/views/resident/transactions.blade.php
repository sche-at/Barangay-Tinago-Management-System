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
@php
$currentPriceSetting = \App\Models\Setting::where('key', 'request_price')->first();
$currentPrice = $currentPriceSetting ? $currentPriceSetting->value : 50;

// Get user's submitted document types
$submittedDocuments = \App\Models\Transactions::where('user_id', auth()->id())
    ->whereIn('status', ['Not Ready', 'Processing', 'Ready for Pickup', 'pending', 'processing', 'for_pickup'])
    ->pluck('trans_type')
    ->toArray();

// Check for pending requests
$pendingRequest = \App\Models\Transactions::where('user_id', auth()->id())
    ->whereIn('status', ['Not Ready', 'Processing', 'Ready for Pickup'])
    ->first();
@endphp

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
                                <select class="form-control request-type" name="trans_type[]" required>
                                    <option value="">Select Request Type</option>
                                    <option value="Barangay Clearance" 
                                        {{ in_array('Barangay Clearance', $submittedDocuments) ? 'disabled' : '' }}>
                                        Barangay Clearance (₱{{ $currentPrice }})
                                    </option>
                                    <option value="Barangay Certificate" 
                                        {{ in_array('Barangay Certificate', $submittedDocuments) ? 'disabled' : '' }}>
                                        Barangay Certificate (₱{{ $currentPrice }})
                                    </option>
                                    <option value="Lot Clearance" 
                                        {{ in_array('Lot Clearance', $submittedDocuments) ? 'disabled' : '' }}>
                                        Lot Clearance (₱{{ $currentPrice }})
                                    </option>
                                    <option value="Certificate of Indigency" 
                                        {{ in_array('Certificate of Indigency', $submittedDocuments) ? 'disabled' : '' }}>
                                        Certificate of Indigency (₱{{ $currentPrice }})
                                    </option>
                                    <option value="Others">Others (₱{{ $currentPrice }})</option>
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

                    <button type="button" class="btn btn-secondary mb-3" id="add-request">
                        <i class="fas fa-plus mr-1"></i> Add Another Request
                    </button>

                    <div class="mb-3">
                        <label class="form-label">Purok</label>
                        <select class="form-control" name="purok" disabled>
                            <option value="">Select Purok</option>
                            @for ($x = 1; $x <= 7; $x++)
                                <option value="{{ $x }}" {{ $x == auth()->user()->purok ? 'selected' : '' }}>Purok {{ $x }}</option>
                            @endfor
                        </select>
                        <!-- Hidden input to ensure the value gets submitted -->
                        <input type="hidden" name="purok" value="{{ auth()->user()->purok }}">
                    </div>
                    
                    
                    

                    <div class="mb-3">
                        <label class="form-label">Mode of Payment</label>
                        <select class="form-control" name="mode_payment" id="mode_payment" required>
                            <option value="">Select Mode of Payment</option>
                            <option value="Cash">Cash</option>
                            <option value="GCash">GCash</option>
                        </select>
                        <div id="gcash_upload_section" class="mt-3" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">GCash Reference Number</label>
                                <input type="text" id="gcash_reference" name="gcash_reference" maxlength="13" class="form-control" required oninput="this.value=this.value.replace(/\D/g,'')">

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload GCash Payment Receipt</label>
                                <input type="file" class="form-control" id="gcash_file" name="gcash_file">
                            </div>
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
    const requestPrice = {{ $currentPrice }}; // Get the current price from the controller

    function updateTotal() {
        const selectedRequests = document.querySelectorAll('.request-type');
        let total = 0;
        selectedRequests.forEach(select => {
            if (select.value) {
                total += requestPrice; // Use the dynamic price
            }
        });
        document.getElementById('displayTotal').textContent = `₱${total.toFixed(2)}`;
        document.getElementById('totalPayable').value = total; // Update total payable
    }

    document.getElementById('mode_payment').addEventListener('change', function() {
        const gcashUploadSection = document.getElementById('gcash_upload_section');
        const gcashReference = document.getElementById('gcash_reference');
        const gcashFile = document.getElementById('gcash_file');

        if (this.value === 'GCash') {
            gcashUploadSection.style.display = 'block';
            gcashReference.required = true;
            gcashFile.required = true;
        } else {
            gcashUploadSection.style.display = 'none';
            gcashReference.required = false;
            gcashFile.required = false;
            gcashReference.value = ''; // Clear the reference number
        }
    });

    document.getElementById('add-request').addEventListener('click', function() {
        const requestContainer = document.getElementById('requests-container');
        
        const newRequestGroup = document.createElement('div');
        newRequestGroup.classList.add('request-group');
        
        newRequestGroup.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Request Type</label>
                <select class="form-control request-type" name="trans_type[]" required>
                    <option value="">Select Request Type</option>
                    <option value="Barangay Clearance">Barangay Clearance (₱${requestPrice})</option>
                    <option value="Barangay Certificate">Barangay Certificate (₱${requestPrice})</option>
                    <option value="Lot Clearance">Lot Clearance (₱${requestPrice})</option>
                    <option value="Certificate of Indigency">Certificate of Indigency (₱${requestPrice})</option>
                    <option value="Others">Others (₱${requestPrice})</option>
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
        updateTotal();
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('request-type')) {
            updateTotal();
        }
    });

    function removeRequest(element) {
        element.closest('.request-group').remove();
        updateTotal();
    }

    updateTotal();
</script>