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
            $table->integer('manufacturer_id')->unsigned()->nullable();
            $table->string('brand', 100);
            $table->string('slug')->unique();
            $table->string('model', 100);
            $table->year('year');
            $table->tinyInteger('ports')->unsigned();
            $table->decimal('price', 15, 2);
            $table->decimal('promotion', 15, 2)->nullable();
            $table->smallInteger('mileage')->unsigned();
            $table->smallInteger('quantity')->unsigned();
            $table->timestamp('release_date')->nullable();
            $table->timestamp('promotion_date')->nullable();
            $table->enum('status', ['D', 'I'])->default('D'); // D - Disponpível | I - Indisponível
            $table->mediumText('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('SET NULL')->onUpdate('CASCADE');
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
            $table->dropForeign('vehicles_manufacturer_id_foreign');
        });

        Schema::dropIfExists('vehicles');
    }
}
