@include('templates.header')

<style>
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
            <div class="announcement-title">Request </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label class="form-label">Reqeuest Type</label>
                <select class="form-control" name="request_type" required>
                    <option value="">Select Request Type</option>
                    <option value="Barangay Clearance">Barangay Clearance</option>
                    <option value="Barangay Certificate">Barangay Certificate</option>
                    <option value="Lot Clearance">Lot Clearance</option>
                    <option value="Certificate of Indigency">Certificate of Indigency</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Purok</label>
                <select class="form-control" name="purok" required>
                    <option value="">Select Purok</option>
                    @for ($x=1;$x<=7;$x++)
                        <option>Purok {{ $x }}</option>
                    @endfor
                </select>
              </div>
              
              <div class="mb-3">
                <label class="form-label">Purpose</label>
                <textarea class="form-control" name="purpose" required rows="3"></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label">Mode of Payment</label>
                <select class="form-control" name="mode_payment" id="mode_payment" required>
                    <option value="">Select Mode of Payment</option>
                    <option value="Cash">Cash</option>
                    <option value="GCash">GCash</option>
                </select>

                <input type="file" class="mt-3" id="gcash_file" name="gcash_file" style="display: none;">
              </div>
              <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </main>
@include('templates.footer')

<script>
    document.getElementById('mode_payment').addEventListener('change', function() {
        const modePayment = this.value;
        const gcashFileInput = document.getElementById('gcash_file');
        
        // Show the file input only if "GCash" is selected
        if (modePayment === 'GCash') {
            gcashFileInput.style.display = 'block';
        } else {
            gcashFileInput.style.display = 'none';
        }
    });
</script>