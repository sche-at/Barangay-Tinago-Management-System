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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->String('trans_type');
            $table->String('purpose');
            $table->String('purok');
            $table->String('mode_payment');
            $table->String('file_path')->nullable();
            $table->timestamps();

             // Set up the foreign key constraint
             $table->foreign('user_id')
             ->references('id')
             ->on('users')
             ->onDelete('cascade'); // Delete comments when user is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
