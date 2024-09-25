<?php

namespace App\Http\Controllers;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
    public function residence()
    {
        return view('admin.residence');
    }

    public function finance()
    {
        return view('admin.finance');
    }

    public function event()
    {
      //  $EventController = new EventController();
        $events = EventController::index();
        return view('admin.event', compact('events'));
    }

    public function health()
    {
        return view('admin.immunization');
    }
    public function out()
    {
        return view('admin.signin');
    }
}
