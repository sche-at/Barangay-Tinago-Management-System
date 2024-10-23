<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'userType' => 'required|string|max:255',
            'contact' => 'required|string|max:255'
        ]);

        $user = new User();
        $user->name = $request->fullName;
        $user->username = $request->username;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->password = Hash::make('btms@2024');
        $user->user_type = $request->userType;
        $user->save();

        return response()->json(['message' => 'User saved successfully!']); // Return success message
    }

    public function destroy($id)
    {
        $User = User::findOrFail($id);
        $User->delete();

        return response()->json(['message' => 'User deleted successfully!'], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('btms@2024');
        $user->update();

        return response()->json(['message' => 'Users password successfully reset']);
    }
}
