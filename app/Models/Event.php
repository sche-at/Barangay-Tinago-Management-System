<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  // Add this

class Event extends Model
{
    use HasFactory, SoftDeletes;  // Add SoftDeletes here
    
    protected $fillable = [
        'event_type',
        'event_venue',
        'task_assigned',
        'event_date',
        'event_time',
        'status'  // Add status to fillable
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i'
    ];
}
