<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresoAlojamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preso_alojamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preso_id');
            $table->unsignedBigInteger('cubiculo_id');
            $table->datetime('data_entrada');
            $table->datetime('data_saida')->nullable()->default(NULL);
            
            $table->foreign('preso_id')->references('id')->on('presos');
            $table->foreign('cubiculo_id')->references('id')->on('cubiculos');
           
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
        Schema::dropIfExists('preso_alojamentos');
    }
}
