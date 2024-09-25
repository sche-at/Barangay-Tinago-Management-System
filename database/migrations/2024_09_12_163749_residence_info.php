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
        Schema::create('residence_info', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('full_name');
            $table->string('sex');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->string('civil_status');
            $table->integer('purok');
            $table->string('address');
            $table->string('educational_level');
            $table->string('occupation');
            $table->string('employment_status');
            $table->string('contact_number');
            $table->string('family_members');
    }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('residence_info');
    }
};
