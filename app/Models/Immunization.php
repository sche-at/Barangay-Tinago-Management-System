<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;
    protected $table = 'immunization';
    public $timestamps = false; // Disable timestamps


    protected $fillable = [
        'vaccine',
        'recommended_age',
        'dosage',
        'venue',
        'date',
        'time',
        'notes',
    ];
}
