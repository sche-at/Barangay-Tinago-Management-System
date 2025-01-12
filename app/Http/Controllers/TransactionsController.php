<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Helpers\NumberToWords;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf; // Import Dompdf
use Illuminate\Support\Facades\Auth;
use Dompdf\Options; // Import Options

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_type == 'resident'){
            return view('resident.transactions');
        } else {
            return redirect(route('dashboard'));
        }

        
    }

   

    public function report()
    {
        $user = Auth::user();
    
        if ($user->user_type == 'treasurer' || $user->user_type == 'captain') {
            $transactions = Transactions::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
    
            // Group transactions by status
            $notReadyTransactions = $transactions->where('status', 'Not Ready');
            $processingTransactions = $transactions->where('status', 'Processing');
            $readyTransactions = $transactions->where('status', 'Ready for Pickup');
            $pickedUpTransactions = $transactions->where('status', 'Picked Up');
    
            // Get the current price setting
            $currentPriceSetting = \App\Models\Setting::where('key', 'request_price')->first();
            $currentPrice = $currentPriceSetting ? $currentPriceSetting->value : 50; // Default to 50 if not set
    
            return view('admin.report', compact(
                'transactions', 
                'notReadyTransactions',
                'processingTransactions',
                'readyTransactions',
                'pickedUpTransactions',
                'currentPrice' // Pass the current price to the view
            ));
        } else {
            return redirect(route('dashboard'));
        }
    }

    public function export($id)
    {
        $transaction = Transactions::with('user')->findOrFail($id);
        return view('print-document', compact('transaction'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $currentPriceSetting = \App\Models\Setting::where('key', 'request_price')->first();
    $currentPrice = $currentPriceSetting ? $currentPriceSetting->value : 50; // Default to 50 if not set

    return view('resident.transactions', compact('currentPrice'));

}
    /**
     * Store a newly created resource in storage.
     */
 
     public function store(Request $request)
     {
         // Validate the incoming request data
         $request->validate([
             'trans_type' => 'required|array', // Ensure this matches your form input name
             'purpose' => 'required|array',
             'purok' => 'required|string',
             'mode_payment' => 'required|string',
             'gcash_reference' => 'required_if:mode_payment,GCash',
             'gcash_file' => 'required_if:mode_payment,GCash|file|mimes:jpg,jpeg,png,pdf|max:5120',
         ]);
     
         // Get the current price setting
         $currentPriceSetting = \App\Models\Setting::where('key', 'request_price')->first();
         $currentPrice = $currentPriceSetting ? $currentPriceSetting->value : 50; // Default to 50 if not set
     
         // Create a new transaction for each request type
         foreach ($request->trans_type as $index => $requestType) {
             $transaction = new Transactions();
             $transaction->is_read = false;
             $transaction->user_id = Auth::id();
             $transaction->trans_type = $requestType;
             $transaction->purpose = $request->purpose[$index];
             $transaction->purok = $request->purok;
             $transaction->mode_payment = $request->mode_payment;
             $transaction->reference_number = $request->gcash_reference; // Save the reference number
             $transaction->totalPayable = $currentPrice; // Set the total payable to the current price
     
             // Handle file upload for GCash receipt
             if ($request->mode_payment === 'GCash' && $request->hasFile('gcash_file')) {
                 $filePath = $request->file('gcash_file')->store('gcash_receipts', 'public');
                 $transaction->file_path = $filePath;
             }
     
             // Automatically set the payment status to "Paid" if GCash is selected
             $transaction->payment_status = $request->mode_payment === 'GCash' ? 'Paid' : 'Unpaid';
     
             $transaction->save(); // Save the transaction
         }
     
         // Redirect back with success message
         return redirect()->route('transactions.create')->with('success', 'Transaction created successfully!');
     }
     

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transactions)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transactions::findOrFail($id);
        $newStatus = $request->input('new_status');
        
        // Define valid status transitions
        $validTransitions = [
            'Not Ready' => 'Processing',
            'Processing' => 'Ready for Pickup',
            'Ready for Pickup' => 'Picked Up'
        ];

        // Validate the status transition
        if (isset($validTransitions[$transaction->status]) && 
            $validTransitions[$transaction->status] === $newStatus) {
            
            $transaction->status = $newStatus;
            $transaction->save();

            return redirect()->back()->with('success', 'Transaction status updated successfully!');
        }

        return redirect()->back()->with('error', 'Invalid status transition.');
    }



public function clearHistory()
{
    $user = Auth::user();

    if($user->user_type == 'resident') {
        // Instead of deleting, mark transactions as deleted
        Transactions::where('user_id', $user->id)
            ->update(['deleted_by_user' => true]);
            
        return redirect()->back()->with('success', 'Your transaction history has been cleared successfully.');
    }

    return redirect()->back()->with('error', 'Unauthorized action.');
}

public function history()
{
    $user = Auth::user();

    if($user->user_type == 'resident'){
        $transactions = Transactions::with('user')
            ->where('user_id', $user->id)
            ->where('deleted_by_user', false)  // Only show non-deleted transactions
            ->get();
        return view('resident.history', compact('transactions'));
    } else {
        return redirect(route('dashboard'));
    }
}


public function generateReport(Request $request)
{
    $user = Auth::user();

    // Check if user is authorized to view the report
    if (!in_array($user->user_type, ['treasurer', 'captain'])) {
        return redirect(route('dashboard'));
    }

    // Get filter dates from request
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');

    // Check if both dates are provided
    if (!$fromDate || !$toDate) {
        return redirect()->back()->with('error', 'Please select both start and end dates to generate the report.');
    }

    // Query transactions
    $transactionsQuery = Transactions::with('user')
        ->where('status', 'Picked Up')  // Only get completed transactions
        ->orderBy('created_at', 'desc');

    // Apply date range filter if dates are provided
    if ($fromDate) {
        $transactionsQuery->where('created_at', '>=', Carbon::parse($fromDate)->startOfDay());
    }

    if ($toDate) {
        $transactionsQuery->where('created_at', '<=', Carbon::parse($toDate)->endOfDay());
    }

    // Get the filtered transactions
    $transactions = $transactionsQuery->get();

    // Calculate summary data
    $summaryData = [
        'totalTransactions' => $transactions->count(),
        'paymentMethods' => $transactions->pluck('mode_payment')->unique(),
        'totalAmount' => $transactions->sum('totalPayable'),
        'generatedDate' => now()->format('F j, Y')
    ];

    return view('admin.transaction-report', [
        'transactions' => $transactions,
        'summaryData' => $summaryData
    ]);
}


public function deleteTransaction($id)
    {
        $transaction = Transactions::findOrFail($id);
        
        // Only allow deletion if status is not "Picked Up"
        if ($transaction->status !== 'Picked Up') {
            $transaction->delete();
            return redirect()->back()->with('success', 'Transaction deleted successfully.');
        }
        
        return redirect()->back()->with('error', 'Cannot delete completed transactions.');
    }
    public function clearCompleted()
    {
        // Delete only completed transactions
        Transactions::where('status', 'Picked Up')->delete();
        
        return redirect()->back()->with('success', 'All completed transactions have been cleared successfully.');
    }
    
    public function showCertificate($id)
{
    $transaction = Transactions::with('user')->findOrFail($id);
    return view('budgets.print-document', compact('transaction'));
}

public function updateCertificate(Request $request, $id)
{
    $transaction = Transactions::findOrFail($id);
    $transaction->purpose = $request->purpose;
    $transaction->save();

    return response()->json([
        'success' => true,
        'message' => 'Certificate updated successfully'
    ]);
}
public function togglePaymentStatus($id)
{
    $transaction = Transactions::findOrFail($id);
    $transaction->is_paid = !$transaction->is_paid; // Toggle the payment status
    $transaction->save();

    return response()->json(['success' => true]);
}

public function markTransactionsAsRead()
{
    Transactions::where('is_read', false)->update(['is_read' => true]);
    return redirect()->route('transactions.history');
}

public function addReceipt($id)
{
    // Retrieve the transaction by ID, including the user relationship
    $transaction = Transactions::with('user')->findOrFail($id);

    // Check if the necessary attributes exist
    if (!$transaction->trans_type || !$transaction->totalPayable) {
        return response()->json(['error' => 'Transaction data is incomplete.'], 404);
    }

    // Get all transactions for the user with "Ready for Pickup" status
    $transactions = Transactions::with('user')
        ->where('user_id', $transaction->user_id)
        ->where('status', 'Ready for Pickup')
        ->get();

    // Calculate the total amount for all transactions
    $totalAmount = $transactions->sum('totalPayable');

    // Get the user's name
    $userName = $transaction->user ? $transaction->user->name : 'Unknown';

    // Generate the receipt HTML
    $html = '<html>
                <head>
                    <title>Receipt</title>
                    <style>
                        /* Add your CSS styles here */
                    </style>
                </head>
                <body>
                    <h2></h2><br><br>
                    <p style="margin-left: 20px;">' . date('F j, Y') . '</p><br>
                    <p style="margin-top: -1rem;"><strong>&nbsp; &nbsp;</strong> ' . htmlspecialchars($userName) . '</p>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';

    // Loop through transactions to populate the receipt
    foreach ($transactions as $trans) {
        $html .= '<tr>
                    <td><span style="font-size: 13px; margin-left: 10px">' . htmlspecialchars($trans->trans_type) . '</span></td>
                    <td><span style="margin-left: 80px; font-size: 13px;">PHP ' . number_format($trans->totalPayable, 2) . '</span></td>
                  </tr>';
    }

    $html .= '        </tbody>
                    </table>
                    <div class="summary" style="margin-top: 5rem;"> 
                        <p><strong><span style="margin-left: 225px; font-size: 11px; ">PHP ' . number_format($totalAmount, 2) . '</span></strong></p>
                        <br>
                        <p><strong><span style="margin-left: 10px; margin-top: 100px; font-size: 11px;"><b>' . ucwords(NumberToWords::convert($totalAmount)) . ' Pesos Only</b></span></strong></p>
                    </div>
                    <div class="footer">
                        <br>
                        <p style="margin-left: 130px;"> Emma Salinas, Treasurer</p>
                    </div>
                </body>
            </html>';

    // Use Dompdf to generate the PDF
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper([0, 0, 288, 576], 'portrait'); // Set paper size to 4 x 8 inches
    $dompdf->render();

    // Stream the PDF to the browser with a custom name
    return $dompdf->stream('Receipt_' . str_replace(' ', '_', $userName) . '_' . $transaction->id . '.pdf', ['Attachment' => false]);
}

// public function updatePaymentStatus($id)
// {
//     try {
//         $transaction = Transactions::findOrFail($id);
        
//         // Toggle payment status
//         $transaction->payment_status = $transaction->payment_status === 'Unpaid' ? 'Paid' : 'Unpaid';
//         $transaction->save();

//         // Return just the updated payment status directly
//         return response()->json($transaction->payment_status);
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => 'An error occurred while updating payment status.'
//         ], 500);
//     }
// }
// In your Controller

public function updatePaymentStatus($id)
{
    // Find the transaction by ID
    $transaction = Transactions::findOrFail($id);

    // Check if the status is 'Ready for Pickup'
    if ($transaction->status === 'Ready for Pickup') {
        // Only allow updating from 'Unpaid' to 'Paid'
        if ($transaction->payment_status === 'Unpaid') {
            $transaction->payment_status = 'Paid';
            $transaction->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Payment status updated to Paid successfully.');
        }

        // Redirect back with an error message if already paid
        return redirect()->back()->with('error', 'Payment status has already been updated to Paid.');
    }

    // If the status is not 'Ready for Pickup', redirect back with an error message
    return redirect()->back()->with('error', 'The transaction is not ready for pickup.');
}

}