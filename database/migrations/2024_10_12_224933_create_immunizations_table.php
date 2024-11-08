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
        Schema::create('immunizations', function (Blueprint $table) {
            $table->id();
            $table->string('vaccine'); // Vaccine name
            $table->integer('age'); // Age as integer
            $table->string('dosage'); // Dosage details
            $table->string('venue'); // Venue name
            $table->string('notes')->nullable(); // Notes field (optional)
            $table->date('date'); // Date of immunization
            $table->time('time'); // Time of immunization
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immunizationss');
    }
};
