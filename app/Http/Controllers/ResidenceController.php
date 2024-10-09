<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\BlottersRecord;
use Illuminate\Http\Request;

class ResidenceController extends Controller
{
    public function record() 
    {
        $blottersrecords = BlottersRecord::query()->get();
        return view('admin.blotters', compact('blottersrecords'));
    }

    public function store(Request $request)
    {
       try{
        // Validate the incoming request data
        $incomingFields = $request->validate([
            'full_name' => ['required','string','max:255'],
            'sex' => ['required','string'],
            'date_of_birth' => ['required', 'date'],
            'age' => ['required','integer'],
            'civil_status' => ['required','string'],
            'purok'=>['required','integer'],
            'address' => ['required','string','max:255'],
            'educational_level' => ['required','string'],
            'occupation' => ['nullable','string','max:255'],
            'employment_status' => ['required','string'],
            'contact_number' => ['required','string','max:15'],
            'family_members' => ['nullable','array','max:255'],
        ]);
   
        // Create a new Resident instance and save the validated data
        $resident = Resident::create($incomingFields);
         // Populate the family_members column using the received array
         $resident->family_members = $request->input('family_members');
         $resident->save();
    
        // Redirect or return a response
        return redirect()->route('admin.list')->with('success', 'Resident information saved successfully.');
    }catch(\Exception $ex){
      dd($ex);
    }
}

public function list()
{
    $residents = Resident::all(); // Fetch all resident records
    return view('admin.list', compact('residents'));
}
public function edit($id)
{
    $resident = Resident::findOrFail($id); // Fetch resident data based on ID
    return view('admin.update', compact('resident')); // Pass data to the view
}

public function update(Request $request, $id)
{
    $resident = Resident::findOrFail($id); // Find the resident

    // Validate the incoming request data
    $incomingFields = $request->validate([
        'full_name' => ['required', 'string', 'max:255'],
        'sex' => ['required', 'string'],
        'date_of_birth' => ['required', 'date'],
        'age' => ['required', 'integer'],
        'civil_status' => ['required', 'string'],
        'purok' => ['required', 'integer'],
        'address' => ['required', 'string', 'max:255'],
        'educational_level' => ['required', 'string'],
        'occupation' => ['nullable', 'string', 'max:255'],
        'employment_status' => ['required', 'string'],
        'contact_number' => ['required', 'string', 'max:15'],
        'family_members' => ['nullable', 'array', 'max:255'],
    ]);

    // Update the resident with validated data
    $resident->update($incomingFields);
    // Populate the family_members column using the received array
    $resident->family_members = $request->input('family_members');
    $resident->save();

    return redirect()->route('admin.list')->with('success', 'Resident information updated successfully.');
}
public function destroy($id)
{
    $resident = Resident::findOrFail($id);
    $resident->delete();

    return response()->json(['success' => true]);
}

    
}
