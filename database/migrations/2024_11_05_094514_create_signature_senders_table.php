<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignatureSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signature_senders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->nullable();; // Foreign key to the sender
            $table->unsignedBigInteger('order_id')->nullable();; // Foreign key to the order
            $table->unsignedBigInteger('order_pickup_id')->nullable(); // Foreign key to the pickup order
            $table->string('signature_image'); // Column to store the signature image file path
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
        Schema::dropIfExists('signature_senders');
    }
}
