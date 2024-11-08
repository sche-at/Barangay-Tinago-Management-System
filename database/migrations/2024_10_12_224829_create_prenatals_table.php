<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prenatals', function (Blueprint $table) {
            $table->id();
            $table->string('activity');
            $table->string('venue');
            $table->string('schedule_date');
            $table->string('schedule_time');
            $table->timestamps();
        }); 
        
    }

    public function down()
    {
        Schema::dropIfExists('prenatals');
    }
};
