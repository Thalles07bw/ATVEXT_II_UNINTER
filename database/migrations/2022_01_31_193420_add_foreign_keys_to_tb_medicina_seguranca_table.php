<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbMedicinaSegurancaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_medicina_seguranca', function (Blueprint $table) {
            $table->foreign('id_cid', 'fk_tb_medicina_seguranca_tb_cid')->references('id_cid')->on('tb_cid')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_colaborador', 'fk_tb_medicina_seguranca_tb_colaborador')->references('id_colaborador')->on('tb_colaborador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_exame_procedimento', 'fk_tb_medicina_seguranca_tb_tipo_exame_procedimento')->references('id_tipo_exame_procedimento')->on('tb_tipo_exame_procedimento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_medicina_seguranca', function (Blueprint $table) {
            $table->dropForeign('fk_tb_medicina_seguranca_tb_cid');
            $table->dropForeign('fk_tb_medicina_seguranca_tb_colaborador');
            $table->dropForeign('fk_tb_medicina_seguranca_tb_tipo_exame_procedimento');
        });
    }
}
