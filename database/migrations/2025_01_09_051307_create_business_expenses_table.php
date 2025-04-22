<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_payment');
            $table->string('payment_method');
            $table->string('paid_to');
            $table->text('description')->nullable();
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('running_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_expenses');
    }
}
