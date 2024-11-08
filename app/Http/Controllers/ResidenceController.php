<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'sex' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'civil_status' => 'required|string|max:20',
            'purok' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'educational_level' => 'required|string|max:50',
            'occupation' => 'required|string|max:50',
            'employment_status' => 'required|string|max:20',
            'contact_number' => 'required|string|max:15',
            'family_first_names.*' => 'required|string|max:255',
            'family_middle_names.*' => 'nullable|string|max:255',
            'family_last_names.*' => 'required|string|max:255',
            'family_suffixes.*' => 'nullable|string|max:10',
            'family_relationships.*' => 'required|string|max:255',
            'family_birthdates.*' => 'required|date',
            'family_birthplaces.*' => 'required|string|max:255',
        ]);

        $residence = Residence::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'civil_status' => $request->civil_status,
            'purok' => $request->purok,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'educational_level' => $request->educational_level,
            'occupation' => $request->occupation,
            'employment_status' => $request->employment_status,
            'contact_number' => $request->contact_number,
        ]);

        // Save family members
        foreach ($request->family_first_names as $key => $firstName) {
            FamilyMember::create([
                'residence_id' => $residence->id,
                'first_name' => $firstName,
                'middle_name' => $request->family_middle_names[$key] ?? null,
                'last_name' => $request->family_last_names[$key],
                'suffix' => $request->family_suffixes[$key] ?? null,
                'relationship' => $request->family_relationships[$key],
                'birthdate' => $request->family_birthdates[$key],
                'age' => $request->family_ages[$key],
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'sex' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'civil_status' => 'required|string|max:20',
            'purok' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'educational_level' => 'required|string|max:50',
            'occupation' => 'required|string|max:50',
            'employment_status' => 'required|string|max:20',
            'contact_number' => 'required|string|max:15',
            'family_first_names.*' => 'required|string|max:255',
            'family_middle_names.*' => 'nullable|string|max:255',
            'family_last_names.*' => 'required|string|max:255',
            'family_suffixes.*' => 'nullable|string|max:10',
            'family_relationships.*' => 'required|string|max:255',
            'family_birthdates.*' => 'required|date',
            'family_birthplaces.*' => 'required|string|max:255',
        ]);

        $residence = Residence::findOrFail($id);
        $residence->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'civil_status' => $request->civil_status,
            'purok' => $request->purok,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'educational_level' => $request->educational_level,
            'occupation' => $request->occupation,
            'employment_status' => $request->employment_status,
            'contact_number' => $request->contact_number,
        ]);

        // Update family members if provided
        if ($request->family_first_names) {
            // Optionally, delete existing family members and re-add them
            $residence->familyMembers()->delete(); // Deletes existing family members
            foreach ($request->family_first_names as $key => $firstName) {
                FamilyMember::create([
                    'residence_id' => $residence->id,
                    'first_name' => $firstName,
                    'middle_name' => $request->family_middle_names[$key] ?? null,
                    'last_name' => $request->family_last_names[$key],
                    'suffix' => $request->family_suffixes[$key] ?? null,
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
        $residence = Residence::with('familyMembers')->find($id);

        if (!$residence) {
            return response()->json(['message' => 'Residence not found.'], 404);
        }

        // Soft delete associated family members
        foreach ($residence->familyMembers as $familyMember) {
            $familyMember->delete();
        }

        // Soft delete the residence
        $residence->delete();

        return response()->json(['message' => 'Residence and associated family members archived successfully.'], 200);
    }

    public function archived(Request $request)
{
    $query = Residence::onlyTrashed()
        ->with(['familyMembers' => function ($query) {
            $query->withTrashed();
        }]);

    // Handle search
    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('first_name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('middle_name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('purok', 'LIKE', "%{$searchTerm}%")
              ->orWhere('address', 'LIKE', "%{$searchTerm}%");
        });
    }

    // Get paginated results
    $archivedResidences = $query->orderBy('deleted_at', 'desc')
                               ->paginate(10)
                               ->withQueryString();

    return view('admin.archived_residence_records', compact('archivedResidences'));
}

    public function restore($id)
    {
        $residence = Residence::withTrashed()->find($id);

        if (!$residence) {
            return response()->json(['message' => 'Archived residence not found.'], 404);
        }

        // Restore associated family members
        $residence->familyMembers()->withTrashed()->restore();

        // Restore the residence
        $residence->restore();

        return response()->json(['message' => 'Residence and associated family members restored successfully.'], 200);
    }

    public function forceDelete($id)
    {
        $residence = Residence::withTrashed()->find($id);

        if (!$residence) {
            return response()->json(['message' => 'Residence not found.'], 404);
        }

        // Force delete associated family members
        foreach ($residence->familyMembers()->withTrashed()->get() as $familyMember) {
            $familyMember->forceDelete();
        }

        // Force delete the residence
        $residence->forceDelete();

        return response()->json(['message' => 'Residence and associated family members permanently deleted.'], 200);
    }

    public function showArchived($id)
{
    try {
        $residence = Residence::onlyTrashed()
            ->with(['familyMembers' => function($query) {
                $query->withTrashed();
            }])
            ->findOrFail($id);
            
        // Debug log to check what data is coming from the database
        Log::debug('Family Members:', ['members' => $residence->familyMembers->toArray()]);

        return response()->json([
            'id' => $residence->id,
            'first_name' => $residence->first_name,
            'middle_name' => $residence->middle_name,
            'last_name' => $residence->last_name,
            'suffix' => $residence->suffix,
            'sex' => $residence->sex,
            'date_of_birth' => $residence->date_of_birth,
            'age' => $residence->age,
            'civil_status' => $residence->civil_status,
            'purok' => $residence->purok,
            'address' => $residence->address,
            'place_of_birth' => $residence->place_of_birth,
            'educational_level' => $residence->educational_level,
            'occupation' => $residence->occupation,
            'employment_status' => $residence->employment_status,
            'contact_number' => $residence->contact_number,
            'family_members' => $residence->familyMembers->map(function($member) {
                try {
                    return [
                        'id' => $member->id,
                        'first_name' => $member->first_name,
                        'middle_name' => $member->middle_name,
                        'last_name' => $member->last_name,
                        'suffix' => $member->suffix,
                        'relationship' => $member->relationship ?? 'Unknown',  // Add fallback
                        'birthdate' => $member->birthdate,
                        'birthplace' => $member->birthplace,
                        'age' => $member->age
                    ];
                } catch (\Exception $e) {
                    Log::error('Error mapping family member:', [
                        'member_id' => $member->id,
                        'error' => $e->getMessage()
                    ]);
                    return null;
                }
            })->filter() // Remove any null values from mapping errors
        ]);
    } catch (\Exception $e) {
        Log::error('Failed to load residence details:', [
            'residence_id' => $id,
            'error' => $e->getMessage()
        ]);
        return response()->json(['error' => 'Failed to load residence details: ' . $e->getMessage()], 500);
    }

}


}
