<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('preso_id');
            $table->unsignedBigInteger('setor_id');
          
            $table->string('url_audio');
            $table->string('url_audio_resposta')->nullable()->default(NULL);
            $table->text('resposta_texto')->nullable()->default(NULL);

            $table->integer('respondido')->nullable()->default(0);
            $table->integer('lido')->nullable()->default(0);
            
            $table->foreign('preso_id')->references('id')->on('presos');
            $table->foreign('setor_id')->references('id')->on('setors');

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
        Schema::dropIfExists('atendimentos');
    }
}
