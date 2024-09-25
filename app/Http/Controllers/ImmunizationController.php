<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImmunizationController extends Controller
{
    public function immune()
    {
        return view('admin.immunization');
    }
    public function natal()
    {
        return view('admin.prenatal');
    }
    public function referall()
    {
        return view('admin.referral');
    }

}
