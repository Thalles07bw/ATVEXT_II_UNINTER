<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMedicinaSegurancaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_medicina_seguranca', function (Blueprint $table) {
            $table->smallInteger('id_medicina_seguranca', true);
            $table->integer('id_colaborador')->index('fk_tb_medicina_seguranca_tb_colaborador');
            $table->date('data_exame_procedimento');
            $table->smallInteger('id_tipo_exame_procedimento')->index('fk_tb_medicina_seguranca_tb_tipo_exame_procedimento');
            $table->string('descricao_medicina_seguranca', 150)->nullable();
            $table->string('nome_medico', 50)->nullable();
            $table->string('crm_medico', 15)->nullable();
            $table->smallInteger('id_cid')->index('fk_tb_medicina_seguranca_tb_cid');
            $table->string('avaliacao_medica', 200)->nullable();
            $table->smallInteger('exame_procedimento_finalizado');
            $table->smallInteger('colaborador_apto')->nullable();
            $table->date('data_proximo_exame_procedimento')->nullable();
            $table->smallInteger('num_dia_afastamento')->nullable();
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_medicina_seguranca');
    }
}
