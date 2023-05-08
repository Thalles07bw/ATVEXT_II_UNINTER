<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbEtapaVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_etapa_vaga', function (Blueprint $table) {
            $table->foreign('id_etapa', 'fk_tb_etapa_vaga_tb_etapa')->references('id_etapa')->on('tb_etapa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_vaga', 'fk_tb_etapa_vaga_tb_vaga')->references('id_vaga')->on('tb_vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_etapa_vaga', function (Blueprint $table) {
            $table->dropForeign('fk_tb_etapa_vaga_tb_etapa');
            $table->dropForeign('fk_tb_etapa_vaga_tb_vaga');
        });
    }
}
