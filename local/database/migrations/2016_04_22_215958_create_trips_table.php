<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->integer('route_id');
            $table->integer('service_id');
            $table->increments('trip_id');
            $table->string('trip_short_name', 60);
            $table->timestamps();

            $table->foreign('route_id')->references('route_id')->on('routes');
            $table->foreign('service_id')->references('service_id')->on('calendars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}
