<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPresoAlojamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preso_alojamentos', function (Blueprint $table) {
            $table->addColumn('text', 'motivo')->after('data_saida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter('preso_alojamentos', function (Blueprint $table) {
            $table->dropColumn('text');
        });
    }
}
