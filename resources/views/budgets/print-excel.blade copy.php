<!DOCTYPE html>
<html>
<head>
    <title>{{ $budget->title_plan }}</title>
    <style>
        @media print {
            @page {
                size: landscape;
                margin: 0.5cm;
            }
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                margin: 0;
            }
            table {
                page-break-inside: avoid;
            }
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .section-header {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
        }

        .amount-cell {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f8f8;
        }

        .merged-cell {
            background-color: #e9ecef;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-button no-print">Print Budget</button>

    <div class="header">
        {{ $budget->title_plan }}
    </div>

    <table>
        <colgroup>
            <col style="width: 5%">
            <col style="width: 75%">
            <col style="width: 20%">
        </colgroup>

        @foreach($details as $section)
            <tr>
                <td colspan="3" class="section-header">{{ $section['title'] }}</td>
            </tr>
            @php $index = 1; @endphp
            
            @foreach($section['values'] as $value)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $value->details_value }}</td>
                    <td class="amount-cell">₱ {{ number_format($value->amount, 2) }}</td>
                </tr>
                @php $index++; @endphp
            @endforeach

            <tr class="total-row">
                <td colspan="2" style="text-align: right">Subtotal:</td>
                <td class="amount-cell">₱ {{ number_format($section['sectionTotal'], 2) }}</td>
            </tr>
        @endforeach

        <tr class="total-row">
            <td colspan="2" style="text-align: right">GRAND TOTAL:</td>
            <td class="amount-cell">₱ {{ number_format($grandTotal, 2) }}</td>
        </tr>
    </table>

    <script>
        // Automatically open print dialog when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>