<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presos', function (Blueprint $table) {
            $table->id();
            $table->integer('prontuario');
            $table->string('nome');
            $table->string('rg');
            $table->date('data_nascimento');
            $table->string('mae');
            $table->string('artigos');
            $table->string('situacao');
            $table->string('origem');
            $table->date('data_prisao');
            $table->date('data_depen');
            $table->date('data_entrada');
            $table->string('url_foto',255)->nullable();            
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
        Schema::dropIfExists('presos');
    }
}
