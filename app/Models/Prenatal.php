<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{
    use HasFactory;

    protected $table = 'Prenatal';
    public $timestamps = false; // Disable timestamps


    protected $fillable = [
        'Date',
        'Time',
        'Activity',
        'Location',
    ];
}
