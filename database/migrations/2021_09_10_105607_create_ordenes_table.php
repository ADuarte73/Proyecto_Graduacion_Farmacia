<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('cliente');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion' , 255);
            $table->string('referencia' , 255);
            $table->float('total', 18 , 2);
            $table->string('orden' , 255);
            $table->string('tracking');
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
