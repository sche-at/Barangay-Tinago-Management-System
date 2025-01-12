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
    Schema::table('family_members', function (Blueprint $table) {
        $table->string('contact_number', 15)->nullable()->after('family_relationship'); // Add contact number after family_relationship
        $table->integer('purok')->nullable()->after('contact_number'); // Add purok after contact_number
    });
}

public function down(): void
{
    Schema::table('family_members', function (Blueprint $table) {
        $table->dropColumn('contact_number');
        $table->dropColumn('purok');
    });
}

    
};
