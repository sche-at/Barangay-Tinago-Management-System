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
    public function up()
    {
        Schema::create('Immunization', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vaccine');
            $table->string('recommended_age');
            $table->string('dosage');
            $table->string('venue');
            $table->string('date');
            $table->string('time');
            $table->string('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Immunization');
    }
};
