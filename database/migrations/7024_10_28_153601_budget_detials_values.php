<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_details_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_header_id')->constrained('budgets_header')->onDelete('cascade');
            $table->foreignId('budget_details_id')->constrained('budgets_details')->onDelete('cascade');
            $table->string('details_value');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_details_values');
    }
};