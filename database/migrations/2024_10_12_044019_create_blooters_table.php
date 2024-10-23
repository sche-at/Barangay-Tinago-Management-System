<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('blooters', function (Blueprint $table) {
            $table->id();
            $table->string('blotters_name');
            $table->string('incident_type');
            $table->string('location');
            $table->string('reported_by');
            $table->string('responding_officer')->nullable();
            $table->string('status')->nullable();
            $table->text('description'); // Use text type for longer descriptions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('blooters'); // Use snake_case for table names
    }
};
