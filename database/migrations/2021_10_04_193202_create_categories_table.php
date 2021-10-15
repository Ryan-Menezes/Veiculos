<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('slug')->unique();
        });

        Schema::create('vehicle_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_categories', function (Blueprint $table) {
            $table->dropForeign(['vehicle_categories_vehicle_id_foreign', 'vehicle_categories_category_id_foreign']);
        });

        Schema::dropIfExists('vehicle_categories');
        Schema::dropIfExists('categories');
    }
}
