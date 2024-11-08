<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets_header', function (Blueprint $table) {
            $table->id();
            $table->string('title_plan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets_header');
    }
};
