<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetDetailsValue extends Model
{
    protected $fillable = [
        'budget_header_id',
        'budget_details_id',
        'details_value',
        'amount'
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_header_id');
    }

    public function budgetDetails()
    {
        return $this->belongsTo(BudgetsDetails::class, 'budget_details_id');
    }
}