<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{
    use HasFactory;

    protected $table = 'prenatal';
    public $timestamps = false; // Disable timestamps


    protected $fillable = [
        'date',
        'time',
        'activity',
        'location',
    ];
}
