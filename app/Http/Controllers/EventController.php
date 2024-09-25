<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSched; // Assume this is your model for the event_sched table
use Exception;
use Illuminate\Support\Facades\Log;
class EventController extends Controller
{
  public static function index() {
    $events = EventSched::query()->get();

    return $events;
}

public function saveEvent(Request $request, $type_of_event, $date_and_venue, $tasks_assigned) {
  
  $incomingFields = [
    'type_of_event' => $type_of_event,
       'date_and_venue' => $date_and_venue,
      'tasks_assigned' => $tasks_assigned
      // Assuming tasks_assigned is an array
   ];

  try {
      // Create a new EventSched instance and save the validated data
     EventSched::create($incomingFields);

    return json_encode([
      'status'=> '200',
      'message'=> "Save Successfully"
    ]);

  } catch (\Exception $er) {
      dd($er);
  }
}

public function destroy(EventSched $eventSched) {

  //dd($eventSched->id);
  try {
      $eventSched->delete();

      return redirect()->route('admin.event')->with("message", "Event Deleted successfully");
  } catch (\Exception $er) {
      // Log the error or display a user-friendly message
      dd($er);
  }
}
}
