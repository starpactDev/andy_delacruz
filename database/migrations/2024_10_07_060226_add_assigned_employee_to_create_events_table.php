<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedEmployeeToCreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('create_events', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_employee')->nullable()->after('event_date'); // Add assigned_employee column

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
            $table->dropColumn('assigned_employee'); // Rollback if necessary

        });
    }
}
