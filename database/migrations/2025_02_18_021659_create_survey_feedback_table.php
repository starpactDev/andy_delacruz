<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('order_pickup_id');
            $table->string('sender_id');
            $table->string('satisfaction')->nullable();
            $table->string('booking')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('package_condition')->nullable();
            $table->string('tracking')->nullable();
            $table->string('customer_support')->nullable();
            $table->string('support_satisfaction')->nullable();
            $table->string('professionalism');
            $table->json('improvements')->nullable();
            $table->string('recommend');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('survey_feedback');
    }
}
