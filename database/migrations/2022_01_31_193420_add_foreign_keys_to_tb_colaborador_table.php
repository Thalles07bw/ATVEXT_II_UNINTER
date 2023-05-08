<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbColaboradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_colaborador', function (Blueprint $table) {
            $table->foreign('id_cargo', 'fk_tb_colaborador_tb_cargo')->references('id_cargo')->on('tb_cargo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_cidade', 'fk_tb_colaborador_tb_cidade')->references('id_cidade')->on('tb_cidade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_departamento', 'fk_tb_colaborador_tb_departamento')->references('id_departamento')->on('tb_departamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_telefone', 'fk_tb_colaborador_tb_dial_code')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_celular', 'fk_tb_colaborador_tb_dial_code2')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_tel_emergencia', 'fk_tb_colaborador_tb_dial_code3')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_escolaridade', 'fk_tb_colaborador_tb_escolaridade')->references('id_escolaridade')->on('tb_escolaridade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado', 'fk_tb_colaborador_tb_estado')->references('id_estado')->on('tb_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado_civil', 'fk_tb_colaborador_tb_estado_civil')->references('id_estado_civil')->on('tb_estado_civil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_genero', 'fk_tb_colaborador_tb_genero')->references('id_genero')->on('tb_genero')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_grau_hierarquico', 'fk_tb_colaborador_tb_grau_hierarquico')->references('id_grau_hierarquico')->on('tb_grau_hierarquico')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_pais', 'fk_tb_colaborador_tb_pais')->references('id_pais')->on('tb_pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_saudacao', 'fk_tb_colaborador_tb_saudacao')->references('id_saudacao')->on('tb_saudacao')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_contrato', 'fk_tb_colaborador_tb_tipo_contrato')->references('id_tipo_contrato')->on('tb_tipo_contrato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_usuario', 'fk_tb_colaborador_tb_usuario')->references('id_usuario')->on('tb_usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_colaborador', function (Blueprint $table) {
            $table->dropForeign('fk_tb_colaborador_tb_cargo');
            $table->dropForeign('fk_tb_colaborador_tb_cidade');
            $table->dropForeign('fk_tb_colaborador_tb_departamento');
            $table->dropForeign('fk_tb_colaborador_tb_dial_code');
            $table->dropForeign('fk_tb_colaborador_tb_dial_code2');
            $table->dropForeign('fk_tb_colaborador_tb_dial_code3');
            $table->dropForeign('fk_tb_colaborador_tb_escolaridade');
            $table->dropForeign('fk_tb_colaborador_tb_estado');
            $table->dropForeign('fk_tb_colaborador_tb_estado_civil');
            $table->dropForeign('fk_tb_colaborador_tb_genero');
            $table->dropForeign('fk_tb_colaborador_tb_grau_hierarquico');
            $table->dropForeign('fk_tb_colaborador_tb_pais');
            $table->dropForeign('fk_tb_colaborador_tb_saudacao');
            $table->dropForeign('fk_tb_colaborador_tb_tipo_contrato');
            $table->dropForeign('fk_tb_colaborador_tb_usuario');
        });
    }
}
