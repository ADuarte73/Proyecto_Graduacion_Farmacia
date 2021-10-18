<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleordenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleorden', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idorden');
            $table->string('producto');
            $table->integer('cantidad');
            $table->float('subtotal', 18 , 2);
            $table->timestamps();

            $table->foreign('idorden')->references('id')->on('ordenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleorden');
    }
}
