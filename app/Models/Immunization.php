<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;
    protected $table = 'Immunization';
    public $timestamps = false; // Disable timestamps


    protected $fillable = [
        'Blotter_ID',
        'Blotter_Name',
        'Date',
        'Time',
        'Incident_Type',
        'Location',
        'Reported_By',
        'Responding_Officer',
         'Status',
        'Description',
    ];
}
