<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'relationship',
        'birthdate',
        'birthplace',
    ];

    public function residence()
    {
        return $this->belongsTo(Residence::class,'id');
    }
}
