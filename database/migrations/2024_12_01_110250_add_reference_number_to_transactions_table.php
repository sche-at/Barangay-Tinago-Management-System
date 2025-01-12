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
    Schema::table('transactions', function (Blueprint $table) {
        $table->string('reference_number')->nullable();
    });
}

public function down(): void
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn('reference_number');
    });
}

};
