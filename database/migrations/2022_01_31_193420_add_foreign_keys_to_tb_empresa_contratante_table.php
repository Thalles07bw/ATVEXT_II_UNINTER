<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbEmpresaContratanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_empresa_contratante', function (Blueprint $table) {
            $table->foreign('id_cidade', 'fk_tb_empresa_contratante_tb_cidade')->references('id_cidade')->on('tb_cidade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_telefone', 'fk_tb_empresa_contratante_tb_dial_code')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dial_code_celular', 'fk_tb_empresa_contratante_tb_dial_code2')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado', 'fk_tb_empresa_contratante_tb_estado')->references('id_estado')->on('tb_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_pais', 'fk_tb_empresa_contratante_tb_pais')->references('id_pais')->on('tb_pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tamanho_empresa', 'fk_tb_empresa_contratante_tb_tamanho_empresa')->references('id_tamanho_empresa')->on('tb_tamanho_empresa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_cliente', 'fk_tb_empresa_contratante_tb_tipo_cliente')->references('id_tipo_cliente')->on('tb_tipo_cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('empresa_gerente', 'tb_empresa_contratante_FK')->references('id_empresa_contratante')->on('tb_empresa_contratante')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_empresa_contratante', function (Blueprint $table) {
            $table->dropForeign('fk_tb_empresa_contratante_tb_cidade');
            $table->dropForeign('fk_tb_empresa_contratante_tb_dial_code');
            $table->dropForeign('fk_tb_empresa_contratante_tb_dial_code2');
            $table->dropForeign('fk_tb_empresa_contratante_tb_estado');
            $table->dropForeign('fk_tb_empresa_contratante_tb_pais');
            $table->dropForeign('fk_tb_empresa_contratante_tb_tamanho_empresa');
            $table->dropForeign('fk_tb_empresa_contratante_tb_tipo_cliente');
            $table->dropForeign('tb_empresa_contratante_FK');
        });
    }
}
