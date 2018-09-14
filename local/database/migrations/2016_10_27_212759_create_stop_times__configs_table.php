<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopTimesConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stop_times_configs', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->integer('trip_id');
            $table->integer('stop_id');
            $table->timestamps();

            $table->foreign('trip_id')->references('trip_id')->on('trips');
            $table->foreign('stop_id')->references('stop_id')->on('stops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stop_times_configs');
    }
}
