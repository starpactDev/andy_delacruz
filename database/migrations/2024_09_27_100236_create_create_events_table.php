<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Event title
            $table->date('event_date'); // Event date
            $table->time('start_time')->nullable(); // Event start time
            $table->time('end_time')->nullable(); // Event end time
            $table->text('comments')->nullable(); // Event comments
            $table->string('color')->nullable(); // Event color
            $table->string('assigned_driver')->nullable(); // Assigned driver
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
        Schema::dropIfExists('create_events');
    }
}
