pphp<?php

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
        Schema::create('Blotters_Record', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('blotters_ID');
            $table->string('blotters_name');
            $table->string('date');
            $table->string('time');
            $table->string('incident_type');
            $table->string('location');
            $table->string('reported_by');
            $table->string('responding_officer');
            $table->string('status');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Blotters_Record');
    }
};
