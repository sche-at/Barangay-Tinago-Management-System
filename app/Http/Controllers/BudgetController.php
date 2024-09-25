<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function budget()
    {
        return view('admin.budget');
    }
    public function expense()
    {
        return view('admin.expense');
    }
}
