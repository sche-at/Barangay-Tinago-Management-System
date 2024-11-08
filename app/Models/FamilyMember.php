<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'residence_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'relationship',
        'birthdate',
        'birthplace',
        'age',
    ];

    public function residence()
    {
        return $this->belongsTo(Residence::class, 'residence_id');
    }
}
