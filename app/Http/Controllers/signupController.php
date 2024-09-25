<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SignupController extends Controller
{


   public function create(Request $request)
   {
       // Validate the incoming request data
       $incomingFields = $request->validate([
           'Full_Name' => ['required', 'min:3', 'max:50'],
           'Phone_Number' => ['required', 'min:11'],
           'Email' => ['required', 'min:5', 'email', Rule::unique('datas', 'Email')],
           'Username' => ['required'],
           'Password' => ['required', 'min:6', 'max:10']
       ]);
   
       // Hash the password before storing
       $incomingFields['Password'] = bcrypt($incomingFields['Password']);
   
       // Create the new user in the database
       Data::create($incomingFields);
   
       // Redirect to the sign-in page after account creation
       return view('/signin'); // Ensure this route shows the sign-in form
   }
   
    public function register()
    {
        return view('signup');
    }
}
