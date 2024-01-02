<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivoVisitaSigeps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivo_visita_sigeps', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->datetime('data_hora');
            $table->integer('importado')->comments('flag = true / false');
            $table->string('usuario');
            $table->softDeletes();
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
        Schema::dropIfExists('arquivo_visita_sigeps');
    }
}
