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
        Schema::create('DetallesPedido', function (Blueprint $table) {
            $table->id();
            $table->string('PEDIDO_ID', 16);
            $table->foreign('PEDIDO_ID')->references('PEDIDO')->on('PedidosSap');
            $table->string('CODIGO_ARTICULO', 50);
            $table->string('DESCRIPCION_ARTICULO', 100);
            $table->string('LOTE', 50);
            $table->integer('CANTIDAD');
            $table->string('ESTADO', 10);
            $table->string('OPERADOR_QUE_EJECUTA', 100);
            $table->string('NOMBRE_BAHIA', 50);
            $table->string('NOMBRE_PASILLO', 50);
            $table->string('UBICACION', 50);
            $table->string('COMPARTIMENTO', 50);
            $table->string('CODIGO_BARRAS', 100);
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
        Schema::dropIfExists('DetallesPedido');
    }
};
