<?php

namespace App\Http\Controllers;

use App\Models\Immunize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ImmunizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        if ($user->user_type == 'captain' || $user->user_type == 'health') {
            $immunizes = Immunize::all();
            return view('admin.immunization', compact('immunizes'));
        } else {
            return redirect(route('immunize')); // Updated to match route name
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Log::info("data", [$request->all()]);
    Log::info('date', [$request->date]);
    Log::info('time', [$request->time]);

    $request->validate([
        'vaccine' => 'required|string|max:255',
        'age' => 'required|integer|min:0|max:120',
        'dosage' => 'required|string|max:255',
        'venue' => 'required|string|max:255',
        'notes' => 'nullable|string|max:255', // Made notes optional for testing
        'date' => 'required|string|max:20',
        'time' => 'required|string|max:10',
    ]);

    $imunizationDate = $request->date;
    Log::info('date', [$request->imunizationDate]);

    // Create a new Immunize entry
    $immunize = new Immunize();
    $immunize->vaccine = $request->vaccine;
    $immunize->age = $request->age;
    $immunize->dosage = $request->dosage;
    $immunize->venue = $request->venue;
    $immunize->notes = $request->notes;
    $immunize->date = $request->date;
    $immunize->time = $request->time;
    
    $immunize->save();

    return response()->json(['message' => 'Immunization saved successfully!']);
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

    // Add edit and update methods if needed

    public function archived()
{
    $user = Auth::user();

    if ($user->user_type == 'captain' || $user->user_type == 'health') {
        $archivedImmunizes = Immunize::onlyTrashed()->get();
        return view('admin.archived_immunizations', compact('archivedImmunizes'));
    } else {
        return redirect(route('dashboard'));
    }
}

public function restore($id)
{
    $immunize = Immunize::withTrashed()->findOrFail($id);
    $immunize->restore();

    return response()->json(['message' => 'Immunization restored successfully!'], 200);
}

public function forceDelete($id)
{
    $immunize = Immunize::withTrashed()->findOrFail($id);
    $immunize->forceDelete();

    return response()->json(['message' => 'Immunization permanently deleted successfully!'], 200);
}
}
