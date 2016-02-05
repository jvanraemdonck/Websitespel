<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('question_id');
            $table->boolean('tip');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->timestamp('delta_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('question_times');
    }
}
