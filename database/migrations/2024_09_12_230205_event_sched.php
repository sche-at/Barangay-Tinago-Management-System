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
        Schema::create('event_sched', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type_of_event');
            $table->string('date_and_venue');
            $table->string('tasks_assigned');
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
        Schema::dropIfExists('event_sched');
    }
};
