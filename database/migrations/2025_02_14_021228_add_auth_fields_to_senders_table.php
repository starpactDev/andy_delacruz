<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthFieldsToSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('senders', function (Blueprint $table) {
            $table->string('password')->after('cell');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('senders', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token']);
        });
    }
}
