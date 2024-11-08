<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    
        if($user->user_type == 'treasurer' || $user->user_type == 'captain'){
            $transactions = Transactions::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
                
            // Group transactions by status
            $notReadyTransactions = $transactions->where('status', 'Not Ready');
            $processingTransactions = $transactions->where('status', 'Processing');
            $readyTransactions = $transactions->where('status', 'Ready for Pickup');
            $pickedUpTransactions = $transactions->where('status', 'Picked Up');
    
            return view('admin.report', compact(
                'transactions', 
                'notReadyTransactions',
                'processingTransactions',
                'readyTransactions',
                'pickedUpTransactions'
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'request_type' => 'required|array',
            'request_type.*' => 'required|string',
            'purok' => 'required|string',
            'purpose' => 'required|array',
            'purpose.*' => 'required|string',
            'mode_payment' => 'required|string',
        ]);

        $user = Auth::user();
        $filePath = null;
        $errors = [];

        // Check if a file is uploaded for GCash payment and store it
        if ($request->mode_payment === 'GCash' && $request->hasFile('gcash_file')) {
            $filePath = $request->file('gcash_file')->store('assets/uploads', 'public');
        }

        // Loop through each request type and purpose to create separate transaction entries
        foreach ($request->request_type as $index => $type) {
            // Check for existing requests of this type by the user on the current date
            $requestCountToday = Transactions::where('user_id', $user->id)
                ->where('trans_type', $type)
                ->whereDate('created_at', now()->toDateString())
                ->count();

            if ($requestCountToday >= 2) {
                $errors[] = "You have already submitted two requests for {$type} today.";
                continue; // Skip saving this request type if limit reached
            }

            // Save the request if the limit is not reached
            $transactions = new Transactions();
            $transactions->user_id = $user->id;
            $transactions->trans_type = $type;
            $transactions->purok = $request->purok;
            $transactions->purpose = $request->purpose[$index];
            $transactions->totalPayable = $request->totalPayable;
            $transactions->mode_payment = $request->mode_payment;
            $transactions->status = 'Not Ready'; // Set initial status
            // Assign file path if available
            if ($filePath) {
                $transactions->file_path = $filePath;
            }

            $transactions->save();
        }

        // If there are errors, redirect back with errors
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        return redirect()->back()->with('success', 'Your requests have been successfully submitted.');
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


public function generateReport()
{
    $user = Auth::user();

    // Check if user is authorized to view the report
    if (!in_array($user->user_type, ['treasurer', 'captain'])) {
        return redirect(route('dashboard'));
    }

    // Get only completed transactions
    $transactions = Transactions::with('user')
        ->where('status', 'Picked Up')  // Only get completed transactions
        ->orderBy('created_at', 'desc')
        ->get();

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
    
}