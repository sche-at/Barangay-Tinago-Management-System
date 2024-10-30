@include('templates.header')

<style>
    .announcement-title {
        text-align: center;
        margin: 20px 0;
        font-size: 2rem;
        font-weight: bold;
        color: #007bff;
    }

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
        background-color: #dc3545; /* Bootstrap danger color */
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .clear-history-button:hover {
        background-color: #c82333; /* Darker shade for hover */
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="announcement-title">Transaction History</div>

            <form action="{{ route('transactions.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all history?');">
                @csrf
                <button type="submit" class="clear-history-button">Clear All History</button>
            </form>

            <ul class="transaction-list">
                @foreach($transactions->sortByDesc('created_at') as $transaction) <!-- Sort transactions here -->
                <li class="transaction-item">
                    <div>
                        <span class="transaction-label">Date: </span>
                        <span class="transaction-value">{{ $transaction->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div>
                        <span class="transaction-label">Transaction Type: </span>
                        <span class="badge bg-primary">{{ $transaction->trans_type }}</span>
                    </div>
                    <div>
                        <span class="transaction-label">Purok: </span>
                        <span class="transaction-value">{{ $transaction->purok }}</span>
                    </div>
                    <div>
                        <span class="transaction-label">Purpose: </span>
                        <span class="transaction-value">{{ $transaction->purpose }}</span>
                    </div>
                    <div>
                        <span class="transaction-label">Payment Mode: </span>
                        <span class="transaction-value">{{ $transaction->mode_payment }}</span>
                    </div>
                    <div>
                        <span class="transaction-label">Status: </span>
                        <span class="transaction-value badge 
                            {{ $transaction->status == 'Not Ready' ? 'bg-danger' : 
                               ($transaction->status == 'Processing' ? 'bg-warning' : 'bg-success') }} text-white">
                            {{ $transaction->status }}
                        </span>
                    </div>
                    <div class="transaction-receipt">
                        <span class="transaction-label">Receipt: </span>
                        @if($transaction->file_path)
                        <a href="{{ asset('storage/'.$transaction->file_path) }}" target="_blank">View Receipt</a>
                        @else
                        <span class="transaction-value">N/A</span>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </main>
@include('templates.footer')
