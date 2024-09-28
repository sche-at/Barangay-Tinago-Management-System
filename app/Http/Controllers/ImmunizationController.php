<?php

namespace App\Http\Controllers;
use App\Models\Immunization;
use Illuminate\Http\Request;

class ImmunizationController extends Controller
{
    public static function index() {
        $immunizations = Immunization::query()->get();
    
        return $immunizations;
    }
    public function saveImmunization(Request $request, $vaccine, $recommended_age, $dosage, $venue, $date, $time, $notes) {

        $incomingFields = [
          'vaccine' => $vaccine,
          'recommended_age' => $recommended_age,
           'dosage' => $dosage,
           'venue' => $venue,
            'date' => $date,
            'time'=>$time,
            'notes'=>$notes
         ];
      
        try {
            
           Immunization::create($incomingFields);
      
          return json_encode([
            'status'=> '200',
            'message'=> "Save Successfully"
          ]);
      
        } catch (\Exception $er) {
            dd($er);
        }
      }
      public function destroy(Immunization $immunization) {

   
        try {
            $immunization->delete();
      
            return redirect()->route('admin.immunization')->with("message", "Sched Deleted successfully");
        } catch (\Exception $er) {
            
            dd($er);
        }
      }

    public function immune()
    {
        $immunizations = ImmunizationController::index();
        return view('admin.immunization', compact("immunizations"));
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
