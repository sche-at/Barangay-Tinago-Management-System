<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlottersRecord extends Model
{
    use HasFactory;

    protected $table = 'blotters_record';

    public $timestamp = false;


    protected $fillable = [ 
    'blotters_ID',
    'blotters_name',
    'date',
    'time',
    'incident_type',
    'location',
    'reported_by',
    'responding_officer',
    'status',
    'description',
    ];
}
