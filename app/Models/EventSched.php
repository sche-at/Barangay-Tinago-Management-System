<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSched extends Model
{
    use HasFactory;
    protected $table = 'event_sched';
    public $timestamps = false; // Disable timestamps


    protected $fillable = [
        'type_of_event',
        'date_and_venue',
        'tasks_assigned',
    ];


}
