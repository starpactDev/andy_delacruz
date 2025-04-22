<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentToBusinessExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_expenses', function (Blueprint $table) {
            $table->string('attachment')->nullable(); // This assumes the attachment will be a file path (nullable if not provided)

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_expenses', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }
}
