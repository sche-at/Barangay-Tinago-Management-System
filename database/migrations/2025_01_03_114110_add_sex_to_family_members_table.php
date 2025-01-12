<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('family_members', function (Blueprint $table) {
        $table->enum('sex', ['Male', 'Female', 'Other'])->nullable();
    });
}

public function down()
{
    Schema::table('family_members', function (Blueprint $table) {
        $table->dropColumn('sex');
    });
}

};
