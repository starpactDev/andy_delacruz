<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedCustomerToCreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('create_events', function (Blueprint $table) {
            $table->string('assigned_customer')->nullable()->after('assigned_driver');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('create_events', function (Blueprint $table) {
            $table->dropColumn('assigned_customer');
        });
    }
}
