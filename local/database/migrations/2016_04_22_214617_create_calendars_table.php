<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('service_id');
            $table->integer('monday');
            $table->integer('tuesday');
            $table->integer('wednesday');
            $table->integer('thursday');
            $table->integer('friday');
            $table->integer('saturday');
            $table->integer('sunday');
            $table->string('start_date', 8);
            $table->string('end_date', 8);
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
        Schema::drop('calendars');
    }
}
