<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenderIdentityCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sender_identity_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_pickup_id');
            $table->unsignedBigInteger('sender_id');
            $table->text('id_front');
            $table->text('id_back');
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
        Schema::dropIfExists('sender_identity_cards');
    }
}
