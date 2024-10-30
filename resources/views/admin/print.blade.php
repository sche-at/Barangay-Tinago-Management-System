<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Transaction</title>
    <style>
        /* Styles for the print view */
        @media print {
            body {
                font-size: 12pt;
                line-height: 1.5;
            }
        }
    </style>
</head>
<body>
    <h1>Transaction Details</h1>
    <p><strong>Name:</strong> {{ $transaction->user->name }}</p>
    <p><strong>Purok:</strong> {{ $transaction->purok }}</p>
    <p><strong>Purpose:</strong> {{ $transaction->purpose }}</p>
    <p><strong>Date:</strong> {{ $transaction->created_at->format('F j, Y') }}</p>
    <p><strong>Status:</strong> {{ $transaction->status }}</p>
    
    <!-- Add more transaction details as needed -->

    <script>
        window.onload = function() {
            window.print(); // Automatically open the print dialog
        };
    </script>
</body>
</html>
