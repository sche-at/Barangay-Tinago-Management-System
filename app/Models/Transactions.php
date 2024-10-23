<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trans_type',
        'purpose',
        'purok',
        'mode_payment',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
