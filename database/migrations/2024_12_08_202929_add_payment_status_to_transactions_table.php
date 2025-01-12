<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStatusToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Add payment_status column with a default of 'Unpaid'
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid')->after('mode_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop the payment_status column if the migration needs to be rolled back
            $table->dropColumn('payment_status');
        });
    }
}