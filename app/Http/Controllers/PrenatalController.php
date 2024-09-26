<?php

namespace App\Http\Controllers;

use App\Models\Prenatal;
use Illuminate\Http\Request;

class PrenatalController extends Controller
{
    public static function index() {
        $prenatals = Prenatal::query()->get();
    
        return $prenatals;
}

public function savePrenatal(Request $request, $date, $time, $location, $activity) {

    $incomingFields = [
      'date' => $date,
      'time' => $time,
        'location' => $location,
        'activity' => $activity
     ];
  
    try {
        
       Prenatal::create($incomingFields);
  
      return json_encode([
        'status'=> '200',
        'message'=> "Save Successfully"
      ]);
  
    } catch (\Exception $er) {
        dd($er);
    }
  }
  public function destroy(Prenatal $prenatal) {

   
    try {
        $prenatal->delete();
  
        return redirect()->route('admin.prenatal')->with("message", "Event Deleted successfully");
    } catch (\Exception $er) {
        
        dd($er);
    }
  }
  } 