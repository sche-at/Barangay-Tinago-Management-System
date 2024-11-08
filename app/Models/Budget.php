<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets_header';
    
    protected $fillable = ['title_plan'];

    public function budgetDetailsValues()
    {
        return $this->hasMany(BudgetDetailsValue::class, 'budget_header_id');
    }
}