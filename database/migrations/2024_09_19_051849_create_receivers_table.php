<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('second_last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('neighborhood')->nullable();
            $table->string('city');
            $table->string('province');
            $table->text('reference')->nullable();
            $table->string('telephone')->nullable();
            $table->string('cell')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('sender_id')->references('id')->on('senders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
        });
        Schema::dropIfExists('receivers');
    }
}
