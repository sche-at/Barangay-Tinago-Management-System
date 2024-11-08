<!DOCTYPE html>
<html>
<head>
    <style>
        /* Your existing styles */
        @media print {
            @page {
                size: portrait;
                margin: 1cm;
            }
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                margin: 0;
            }
            .editable {
                border: none !important;
                background: none !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .document-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            text-align: center;
        }

        .logo-section {
            flex: 1;
            text-align: center;
        }

        .logo-section img {
            width: 150px;
            height: 150px;
        }

        .letterhead {
            flex: 2;
            text-align: center;
            line-height: 1.6;
        }

        .right-section {
            flex: 1;
        }

        .document-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
        }

        .content-section {
            margin: 30px 0;
            text-align: justify;
            font-size: 14px;
        }

        .signature-section {
            margin-top: 60px;
            text-align: right;
        }

        .official-name {
            font-weight: bold;
            margin-top: 40px;
        }

        .position-title {
            font-style: italic;
            margin-top: 5px;
        }

        .not-valid {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            font-style: italic;
            font-size: 11px;
        }

        .seal-text {
            text-align: left;
        }

        /* New styles for editable elements */
        .editable {
            border: 1px solid #ddd;
            padding: 5px;
            margin: 2px;
            border-radius: 4px;
            min-width: 100px;
            display: inline-block;
        }

        .editable:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .button-container {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .action-button {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1000;
        }

        .print-button {
            background-color: #007bff;
        }

        .save-button {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="button-container no-print">
        <button onclick="window.location.href='{{ route('transactions.report') }}'" class="action-button back-button">Back</button>
        <button onclick="saveCertificate()" class="action-button save-button">Save</button>
        <button onclick="window.print()" class="action-button print-button">Print Certificate</button>
    </div>

    <div class="document-container">
        <div class="header-section">
            <div class="logo-section">
                <img src="{{ asset('assets/img/tinago.png') }}" alt="Barangay Logo">
            </div>
            <div class="letterhead">
                <strong>Republic of the Philippines</strong><br>
                Province of Bohol<br>
                Municipality of Dauis<br>
                <strong>BARANGAY TINAGO</strong>
            </div>
            <div class="right-section"></div>
        </div>

        <div class="document-title">
            <span contenteditable="true" class="editable" id="trans_type">{{ $transaction->trans_type }}</span>

        </div>

        <div class="content-section">
            <p>TO WHOM IT MAY CONCERN,</p>

            <p>THIS IS TO CERTIFY THAT, according to the records in this office,
                <span contenteditable="true" class="editable" id="name">{{ $transaction->user->name }}</span>
            of legal age, Filipino, a resident of
            <span contenteditable="true" class="editable" id="purok">{{ $transaction->purok }}</span>,
            Barangay Tinago, Dauis, Bohol.</p>
            <br>

            <p>This is to clarify further that
                <span contenteditable="true" class="editable name-duplicate">{{ $transaction->user->name }}</span>, has 
            <span contenteditable="true" class="editable" id="records">no derogatory records or
            administrative complaints filed against him/her in this office as of
            this date</span>.</p>

            <p>This certification is issued upon the request of the above-named person
            for <span contenteditable="true" class="editable" id="purpose">[PURPOSE]</span>.</p>
            <br>

            <p>Issued this <span contenteditable="true" class="editable" id="day">{{ now()->format('jS') }}</span>
            day of <span contenteditable="true" class="editable" id="month">{{ now()->format('F') }}</span>, 
            <span contenteditable="true" class="editable" id="year">{{ now()->format('Y') }}</span>
            at Tinago, Dauis, Bohol.</p>
        </div>

        <div class="signature-section">
            <div class="official-name">ROSARIO P. ARADO</div>
            <div class="position-title">Punong Barangay</div>
        </div>

        <div class="not-valid">
            <div class="seal-text">Not Valid Without Seal</div>
        </div>
    </div>

    <script>
        // Automatically duplicate name when typed
        document.getElementById('name').addEventListener('input', function() {
            document.querySelector('.name-duplicate').textContent = this.textContent;
        });

        // Auto-fill date fields
        window.onload = function() {
            const now = new Date();
            if (document.getElementById('day').textContent === '[DAY]') {
                document.getElementById('day').textContent = now.getDate();
            }
            if (document.getElementById('month').textContent === '[MONTH]') {
                document.getElementById('month').textContent = now.toLocaleString('default', { month: 'long' });
            }
            if (document.getElementById('year').textContent === '[YEAR]') {
                document.getElementById('year').textContent = now.getFullYear();
            }
        };

        // Save function - you can modify this to save to your backend
      // Save function
function saveCertificate() {
    const data = {
        id: {{ $transaction->id }},
        name: document.getElementById('name').textContent,
        purok: document.getElementById('purok').textContent,
        purpose: document.getElementById('purpose').textContent,
        _token: '{{ csrf_token() }}'
    };

    fetch('{{ route('transactions.updateCertificate', $transaction->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Certificate saved successfully!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving certificate');
    });

            
            // You can add your save logic here
            console.log('Saving certificate:', certificate);
            alert('Certificate saved!');
        }

        // Prevent line breaks in editable spans
        document.querySelectorAll('.editable').forEach(element => {
            element.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>