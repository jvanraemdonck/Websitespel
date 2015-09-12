<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->timestamp('time');
            $table->integer('team_id');
            $table->integer('question_id')->nullable();
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('event_types');

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
        Schema::drop('events');
    }
}
