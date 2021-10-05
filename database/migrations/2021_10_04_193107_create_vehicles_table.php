<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacture_id')->unsigned();
            $table->string('brand', 100)->unique();
            $table->string('slug')->unique();
            $table->string('model', 100);
            $table->year('year');
            $table->tinyInteger('ports')->unsigned();
            $table->decimal('price', 10, 2);
            $table->smallInteger('mileage')->unsigned();
            $table->timestamp('release_date')->nullable();
            $table->mediumText('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('manufacture_id')->references('id')->on('manufactures')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign('vehicles_manufacture_id_foreign');
        });

        Schema::dropIfExists('vehicles');
    }
}
