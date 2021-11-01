<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->decimal('price', 15, 2);
            $table->decimal('discount', 15, 2)->default(0);
            $table->enum('status', ['PA', 'PE', 'AC', 'RE', 'CO', 'CA']);  // PAGAMENTO, PENDENTE, ACEITO, RECUSADO, CONCLUIDO, CANCELADO
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('request_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->integer('vehicle_id')->unsigned()->nullable();

            $table->foreign('request_id')->references('id')->on('requests')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['requests_vehicle_id_foreign']);
        });

        Schema::table('request_vehicles', function (Blueprint $table) {
            $table->dropForeign(['request_vehicles_request_id_foreign', 'request_vehicles_vehicle_id_foreign']);
        });

        Schema::dropIfExists('request_vehicles');
        Schema::dropIfExists('requests');
    }
}
