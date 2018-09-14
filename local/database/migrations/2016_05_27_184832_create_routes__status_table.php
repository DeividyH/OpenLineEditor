<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_status', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->integer('route_id');
            $table->boolean('editing')->default(0);
            $table->timestamps();

            $table->foreign('route_id')->references('route_id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('routes_status');
    }
}
