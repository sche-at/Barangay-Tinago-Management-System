<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blooter extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default
    protected $table = 'blooters'; // Optional if the table name is the plural form of the model name

    // Specify the fillable properties for mass assignment
    protected $fillable = [
        'blotters_name',
        'incident_type',
        'location',
        'reported_by',
        'description',
    ];

    // Optionally, you can define any relationships if needed
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}
