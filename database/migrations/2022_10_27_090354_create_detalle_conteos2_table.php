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
        Schema::create('DetalleConteos2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Conteo_id');
            $table->foreign('Conteo_id')->references('id')->on('Conteos');
            $table->unsignedBigInteger('Copia_id');
            $table->foreign('Copia_id')->references('id')->on('CopiaWMS');
            $table->String('Comments', 100)->nullable();
            $table->String('ItemCode', 50)->nullable();
            $table->double('Amount', 11,3)->nullable();
            $table->String('Lote', 50)->nullable();
            $table->Date('DateExpiration')->nullable();
            $table->boolean('State');
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
        Schema::dropIfExists('DetalleConteos2');
    }
};
