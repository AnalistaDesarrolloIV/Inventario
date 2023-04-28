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
        Schema::create('pedidosSapHisto', function (Blueprint $table) {
            $table->id();
            $table->string('COD_CLIENTE', 15);
            $table->string('NOMBRE_CLIENTE', 100);
            $table->string('RECOLECTOR', 100);
            $table->time('HORA_INICIO_REC');
            $table->time('HORA_FIN_REC');
            $table->string('EMPACADOR', 100);
            $table->time('HORA_INICIO_EMP');
            $table->time('HORA_FIN_EMP');
            $table->string('PEDIDO', 16)->unique();
            $table->integer('CANT_LINEAS');
            $table->integer('CANT_UNIDADES');
            $table->date('FECHA');
            $table->string('COMENTARIOS', 254);
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
        Schema::dropIfExists('pedidosSapHisto');
    }
};
