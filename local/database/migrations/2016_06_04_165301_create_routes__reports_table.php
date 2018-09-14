<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_reports', function (Blueprint $table) {
          $table->engine = 'MyISAM';

          $table->increments('id');
          $table->integer('route_id');
          $table->integer('reports')->default(0);
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
        Schema::drop('routes_reports');
    }
}
