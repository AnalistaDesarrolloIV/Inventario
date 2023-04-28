<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PedidosSap', function (Blueprint $table) {
            $table->id();
            $table->string('COD_CLIENTE', 16);
            $table->string('NOMBRE_CLIENTE', 100);
            $table->string('RECOLECTOR', 100)->nullable();
            $table->time('HORA_INICIO_REC')->nullable();
            $table->time('HORA_FIN_REC')->nullable();
            $table->string('EMPACADOR', 100)->nullable();
            $table->time('HORA_INICIO_EMP')->nullable();
            $table->time('HORA_FIN_EMP')->nullable();
            $table->string('PEDIDO', 16)->unique();
            $table->integer('DOCUMENTO')->unique();
            $table->integer('CANT_LINEAS');
            $table->integer('CANT_UNIDADES');
            $table->date('FECHA');
            $table->string('COMENTARIOS', 254)->nullable();
            $table->unsignedBigInteger('ESTADO_ID');
            $table->foreign('ESTADO_ID')->references('id')->on('EstadosPedido');
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
        Schema::dropIfExists('PedidosSap');
    }
};
