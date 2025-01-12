<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name', 
        'last_name',
        'suffix',
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

    public function getFullNameAttribute()
    {
        $fullName = $this->first_name;
        if ($this->middle_name) {
            $fullName .= ' ' . $this->middle_name;
        }
        $fullName .= ' ' . $this->last_name;
        if ($this->suffix) {
            $fullName .= ' ' . $this->suffix;
        }
        return $fullName;
    }

    public function getAgeAttribute()
    {
        return $this->calculateAge($this->date_of_birth);
    }

    protected function calculateAge($birthDate)
    {
        $today = date('Y-m-d');
        $birthDate = date('Y-m-d', strtotime($birthDate));
        $diff = date_diff(date_create($birthDate), date_create($today));
        return $diff->y;
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'residence_id');
    }
    public function showArchived($id)
{
    $residence = Residence::onlyTrashed()
        ->with('familyMembers')
        ->findOrFail($id);
    return response()->json($residence);
}

}
