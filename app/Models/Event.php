<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events'; // Optional if the table name is the plural form of the model name

    protected $fillable = [
        'event_type', 
        'event_venue', 
        'task_assigned'
    ];
}
