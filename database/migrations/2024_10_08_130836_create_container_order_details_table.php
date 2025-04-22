<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainerOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();

            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->string('delivery_date')->nullable();
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
        Schema::dropIfExists('container_order_details');
    }
}
