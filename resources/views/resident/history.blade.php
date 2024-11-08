@include('templates.header')
<style>
    /* Tab styling from reporting blade */
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
    
    /* Transaction item styling */
    .transaction-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .transaction-item {
        background-color: #f8f9fa;
        margin-bottom: 15px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .transaction-item div {
        margin-bottom: 8px;
    }

    .transaction-label {
        font-weight: bold;
        color: #333;
    }

    .transaction-value {
        color: #555;
    }

    .transaction-receipt a {
        color: #007bff;
        text-decoration: none;
    }

    .transaction-receipt a:hover {
        text-decoration: underline;
    }

    .clear-history-button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        font-size: 1rem;
        color: #fff;
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .clear-history-button:hover {
        background-color: #c82333;
    }

    .announcement-title {
        text-align: center;
        margin: 20px 0;
        font-size: 2rem;
        font-weight: bold;
        color: #007bff;
    }

    
    
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="announcement-title">Transaction History</div>
            
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-history"></i>
                        Transaction History
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
                {{-- <div class="mb-3 d-flex gap-2">
                    <a href="{{ route('transactions.generateReport') }}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-file-export me-1"></i> Generate Report
                    </a>
                    <form action="{{ route('transactions.clearCompleted') }}" 
                          method="POST" 
                          style="display: inline-block;"
                          onsubmit="return confirm('Are you sure you want to clear all completed transactions? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Clear All
                        </button>
                    </form>
                </div> --}}
            @endif

            <table class="table table-striped table-bordered" id="datatable-{{ $tabId }}">
                <thead>
                    <tr>
                        <th>Date/Time</th>
                        <th>Transaction Type</th>
                        <th>Purok</th>
                        <th>Purpose</th>
                        <th>Total Payable</th>
                        <th>Payment Mode</th>
                        <th>Status</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions->where('status', $status)->sortByDesc('created_at') as $transaction)
                        <tr>
                            <td>
                                <div>{{ $transaction->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $transaction->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $transaction->trans_type }}</span>
                            </td>
                            <td>{{ $transaction->purok }}</td>
                            <td>
                                @if($status == 'Processing')
                                    <a href="{{ route('transactions.showCertificate', ['id' => $transaction->id]) }}" 
                                       class="btn btn-link p-0">{{ $transaction->purpose }}</a>
                                @else
                                    {{ $transaction->purpose }}
                                @endif
                            </td>
                            <td>{{ '₱ '.$transaction->totalPayable}}</td>
                            <td>{{ $transaction->mode_payment }}</td>
                            <td>
                                @if($status != 'Picked Up')
                                    <form action="{{ route('transactions.updateStatus', $transaction->id) }}" method="POST">
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
                                            @endif">
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
                            <td>
                                @if($transaction->file_path)
                                    <a href="{{ asset('storage/'.$transaction->file_path) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       target="_blank">
                                        <i class="fas fa-file-alt"></i> View
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>

                    <form action="{{ route('transactions.clear') }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to clear all history?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Clear All
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>


@include('templates.footer')

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle tab changes
        $('#statusTabs button').on('shown.bs.tab', function (e) {
            // You can add any additional functionality here when tabs are switched
        });
    });
    
</script>
@endpush