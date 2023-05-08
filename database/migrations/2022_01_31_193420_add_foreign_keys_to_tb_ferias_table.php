<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_ferias', function (Blueprint $table) {
            $table->foreign('id_colaborador', 'fk_tb_ferias_tb_colaborador')->references('id_colaborador')->on('tb_colaborador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_ferias', function (Blueprint $table) {
            $table->dropForeign('fk_tb_ferias_tb_colaborador');
        });
    }
}
