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
        Schema::create('CopiaWMS', function (Blueprint $table) {
            $table->id();
            $table->String('ItemCode', 50);
            $table->String('Description', 100);
            $table->String('BarCode', 500);
            $table->double('Amount', 11,3);
            $table->String('Lote', 50);
            $table->Date('DateExpiration');
            $table->String('Zone', 50);
            $table->String('Hallway', 50);
            $table->String('Location', 50);
            $table->double('Compartment', 15,0)->nullable();
            $table->String('New', 10)->nullable();
            $table->Date('DateCopy')->nullable();
            $table->time('HourCopy', $precision = 0)->nullable();
            $table->boolean('State');
            $table->String('Type', 10);
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
        Schema::dropIfExists('CopiaWMS');
    }
};
