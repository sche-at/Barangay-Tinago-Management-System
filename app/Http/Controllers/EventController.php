<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'event'){
            $events = Event::all();
            // Return the view with the blotters data
            return view('admin.events', compact('events'));
            // return view('pages.events');
        }else{
            return redirect(route('dashboard'));
        }        
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
    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required|string|max:255',
            'event_venue' => 'required|string|max:255',
            'task_assigned' => 'required|string|max:255',
        ]);

        // Create a new Blotter entry
        $event = new Event();
        $event->event_type = $request->event_type;
        $event->event_venue = $request->event_venue;
        $event->task_assigned = $request->task_assigned;
        $event->save();

        return response()->json(['message' => 'Event saved successfully!']); // Return success message
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully!'], 200);
    }
}
