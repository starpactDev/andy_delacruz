<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiverIdentityCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiver_identity_cards', function (Blueprint $table) {
            $table->id();
            $table->string('order_pickup_id');
            $table->unsignedBigInteger('receiver_id');
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
        Schema::dropIfExists('receiver_identity_cards');
    }
}
