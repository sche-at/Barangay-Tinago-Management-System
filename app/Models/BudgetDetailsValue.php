<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetDetailsValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_header_id',
        'budget_details_id',
        'details_value',
        'amount'
    ];
}
