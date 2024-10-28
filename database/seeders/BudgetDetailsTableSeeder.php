<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('budgets_details')->insert([
            [
                'budget_details' => 'Estimated Income'
            ],
            [
                'budget_details' => 'Expenditures : Current Operating Expenditures'
            ],
            [
                'budget_details' => 'Maintenance and other Operating Expenses'
            ],
            [
                'budget_details' => 'Cultural Activities And Other Related Activities'
            ],
            [
                'budget_details' => 'Non-Office Expenditures'
            ]
        ]);
    }
}
