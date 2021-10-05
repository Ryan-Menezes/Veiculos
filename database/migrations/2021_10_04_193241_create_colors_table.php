<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->char('hexadecimal', 6);
            $table->string('image', 100);
        });

        Schema::create('vehicle_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('color_id')->unsigned();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_colors', function (Blueprint $table) {
            $table->dropForeign(['vehicle_colors_vehicle_id_foreign', 'vehicle_colors_color_id_foreign']);
        });

        Schema::dropIfExists('colors');
    }
}
