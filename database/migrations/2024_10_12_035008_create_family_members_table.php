<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('residence_id')->constrained('residences')->onDelete('cascade'); // Foreign key referencing residences table
            $table->string('first_name'); // Family member's first name
            $table->string('middle_name')->nullable(); // Family member's middle name
            $table->string('last_name'); // Family member's last name
            $table->string('suffix')->nullable(); // Family member's suffix
            $table->string('relationship'); // Relationship to the resident
            $table->date('birthdate')->nullable(); // Birthdate, nullable if not provided
            $table->string('birthplace')->nullable(); // Birthplace, nullable if not provided
            $table->integer('age')->nullable(); // Age, calculated based on birthdate
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members'); // Drop the family_members table
    }
}