<?php

namespace App\Http\Controllers;
use App\Http\Controllers\PrenatalControl;
use Illuminate\Http\Request;

class ImmunizationController extends Controller
{
    public function immune()
    {
        return view('admin.immunization');
    }
    public function natal()
    {
        $prenatals = PrenatalController::index();
        return view('admin.prenatal', compact("prenatals"));
    }
    public function referall()
    {
        return view('admin.referral');
    }

}
