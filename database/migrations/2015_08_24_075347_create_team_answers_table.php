<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('question_id');
            $table->string('answer');
            $table->boolean('correct');
            $table->timestamps();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams');

            $table->foreign('question_id')
                ->references('id')
                ->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('team_answers');
    }
}
