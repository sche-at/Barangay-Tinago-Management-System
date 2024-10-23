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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('sex');
            $table->date('date_of_birth');
            $table->unsignedInteger('age');
            $table->string('civil_status');
            $table->unsignedInteger('purok');
            $table->string('address');
            $table->string('educational_level');
            $table->string('occupation');
            $table->string('employment_status');
            $table->string('contact_number');
            // Move timestamps to the end
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
        Schema::dropIfExists('residences');
    }
};
