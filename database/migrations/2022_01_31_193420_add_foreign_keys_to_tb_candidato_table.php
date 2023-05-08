<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_candidato', function (Blueprint $table) {
            $table->foreign('id_cidade', 'fk_tb_candidato_tb_cidade')->references('id_cidade')->on('tb_cidade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado_emissao_cnh', 'fk_tb_candidato_tb_cidade2')->references('id_estado')->on('tb_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_telefone', 'fk_tb_candidato_tb_dial_code')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_whatsapp', 'fk_tb_candidato_tb_dial_code2')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado', 'fk_tb_candidato_tb_estado')->references('id_estado')->on('tb_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado_civil', 'fk_tb_candidato_tb_estado_civil')->references('id_estado_civil')->on('tb_estado_civil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_genero', 'fk_tb_candidato_tb_genero')->references('id_genero')->on('tb_genero')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_pais', 'fk_tb_candidato_tb_pais')->references('id_pais')->on('tb_pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_senioridade', 'fk_tb_candidato_tb_senioridade')->references('id_senioridade')->on('tb_senioridade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_usuario_candidato', 'fk_tb_candidato_tb_usuario_candidato')->references('id_usuario_candidato')->on('tb_usuario_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_candidato', function (Blueprint $table) {
            $table->dropForeign('fk_tb_candidato_tb_cidade');
            $table->dropForeign('fk_tb_candidato_tb_cidade2');
            $table->dropForeign('fk_tb_candidato_tb_dial_code');
            $table->dropForeign('fk_tb_candidato_tb_dial_code2');
            $table->dropForeign('fk_tb_candidato_tb_estado');
            $table->dropForeign('fk_tb_candidato_tb_estado_civil');
            $table->dropForeign('fk_tb_candidato_tb_genero');
            $table->dropForeign('fk_tb_candidato_tb_pais');
            $table->dropForeign('fk_tb_candidato_tb_senioridade');
            $table->dropForeign('fk_tb_candidato_tb_usuario_candidato');
        });
    }
}
