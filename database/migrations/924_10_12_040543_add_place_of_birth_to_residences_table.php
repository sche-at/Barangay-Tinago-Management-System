<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlaceOfBirthToResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('residences', function (Blueprint $table) {
            $table->string('place_of_birth')->nullable()->after('date_of_birth'); // Add place_of_birth after date_of_birth
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('residences', function (Blueprint $table) {
            $table->dropColumn('place_of_birth'); // Drop place_of_birth column if it exists
        });
    }
}
