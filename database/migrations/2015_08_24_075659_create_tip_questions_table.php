<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tip_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start_time');
            $table->text('question');
            $table->string('additional_info')->nullable();
            $table->smallInteger('question_type');
            $table->timestamp('end_time')->nullable();
            $table->integer('answered_team_id')->nullable();
            $table->timestamps();

            $table->foreign('answered_team_id')
                ->references('id')
                ->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tip_questions');
    }
}
