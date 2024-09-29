<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlottersRecord;

class BlottersController extends Controller
{
    public static function index(){
        $blottersrecords = BlottersRecord::query()->get();

        return $blottersrecords;
    }
    public function saveBlottersRecord(Request $request, $blotters_ID, $blotters_name, $date, $time, $incident_type, $location, $reported_by, $responding_officer, $status, $description){
            

        $incomingFields = [
            'blotters_ID' =>$blotters_ID,
            'blotters_name' =>$blotters_name,
            'date' => $date,
            'time' => $time,
            'incident_type' => $incident_type,
            'location' => $location,
            'reported_by' => $reported_by,
            'responding_officer' => $responding_officer,
            'status' => $status,
            'description' => $description
        ];

        try {
            BlottersRecord::create($incomingFields);

            return json_encode ([
                'status' => '200',
                'message' => "Save Succesfully"
            ]);
        } catch (\Exception $er){
            return json_encode ([
                 
                'message' => $er
            ]);
        }
        }
        public function destroy (BlottersRecord $blottersrecord){
            
            try{
                $blottersrecord->delete();

                return redirect()->route('admin.blotters')->with("message", "Event Deleted succesfully");
            } catch (\Exception $er) {
        
                dd($er);
            }
            }
        }
    
