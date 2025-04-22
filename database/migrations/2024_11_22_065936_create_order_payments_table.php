<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_pickup_id');
            $table->decimal('deposit', 10, 2); // To store deposit amount
            $table->string('payment_method'); // For storing payment method
            $table->timestamps();

            $table->foreign('order_pickup_id')
            ->references('id')
            ->on('order_pickups')
            ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payments');
    }
}
