<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{   public function base()
    {
        return view('clients.base');
    }
    public function eventannounce()
    {
        return view('clients.eventannounce');
        
    }
    public function healthannounce()
    {
        return view('clients.healthannounce');
    }
    public function history()
    {
        return view('clients.history');

    }
    public function complaints()
    {
        return view('clients.complaints');
    }
}
