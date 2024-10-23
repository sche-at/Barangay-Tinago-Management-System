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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // Changed to lowercase for consistency
            $table->string('event_venue'); // Changed to lowercase for consistency
            $table->string('task_assigned'); // Changed to lowercase for consistency
            $table->timestamps(); // Moved to the end
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events'); // Corrected to drop the right table
    }
};
