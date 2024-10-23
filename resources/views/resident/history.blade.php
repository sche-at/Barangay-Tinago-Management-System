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
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="announcement-title">Transaction History</div>

            <ul class="transaction-list">
                @foreach($transactions as $transaction)
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
