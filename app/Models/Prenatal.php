<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{
    use HasFactory;

    protected $table = 'prenatals'; // Optional if the table name is the plural form of the model name

    protected $fillable = [
        'activity', 
        'venue'
    ];
}
