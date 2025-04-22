<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedOrderToDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_order_to_drivers', function (Blueprint $table) {
            $table->id();
            $table->integer('manager_id');
            $table->integer('order_number');
            $table->integer('driver_id');
            $table->integer('order_pickup_id');
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
        Schema::dropIfExists('assigned_order_to_drivers');
    }
}
