<?php

namespace App\Http\Controllers;

use App\Models\Prenatal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrenatalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'health'){
            $prenatals = Prenatal::all();
        
            // Return the view with the blotters data
            return view('admin.prenatal', compact('prenatals'));
        }else{
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
        try{
        $request->validate([
            'activity' => 'required|string',
            'venue' => 'required|string',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required'
        ]);
     
        $prenatal = Prenatal::create([
            'activity' => $request->activity,
            'venue' => $request->venue,
            'schedule_date' => $request->schedule_date,
            'schedule_time' => $request->schedule_time
        ]);
    
        return response()->json(['message' => 'Prenatal saved successfully!']);
    }catch(Exception $exception){
        Log::info('erro message', [$exception]);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prenatal $prenatal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prenatal $prenatal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prenatal $prenatal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prenatal = Prenatal::findOrFail($id);
        $prenatal->delete();

        return response()->json(['message' => 'Immunization deleted successfully!'], 200);
    }
}
