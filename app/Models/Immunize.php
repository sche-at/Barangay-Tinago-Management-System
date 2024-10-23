<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunize extends Model
{
    use HasFactory;

    protected $table = 'immunizes'; // Optional if the table name is the plural form of the model name

    protected $fillable = [
        'vaccine', 
        'age', 
        'dosage',
        'venue',
        'notes'
    ];
}
