<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresoFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preso_familiares', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('preso_id');
            $table->integer('credencial')->comments('Numero da Credencial de acesso');
            $table->string('rg')->comments('RG do familiar');
            $table->string('cpf')->comments('CPF do familiar');
            $table->string('nome')->comments('Nome do familiar');
            $table->date('data_nascimento')->comments('Data de nascimento do familiar');
            $table->string('afinidade')->comments('Afinidade/Parentesco');
            $table->date('validade')->comments('Validade da Credencial de acesso');
            $table->string('status')->comments('Status da Credencial de acesso');
            $table->string('tipo');
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
        Schema::dropIfExists('preso_familiares');
    }
}
