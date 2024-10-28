<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budget_details_values', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
    
            // Define foreign keys with proper constraints
            $table->foreignId('budget_header_id')->constrained('budgets_header')->onDelete('cascade');
            $table->foreignId('budget_details_id')->constrained('budget_details')->onDelete('cascade');
    
            $table->string('details_value');
            $table->decimal('amount', 15, 2); // Use decimal for amounts to avoid rounding issues
    
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_details_values');
    }
};
