<?php

namespace App\Http\Controllers;

use App\Models\Immunize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImmunizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'health'){
            $immunizes = Immunize::all();
        
            // Return the view with the blotters data
            return view('admin.immunization', compact('immunizes'));
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
        $request->validate([
            'vaccine' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:120',
            'dosage' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'notes' => 'required|string|max:255',
        ]);

        // Create a new Blotter entry
        $immunize = new Immunize();
        $immunize->vaccine = $request->vaccine;
        $immunize->age = $request->age;
        $immunize->dosage = $request->dosage;
        $immunize->venue = $request->venue;
        $immunize->notes = $request->notes;
        $immunize->save();

        return response()->json(['message' => 'Immunization saved successfully!']); // Return success message
    }

    /**
     * Display the specified resource.
     */
    public function show(Immunize $immunize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Immunize $immunize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Immunize $immunize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $immunize = Immunize::findOrFail($id);
        $immunize->delete();

        return response()->json(['message' => 'Immunization deleted successfully!'], 200);
    }
}
