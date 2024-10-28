@include('templates.header')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-print"></i>
                        Transaction Reporting
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Purok</th>
                                <th>Purpose</th>
                                <th>Payment</th>
                                <th>Receipt</th>
                                <th>Requested</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $row)
                                <tr>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->purpose }}</td>
                                    <td>{{ $row->purok }}</td>
                                    <td>{{ $row->mode_payment }}</td>
                                    <td>
                                        @if($row->file_path)
                                        <a href="{{ asset('storage/'.$row->file_path) }}" target="_blank">View Receipt</a>
                                        @else
                                        <span class="transaction-value">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $row->trans_type }}
                                        </span>
                                    </td>
                                    <td>{{ $row->created_at->format('F j, Y') }}</td> <!-- For the full month name and year -->
                                    <td>{{ $row->created_at->format('h:i A') }}</td> <!-- For time with AM/PM -->
                                    <td>
                                        <a href="{{ route('transactions.exporttransactions', ['id' => $row->id]) }}" class="btn btn-success btn-sm">Print</a>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@include('templates.footer')