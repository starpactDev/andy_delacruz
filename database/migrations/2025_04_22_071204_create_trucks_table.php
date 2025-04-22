<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('renew_tag')->nullable();
            $table->string('insurance_renewal')->nullable();
            $table->string('next_oil_change')->nullable();
            $table->string('truck_name');
            $table->string('truck_brand')->nullable();
            $table->string('truck_model')->nullable();
            $table->string('color')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('last_mechanic_visit')->nullable();
            $table->string('repairs_done')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('trucks');
    }
}
