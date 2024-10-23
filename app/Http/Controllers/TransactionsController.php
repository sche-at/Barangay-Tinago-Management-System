<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
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
            return view('admin.report');
        } else {
            return redirect(route('dashboard'));
        }
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
            'request_type' => 'required|string',
            'purok' => 'required|string',
            'purpose' => 'required|string',
        ]);

        $user = Auth::user();

        $transactions = new Transactions();
        $transactions->user_id = $user->id;
        $transactions->trans_type = $request->request_type;
        $transactions->purpose = $request->purok;
        $transactions->purok = $request->purpose;
        $transactions->mode_payment = $request->mode_payment;

        if ($request->hasFile('gcash_file')) {
            // Store the file in the 'uploads/gcash_files' directory
            $filePath = $request->file('gcash_file')->store('assets/uploads', 'public');
            
            // Save the file path in the database
            $transactions->file_path = $filePath;
        }

        $transactions->save();

        return redirect()->back()->with('success', 'Your request of ' . $request->request_type . ' successfully submitted.');
        
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