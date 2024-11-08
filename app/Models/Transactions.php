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
        'totalPayable',
        'mode_payment',
        'status',
        'file_path'
    ];

    // Define the possible status values
    public static $statuses = [
        'Not Ready',
        'Processing',
        'Ready for Pickup',
        'Picked Up'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper method to check if status transition is valid
    public function canTransitionTo($newStatus)
    {
        $validTransitions = [
            'Not Ready' => ['Processing'],
            'Processing' => ['Ready for Pickup'],
            'Ready for Pickup' => ['Picked Up'],
            'Picked Up' => []
        ];

        return in_array($newStatus, $validTransitions[$this->status] ?? []);
    }
}