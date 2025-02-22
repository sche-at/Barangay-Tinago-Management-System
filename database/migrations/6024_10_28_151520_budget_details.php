<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets_details', function (Blueprint $table) {
            $table->id();
            $table->string('budget_details');
            $table->timestamps(); // Added timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets_details');
    }
};
