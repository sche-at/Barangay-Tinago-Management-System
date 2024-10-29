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

    public function history()
    {
        $user = Auth::user();

        if($user->user_type == 'resident'){
            $transactions = Transactions::with('user')
            ->where('user_id', $user->id) // Filter by the authenticated user's id
            ->get();
            return view('resident.history', compact('transactions'));
        } else {
            return redirect(route('dashboard'));
        }
    }

    public function report()
    {
        $user = Auth::user();

        if($user->user_type == 'treasurer' || $user->user_type == 'captain'){
            $transactions = Transactions::with('user')->get();
            return view('admin.report', compact('transactions'));
        } else {
            return redirect(route('dashboard'));
        }
    }

    public function export()
    {

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

        // Check if a file is uploaded for GCash payment and store it
        if ($request->mode_payment === 'GCash' && $request->hasFile('gcash_file')) {
            $filePath = $request->file('gcash_file')->store('assets/uploads', 'public');
        }

        // Loop through each request type and purpose to create separate transaction entries
        foreach ($request->request_type as $index => $type) {
            $transactions = new Transactions();
            $transactions->user_id = $user->id;
            $transactions->trans_type = $type;
            $transactions->purok = $request->purok;
            $transactions->purpose = $request->purpose[$index];
            $transactions->mode_payment = $request->mode_payment;

            // Assign file path if available
            if ($filePath) {
                $transactions->file_path = $filePath;
            }

            $transactions->save();
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
}
