<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('route_id');
            $table->integer('agency_id');
            $table->integer('user_id');
            $table->string('route_short_name', 50);
            $table->string('route_long_name', 255);
            $table->integer('route_type');
            $table->timestamps();

            $table->foreign('agency_id')->references('agency_id')->on('agencies');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('routes');
    }
}
