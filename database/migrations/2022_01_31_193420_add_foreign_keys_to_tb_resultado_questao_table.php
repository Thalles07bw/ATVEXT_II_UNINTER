<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbResultadoQuestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_resultado_questao', function (Blueprint $table) {
            $table->foreign('id_questao', 'tb_resultado_questao_FK')->references('id_pergunta_prova')->on('tb_pergunta_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('alternativa_escolhida', 'tb_resultado_questao_FK_1')->references('id_resposta_prova')->on('tb_resposta_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('token_avaliacao', 'tb_resultado_questao_FK_2')->references('token')->on('tb_token_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_candidato', 'tb_resultado_questao_FK_3')->references('id_candidato')->on('tb_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_resultado_questao', function (Blueprint $table) {
            $table->dropForeign('tb_resultado_questao_FK');
            $table->dropForeign('tb_resultado_questao_FK_1');
            $table->dropForeign('tb_resultado_questao_FK_2');
            $table->dropForeign('tb_resultado_questao_FK_3');
        });
    }
}
