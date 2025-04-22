<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUserDriverInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_driver_infos', function (Blueprint $table) {
            $table->string('second_last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('province')->nullable();
            $table->string('reference')->nullable();
            $table->string('cell')->nullable();
            $table->string('whatsapp')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_driver_infos', function (Blueprint $table) {
            $table->dropColumn([
                'second_last_name',
                'nickname',
                'neighborhood',
                'province',
                'reference',
                'cell',
                'whatsapp',
            ]);
        });
    }
}
