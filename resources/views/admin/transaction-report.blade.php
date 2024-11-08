<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"</title>
    <style>
        @media print {
            body {
                padding: 20px;
                font-family: Arial, sans-serif;
            }
            .no-print {
                display: none;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .report-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        
        .report-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .report-date {
            font-size: 14px;
            color: #666;
        }
        
        .report-content {
            margin: 20px 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        
        .summary-section {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        
        .total-amount {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            text-align: right;
        }
        
        .print-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 20px 0;
        }
        
        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h1 class="report-title">Completed Transactions Report</h1>
        <div class="report-date">Generated on: {{ $summaryData['generatedDate'] }}</div>
    </div>
    
    <div class="report-content">
        <table>
            <thead>
                <tr>
                    <th>Requested Paper</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Completion Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->trans_type }}</td>
                    <td>{{ $transaction->mode_payment }}</td>
                    <td>₱ {{ $transaction->totalPayable }}</td>
                    <td>{{ $transaction->created_at->format('F j, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="summary-section">
            <h3>Summary of Completed Transactions</h3>
            <div class="summary-item">
                <span>Total Completed Transactions:</span>
                <span>{{ $summaryData['totalTransactions'] }}</span>
            </div>
            <div class="summary-item">
                <span>Payment Methods Used:</span>
                <span>{{ $summaryData['paymentMethods']->implode(', ') }}</span>
            </div>
            <div class="total-amount">
                Total Amount Collected: ₱ {{ number_format($summaryData['totalAmount'], 2) }}
            </div>
        </div>
    </div>
    
    <button class="print-button no-print" onclick="window.print()">Print Report</button>
    
    <script>
        document.querySelector('.print-button').addEventListener('click', function() {
            window.print();
        });
    </script>
</body>
</html>