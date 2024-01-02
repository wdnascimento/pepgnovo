<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresoKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preso_kits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preso_id');
            $table->integer('kit');
            $table->datetime('data_inicial');
            $table->datetime('data_final')->nullable()->default(NULL);
            
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
        Schema::dropIfExists('preso_kits');
    }
}
