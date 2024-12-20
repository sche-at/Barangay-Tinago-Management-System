<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToResidencesTable extends Migration
{
    public function up()
    {
        Schema::table('residences', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('residences', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}