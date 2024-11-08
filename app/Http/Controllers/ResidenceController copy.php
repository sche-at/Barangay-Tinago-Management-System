<?php

namespace App\Http\Controllers;
 
use App\Models\Residence;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the residences.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'secretary'){
            return view('admin.addresidence');
        }else{
            return redirect(route('dashboard'));
        }
    }

    /**
     * Show the residences.
     */
    public function residenceview()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'secretary'){
            $residences = Residence::with('familyMembers')->get(); // Eager loading family members
            return view('admin.residenceview', compact('residences'));
        }else{
            return redirect(route('dashboard'));
        }
    }
    /**
     * Store a newly created residence.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'sex' => 'required|string',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'civil_status' => 'required|string',
            'purok' => 'required|integer',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'educational_level' => 'required|string',
            'occupation' => 'required|string|max:255',
            'employment_status' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'family_members.*' => 'required|string|max:255',
            'family_relationships.*' => 'required|string|max:255',
            'family_birthdates.*' => 'required|date',
            'family_birthplaces.*' => 'required|string|max:255',
        ]);

        $residence = Residence::create([
            'full_name' => $request->full_name,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'age' => $request->age,
            'civil_status' => $request->civil_status,
            'purok' => $request->purok,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'educational_level' => $request->educational_level,
            'occupation' => $request->occupation,
            'employment_status' => $request->employment_status,
            'contact_number' => $request->contact_number,
            'family_members' => '', // Adjust as needed
        ]);

        // Save family members
        foreach ($request->family_members as $key => $memberName) {
            FamilyMember::create([
                'user_id' => $residence->id, // Assuming you're using authentication
                'name' => $memberName,
                'relationship' => $request->family_relationships[$key],
                'birthdate' => $request->family_birthdates[$key],
                'birthplace' => $request->family_birthplaces[$key],
            ]);
        }

        return redirect()->back()->with('success', 'Residence information saved successfully!');
    }

    /**
     * Display the specified residence.
     */
    public function show($id)
    {
        $residence = Residence::with('familyMembers')->findOrFail($id);
        return response()->json($residence);
    }

    /**
     * Update the specified residence.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'sex' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',
            'civil_status' => 'required|string|max:20',
            'purok' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'educational_level' => 'required|string|max:50',
            'occupation' => 'required|string|max:50',
            'employment_status' => 'required|string|max:20',
            'contact_number' => 'required|string|max:15',
            'family_members' => 'array',
            'family_relationships' => 'array',
            'family_birthdates' => 'array',
            'family_birthplaces' => 'array',
        ]);

        $residence = Residence::findOrFail($id);
        $residence->update($request->except(['family_members', 'family_relationships', 'family_birthdates', 'family_birthplaces']));

        // Update family members if provided
        if ($request->family_members) {
            // Optionally, delete existing family members and re-add them
            $residence->familyMembers()->delete(); // Deletes existing family members
            foreach ($request->family_members as $key => $memberName) {
                FamilyMember::create([
                    'user_id' => $residence->id,
                    'name' => $memberName,
                    'relationship' => $request->family_relationships[$key] ?? null,
                    'birthdate' => $request->family_birthdates[$key] ?? null,
                    'birthplace' => $request->family_birthplaces[$key] ?? null,
                ]);
            }
        }

        return response()->json(['message' => 'Residence updated successfully']);
    }

    /**
     * Remove the specified residence.
     */
    public function destroy($id)
    {
        // Find the residence by ID
        $residence = Residence::with('familyMembers')->find($id);

        // Check if the residence exists
        if (!$residence) {
            return response()->json(['message' => 'Residence not found.'], 404);
        }

        // Delete associated family members
        foreach ($residence->familyMembers as $familyMember) {
            $familyMember->delete();
        }

        // Delete the residence
        $residence->delete();

        // Return a success response
        return response()->json(['message' => 'Residence and associated family members deleted successfully.'], 200);
    }
}
