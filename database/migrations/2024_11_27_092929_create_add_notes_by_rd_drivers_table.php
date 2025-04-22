<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddNotesByRdDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_notes_by_rd_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->integer('order_pickup_id');
            $table->integer('driver_id');
            $table->text('add_note');
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
        Schema::dropIfExists('add_notes_by_rd_drivers');
    }
}
