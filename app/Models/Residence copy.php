<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'first_name', 
        'sex', 
        'date_of_birth', 
        'age', 
        'civil_status', 
        'purok', 
        'address', 
        'place_of_birth', 
        'educational_level', 
        'occupation', 
        'employment_status', 
        'contact_number'
    ];

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class,'user_id');
    }
}
