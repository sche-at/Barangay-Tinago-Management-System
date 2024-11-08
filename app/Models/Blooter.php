<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blooter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blooters';
    protected $fillable = [
        'blotters_name',
        'incident_type',
        'location',
        'reported_by',
        'description',
        'incident_date',
        'incident_time'
    ];

    protected $dates = [
        'incident_date',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'incident_date' => 'date',
        'incident_time' => 'datetime:H:i'
    ];
}
