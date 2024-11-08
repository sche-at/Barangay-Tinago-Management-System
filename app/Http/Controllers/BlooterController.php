<?php

namespace App\Http\Controllers;

use App\Models\Blooter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'secretary'){
            $bloters = Blooter::all();
        
            // Return the view with the blotters data
            return view('admin.blooters', compact('bloters'));
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
            'blotters_name' => 'required|string|max:255',
            'incident_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'reported_by' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'incident_date' => 'required|date',  // Add validation for date
            'incident_time' => 'required'        // Add validation for time
        ]);

        // Create a new Blotter entry
        $blooter = new Blooter();
        $blooter->blotters_name = $request->blotters_name;
        $blooter->incident_type = $request->incident_type;
        $blooter->location = $request->location;
        $blooter->reported_by = $request->reported_by;
        $blooter->description = $request->description;
        $blooter->incident_date = $request->incident_date;  // Add incident date
        $blooter->incident_time = $request->incident_time;  // Add incident time
        $blooter->save();

        return response()->json(['message' => 'Blotter saved successfully!']); // Return success message
    }

    /**
     * Display the specified resource.
     */
    public function show(Blooter $blooter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blooter $blooter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blooter $blooter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the blotter by ID and delete it
        $blooter = Blooter::findOrFail($id);
        $blooter->delete();

        return response()->json(['message' => 'Blotter deleted successfully!'], 200);
    }


    public function archived()
    {
        $user = Auth::user();
    
        if($user->user_type == 'captain' || $user->user_type == 'secretary'){
            $archivedBlooters = Blooter::onlyTrashed()->get();
            return view('admin.archived_blooters', compact('archivedBlooters')); // Changed from archived_blotters to archived_blooters
        }else{
            return redirect(route('dashboard'));
        }
    }

    public function restore($id)
    {
        $blotter = Blooter::onlyTrashed()->findOrFail($id);
        $blotter->restore();

        return response()->json(['message' => 'Blotter restored successfully!']);
    }

    public function forceDelete($id)
    {
        $blotter = Blooter::onlyTrashed()->findOrFail($id);
        $blotter->forceDelete();

        return response()->json(['message' => 'Blotter permanently deleted!']);
    }

}
