<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDemissaoColaboradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_demissao_colaborador', function (Blueprint $table) {
            $table->foreign('id_colaborador', 'tb_demisao_colaborador_FK')->references('id_colaborador')->on('tb_colaborador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_motivo_demissao', 'tb_demisao_colaborador_FK_1')->references('id_motivo_demissao')->on('tb_motivo_demissao')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_demissao_colaborador', function (Blueprint $table) {
            $table->dropForeign('tb_demisao_colaborador_FK');
            $table->dropForeign('tb_demisao_colaborador_FK_1');
        });
    }
}
