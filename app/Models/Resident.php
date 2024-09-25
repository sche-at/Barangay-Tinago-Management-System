<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $table = 'residence_info';
    public $timestamps = false; // Disable timestamps


    protected $fillable = [
        'full_name',
        'sex',
        'date_of_birth',
        'age',
        'civil_status',
        'purok',
        'address',
        'educational_level',
        'occupation',
        'employment_status',
        'contact_number',
    ];
    protected $casts = [
        'family_members' => 'array',
    ];
}
