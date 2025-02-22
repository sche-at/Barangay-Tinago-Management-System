@include('templates.header')
@php
$currentPriceSetting = \App\Models\Setting::where('key', 'request_price')->first();
$currentPrice = $currentPriceSetting ? $currentPriceSetting->value : 50; // Default to 50 if not set
@endphp
<style>
    /* Custom CSS for always visible tabs */
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }
    
    .nav-tabs .nav-link {
        margin-bottom: -2px;
        padding: 12px 24px;
        font-weight: 500;
        color: #6c757d;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
        border-bottom: none;
        margin-right: 4px;
    }
    
    .nav-tabs .nav-link:hover {
        border-color: #e9ecef #e9ecef #dee2e6;
        isolation: isolate;
    }
    
    .nav-tabs .nav-link.active {
        color: #007bff;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
        border-top: 3px solid #007bff;
    }
    
    /* Status-specific tab colors */
    #not-ready-tab.active {
        color: #dc3545;
        border-top-color: #dc3545;
    }
    
    #processing-tab.active {
        color: #ffc107;
        border-top-color: #ffc107;
    }
    
    #ready-tab.active {
        color: #28a745;
        border-top-color: #28a745;
    }
    
    #completed-tab.active {
        color: #6c757d;
        border-top-color: #6c757d;
    }
    
    /* Badge count styling */
    .status-count {
        display: inline-block;
        padding: 0.25em 0.6em;
        font-size: 12px;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        margin-left: 5px;
        background-color: #f8f9fa;
    }
    
    .not-ready-count {
        color: #dc3545;
        background-color: rgba(124, 101, 101, 0.1);
    }
    
    .processing-count {
        color: #ffc107;
        background-color: rgba(255, 193, 7, 0.1);
    }
    
    .ready-count {
        color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }
    
    .completed-count {
        color: #6c757d;
        background-color: rgba(108, 117, 125, 0.1);
    }
    </style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div>
                    <i class="fas fa-dollar-sign"></i>
                    Price Maintenance
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('settings.updatePrice') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Current Price</label>
                        <input type="text" class="form-control" name="price" value="{{ $currentPrice }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Price</button>
                </form>
            
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-print"></i>
                        Transaction Reporting
                    </div>
                </div>
                <div class="card-body">
                  <!-- Status Tabs -->
<ul class="nav nav-tabs mb-4" id="statusTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="not-ready-tab" data-bs-toggle="tab" 
                data-bs-target="#not-ready" type="button" role="tab">
            Not Ready
            <span class="badge rounded-pill bg-danger ms-2">
                {{ $transactions->where('status', 'Not Ready')->count() }}
            </span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" 
                data-bs-target="#processing" type="button" role="tab">
            Processing
            <span class="badge rounded-pill bg-warning ms-2">
                {{ $transactions->where('status', 'Processing')->count() }}
            </span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ready-tab" data-bs-toggle="tab" 
                data-bs-target="#ready" type="button" role="tab">
            Ready for Pickup
            <span class="badge rounded-pill bg-success ms-2">
                {{ $transactions->where('status', 'Ready for Pickup')->count() }}
            </span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" 
                data-bs-target="#completed" type="button" role="tab">
            Completed
            <span class="badge rounded-pill bg-secondary ms-2">
                {{ $transactions->where('status', 'Picked Up')->count() }}
            </span>
        </button>
    </li>
</ul>

                    <!-- Tab Content -->
<div class="tab-content" id="statusTabContent">
    @foreach([
        'Not Ready' => 'not-ready',
        'Processing' => 'processing',
        'Ready for Pickup' => 'ready',
        'Picked Up' => 'completed'
    ] as $status => $tabId)
        <div class="tab-pane fade {{ $tabId == 'not-ready' ? 'show active' : '' }}" 
             id="{{ $tabId }}" role="tabpanel">
             
             @if($status == 'Picked Up')
    <!-- Action buttons for completed tab -->
    <div class="mb-3 d-flex gap-2">
        <form action="{{ route('transactions.generateReport') }}" method="GET" id="filter-form" class="d-flex gap-2">
            @csrf
            <input type="date" name="from_date" class="form-control" placeholder="From" value="{{ request('from_date') }}">
            <input type="date" name="to_date" class="form-control" placeholder="To" value="{{ request('to_date') }}">
            
            <!-- Add a submit button instead of automatic submission -->
            <button type="submit" class="btn btn-primary" id="generate-report">
                <i class="fas fa-file-export me-1"></i> Generate Report
            </button>
        </form>
        
        <!-- The Generate Report button triggers the report generation once filtered -->
        {{-- <a href="{{ route('transactions.generateReport') }}" class="btn btn-primary" target="_blank" id="generate-report">
            <i class="fas fa-file-export me-1"></i> Generate Report
        </a> --}}
    
        <form action="{{ route('transactions.clearCompleted') }}" 
              method="POST" 
              style="display: inline-block;"
              onsubmit="return confirm('Are you sure you want to clear all completed transactions? This action cannot be undone.');">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Clear All
            </button>
        </form>
    </div>
    
@endif
<table class="table table-striped table-bordered" id="datatable-{{ $tabId }}">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Purok</th>
            <th>Purpose</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Payment Status</th>
            <th>Receipt</th>
            <th>Requested</th>
            <th>Date</th>
            <th>Time</th>
            <th>Reference Number</th>
            @if($status == 'Ready for Pickup') <!-- Only for 'Ready for Pickup' -->
                <th>Receipt Paper</th>
            @endif
            @if($status != 'Picked Up')
                <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($transactions->where('status', $status) as $row)
            <tr>
                <td>{{ $row->user->name }}</td>
                <td>
                    @if($status != 'Picked Up')
                        <form action="{{ route('transactions.updateStatus', $row->id) }}" method="POST" id="status-form-{{ $row->id }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="new_status" value="
                                @if($status == 'Not Ready')
                                    Processing
                                @elseif($status == 'Processing')
                                    Ready for Pickup
                                @elseif($status == 'Ready for Pickup')
                                    Picked Up
                                @endif
                            ">
                            <button type="submit" class="btn btn-sm
                                @if($status == 'Not Ready')
                                    btn-danger
                                @elseif($status == 'Processing')
                                    btn-warning
                                @elseif($status == 'Ready for Pickup')
                                    btn-success
                                @endif"
                                @if($status == 'Ready for Pickup' && $row->payment_status == 'Unpaid')
                                    disabled
                                @endif>
                                Mark as 
                                @if($status == 'Not Ready')
                                    Processing
                                @elseif($status == 'Processing')
                                    Ready
                                @elseif($status == 'Ready for Pickup')
                                    Picked Up
                                @endif
                            </button>
                        </form>
                    @else
                        <span class="badge bg-secondary">Completed</span>
                    @endif
                </td>
                
                
                <td>{{ $row->purok }}</td>
                <td>{{ $row->purpose }}</td>
                <td>{{ '₱ '.$row->totalPayable }}</td>
                <td>{{ $row->mode_payment }}</td>
                
                <td>
                    <form action="{{ route('transactions.updatePaymentStatus', $row->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm 
                            {{ $row->payment_status == 'Unpaid' ? 'btn-danger' : 'btn-success' }}"
                            {{ $row->status !== 'Ready for Pickup' ? 'disabled' : '' }}>
                            {{ $row->payment_status ?? 'Unpaid' }}
                        </button>
                    </form>
                </td>

                <td>
                    @if($row->file_path)
                        <a href="{{ asset('storage/'.$row->file_path) }}" target="_blank">View Receipt</a>
                    @else
                        <span class="transaction-value">N/A</span>
                    @endif
                </td>
                <td><span class="badge bg-primary">{{ $row->trans_type }}</span></td>
                <td>{{ $row->created_at->format('F j, Y') }}</td>
                <td>{{ $row->created_at->format('h:i A') }}</td>
                <td>{{ $row->reference_number ?? 'N/A' }}</td>
                
                @if($status == 'Ready for Pickup')
                    <td>
                        <form action="{{ route('transactions.addReceipt', $row->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">Print Receipt</button>
                        </form>
                    </td>
                @endif

                @if($status != 'Picked Up')
                    <td>
                        @if($status == 'Processing')
                            <a href="{{ route('transactions.showCertificate', ['id' => $row->id]) }}" 
                               class="btn btn-success btn-sm">Edit for Purpose</a>
                        @endif
                        
                        <form action="{{ route('transactions.delete', $row->id) }}" 
                              method="POST" 
                              style="display: inline-block;"
                              onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
        </div>
    @endforeach

                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('templates.footer')

    @push('scripts')
    {{-- <script>
       document.getElementById('filter-form').addEventListener('change', function () {
    // Automatically submit the form when a date is selected.
    this.submit();
});

document.getElementById('generate-report').addEventListener('click', function (event) {
    // Prevent form submission and print if dates are not selected
    const fromDate = document.querySelector('input[name="from_date"]').value;
    const toDate = document.querySelector('input[name="to_date"]').value;

    if (!fromDate || !toDate) {
        event.preventDefault(); // Prevent the report from being generated
        alert('Please select both start and end date to generate the report.');
    } else {
        // If both dates are selected, open the report in a new tab for printing
        window.open(this.href, '_blank');
    }
});

    </script> --}}
    
    {{-- <script>
        $(document).ready(function() {
            // Initialize DataTables for each status tab
            ['not-ready', 'processing', 'ready', 'completed'].forEach(function(status) {
                $(`#datatable-${status}`).DataTable({
                    responsive: true,
                    order: [[8, 'desc'], [9, 'desc']] // Sort by date and time by default
                });
            });
    
            // Handle tab changes
            $('#statusTabs button').on('shown.bs.tab', function () {
                $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
            });
    
            $('form[action^="{{ route('transactions.updatePaymentStatus', '') }}"]').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var paymentButton = form.find('button'); // The "Paid/Unpaid" button
    var row = form.closest('tr'); // Get the closest row
    var markAsPickedButton = row.find('.mark-as-picked'); // The "Mark as Picked" button

    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        cache: false,
        success: function() {
            // Toggle payment status button text and class
            if (paymentButton.text().trim() === 'Unpaid') {
                paymentButton.text('Paid').removeClass('btn-danger').addClass('btn-success');
                markAsPickedButton.prop('disabled', false); // Enable "Mark as Picked"
            } else {
                paymentButton.text('Unpaid').removeClass('btn-success').addClass('btn-danger');
                markAsPickedButton.prop('disabled', true); // Disable "Mark as Picked"
            }
        },
        error: function() {
            alert('Error updating payment status');
        }
    });
});
        });
    </script>
    @endpush --}}