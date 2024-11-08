<!DOCTYPE html>
<html>
<head>
    <style>
        @media print {
            @page {
                size: landscape;
                margin: 1cm;
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
            line-height: 1.6;
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

        .document-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            /* margin-bottom: 20px; */
            position: relative;  /* This is important for absolute positioning of children */
        }

        .letterhead {
           
            margin: 0 auto;
            line-height: 1.5;
        }

        .document-title {
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }

        .salutation {
            font-size: 14px;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            font-size: 11px;
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

        .footer-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature-section {
            text-align: center;
            flex: 1;
        }

        .signature-line {
            width: 200px;
            border-top: 1px solid black;
            margin: 20px auto 0;
            padding-top: 5px;
            text-align: center;
            font-weight: bold;
        }

        .date-section {
            flex: 1;
            text-align: right;
            padding-top: 20px;
        }

        .not-valid {
            text-align: center;
            font-size: 11px;
            font-style: italic;
            margin-top: 10px;
        }
        .logo-section {
    position: absolute;  /* Takes logo out of normal document flow */
}
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-button no-print">Print Budget</button>

    <div class="document-container">
        {{-- <div class="header-section">
            <div style="flex: 1;"></div>
            
            <div class="letterhead">
                    
                <strong>Republic of the Philippines</strong><br>
                Province of Bohol<br>
                Municipality of Dauis<br>
                <strong>BARANGAY TINAGO</strong>
            </div>
            <div style="flex: 1; text-align: right;">
              
            </div>
        </div>

        <div class="document-title">
            {{ strtoupper($budget->title_plan) }}
        </div> --}}

       

        <table>
            <caption>
    <div class="header-section">
        <!-- Left section with logo -->
        <div class="logo-section">
            <img src="{{ asset('assets/img/tinago.png') }}" alt="Barangay Logo" style="width: 120px; height: 120px; margin-left: 200%;">
        </div>
    
        <div class="letterhead">
            <strong>Republic of the Philippines</strong><br>
            Province of Bohol<br>
            Municipality of Dauis<br>
            <strong>BARANGAY TINAGO</strong>
        </div>
        
        <!-- Right section (kept for balance) -->
        <div class="right-section">
        </div>
    </div>

    <div class="document-title">
        {{ strtoupper($budget->title_plan) }}
    </div>
</caption>
            <colgroup>
                <col style="width: 5%">
                <col style="width: 65%">
                <col style="width: 15%">
                <col style="width: 15%">
            </colgroup>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Particulars</th>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $section)
                    <tr>
                        <td colspan="4" class="section-header">{{ $section['title'] }}</td>
                    </tr>
                    @php $index = 1; @endphp
                    
                    @foreach($section['values'] as $value)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $value->details_value }}</td>
                            <td>{{ $section['title'] }}</td>
                            <td class="amount-cell">₱ {{ number_format($value->amount, 2) }}</td>
                        </tr>
                        @php $index++; @endphp
                    @endforeach

                    <tr class="total-row">
                        <td colspan="3" style="text-align: right">{{ $section['title'] }} Subtotal:</td>
                        <td class="amount-cell">₱ {{ number_format($section['sectionTotal'], 2) }}</td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="3" style="text-align: right">GRAND TOTAL:</td>
                    <td class="amount-cell">₱ {{ number_format($grandTotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>