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
            $events = Event::whereNull('deleted_at')->get(); // Only get active events
            return view('admin.events', compact('events'));
        }else{
            return redirect(route('dashboard'));
        }        
    }

    /**
     * Display archived events.
     */
    public function archived()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'event'){
            $events = Event::onlyTrashed()->get();
            return view('admin.archived_events', compact('events'));
        }else{
            return redirect(route('dashboard'));
        }
    }

    /**
     * Archive (soft delete) the specified event.
     */
    public function archive($id)
    {
        $user = Auth::user();
        if($user->user_type != 'captain' && $user->user_type != 'event'){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event = Event::findOrFail($id);
        $event->status = 'archived';
        $event->save();
        $event->delete(); // This triggers soft delete

        return response()->json(['message' => 'Event archived successfully!']);
    }

    /**
     * Restore a soft-deleted event.
     */
    public function restore($id)
    {
        $user = Auth::user();
        if($user->user_type != 'captain' && $user->user_type != 'event'){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event = Event::withTrashed()->findOrFail($id);
        $event->status = 'active';
        $event->save();
        $event->restore();

        return response()->json(['message' => 'Event restored successfully!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required|string',
            'event_venue' => 'required|string',
            'task_assigned' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required'
        ]);
    
        $event = Event::create([
            'event_type' => $request->event_type,
            'event_venue' => $request->event_venue,
            'task_assigned' => $request->task_assigned,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'status' => 'active'
        ]);
    
        return response()->json(['message' => 'Event saved successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->user_type != 'captain' && $user->user_type != 'event'){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event = Event::withTrashed()->findOrFail($id);
        $event->forceDelete(); // Permanently delete

        return response()->json(['message' => 'Event permanently deleted successfully!'], 200);
    }
}