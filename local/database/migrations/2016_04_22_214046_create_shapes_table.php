<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shapes', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->integer('shape_id');
            $table->double('shape_pt_lat', 8, 6);
            $table->double('shape_pt_lon', 8, 6);
            $table->integer('shape_pt_sequence');
            $table->timestamps();

            $table->foreign('shape_id')->references('trip_id')->on('trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shapes');
    }
}
