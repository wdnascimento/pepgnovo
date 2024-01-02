<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecebimentoStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recebimento_status', function (Blueprint $table) {
            $table->id();

            $table->integer('recebimento_id');
            $table->datetime('inicio')->useCurrent();
            $table->datetime('fim')->nullable();

            $table->integer('status');
            $table->string('cadastrado_por');

            

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
        Schema::dropIfExists('recebimento_status');
    }
}
