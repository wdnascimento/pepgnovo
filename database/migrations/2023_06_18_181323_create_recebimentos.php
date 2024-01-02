<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecebimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recebimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preso_id');
            $table->unsignedBigInteger('preso_familiar_id');
            $table->datetime('data_hora')->useCurrent();
            $table->string('cadastrado_por');
            $table->foreign('preso_familiar_id')->references('id')->on('preso_familiares');
            $table->foreign('preso_id')->references('id')->on('presos');
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
        Schema::dropIfExists('recebimentos');
    }
}
