<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetsDetails extends Model
{
    protected $table = 'budgets_details';
    
    protected $fillable = ['budget_details'];

    public function budgetDetailsValues()
    {
        return $this->hasMany(BudgetDetailsValue::class, 'budget_details_id');
    }
}