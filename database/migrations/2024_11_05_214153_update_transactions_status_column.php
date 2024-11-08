<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Modify the status column to update the default value and set existing records
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status 
                ENUM('Not Ready', 'Processing', 'Ready for Pickup', 'Picked Up') 
                DEFAULT 'Not Ready'");
            
            // Update existing 'not ready' values to proper case
            DB::table('transactions')
                ->where('status', 'not ready')
                ->update(['status' => 'Not Ready']);
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Revert back to original status format if needed
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status 
                VARCHAR(255) DEFAULT 'not ready'");
        });
    }
};