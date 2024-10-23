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
        Schema::create('immunizes', function (Blueprint $table) {
            $table->id();
            $table->string('vaccine'); // Changed to lowercase for consistency
            $table->string('age'); // Changed to lowercase for consistency
            $table->string('dosage'); // Changed to lowercase for consistency
            $table->string('venue'); // Changed to lowercase for consistency
            $table->string('notes'); // Changed to lowercase for consistency
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immunizes');
    }
};
