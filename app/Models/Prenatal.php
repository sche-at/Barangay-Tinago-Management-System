<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'venue',
        'schedule_date',
        'schedule_time'
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'schedule_time' => 'datetime:H:i'
    ];
}


