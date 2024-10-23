<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // Get authenticated user
       
        // Example of returning to a view with username and email
        
        return view('admin.aboutus');

        // captain - all access
        // health - health mangement only
        // event - event management only
        // treasurer - financial management only
        // secretary - resident
    }


    public function profile()
    {

        return view('admin.profile');
    }

    public function changepassword()
    {

        return view('admin.changepassword');
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
    public function updatePassword(Request $request)
    {
            // Validate the request
            $request->validate([
                'currentPassword' => 'required|string',
                'newPassword' => 'required|string|min:8|confirmed',
            ]);
    
            // Check if the current password matches
            if (!Hash::check($request->currentPassword, Auth::user()->password)) {
                throw ValidationException::withMessages(['currentPassword' => 'Current password is incorrect.']);
            }

            // Update the password
            $user = Auth::user();
            $user->password = Hash::make($request->newPassword);
            $user->save();
    
            return redirect()->route('dashboard.changepassword')->with('status', 'Password changed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
