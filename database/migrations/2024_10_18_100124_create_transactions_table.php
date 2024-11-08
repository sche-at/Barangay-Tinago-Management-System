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
            $table->string('trans_type');
            $table->string('purpose');
            $table->string('purok');
            $table->decimal('totalPayable', 10, 2);
            $table->string('mode_payment');
            $table->string('file_path')->nullable();
            $table->string('status')->default('not ready'); // Add this line
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
