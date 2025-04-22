<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pickups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('invoice_number');
           
            $table->dateTime('issue_date')->default(now());
            $table->string('order_number');
            $table->string('container_number');
            $table->string('driver_pickup_name');
            $table->unsignedBigInteger('driver_id');
            $table->float('total');
            $table->float('discount')->nullable();
            $table->float('grand_total_amount');
            $table->integer('total_no_packages');
            $table->string('payment_method');
            $table->string('payment_location')->nullable();
            $table->text('signature_image_of_sender')->nullable();
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
        Schema::dropIfExists('order_pickups');
    }
}
