<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbColaboradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_colaborador', function (Blueprint $table) {
            $table->integer('id_colaborador', true);
            $table->string('nome_colaborador', 60);
            $table->string('email_empresarial', 30);
            $table->smallInteger('id_saudacao')->index('fk_tb_colaborador_tb_tb_saudacao');
            $table->date('dn_colaborador');
            $table->smallInteger('id_genero')->index('fk_tb_colaborador_tb_genero');
            $table->string('foto_colaborador', 60)->nullable()->default('default.png');
            $table->smallInteger('id_estado_civil')->index('fk_tb_colaborador_tb_estado_civil');
            $table->smallInteger('id_escolaridade')->index('fk_tb_colaborador_tb_escolaridade');
            $table->smallInteger('possui_deficiencia');
            $table->string('tipo_necessidade_especial', 30)->nullable();
            $table->string('nacionalidade_colaborador', 25)->nullable();
            $table->string('naturalidade_colaborador', 25)->nullable();
            $table->string('nome_pai_colaborador', 50)->nullable();
            $table->string('nome_mae_colaborador', 50)->nullable();
            $table->smallInteger('id_pais')->index('fk_tb_colaborador_tb_pais');
            $table->char('cep_colaborador', 9)->nullable();
            $table->string('logradouro_colaborador', 30)->nullable();
            $table->string('numero_endereco_colaborador', 5)->nullable();
            $table->string('complemento_endereco_colaborador', 10)->nullable();
            $table->string('bairro_colaborador', 20)->nullable();
            $table->smallInteger('id_estado')->index('fk_tb_colaborador_tb_estado');
            $table->smallInteger('id_cidade')->index('fk_tb_colaborador_tb_cidade');
            $table->smallInteger('dial_code_telefone')->default(1)->index('fk_tb_colaborador_tb_dial_code');
            $table->string('numero_telefone', 15)->nullable();
            $table->smallInteger('dial_code_celular')->default(1)->index('fk_tb_colaborador_tb_dial_code2');
            $table->string('numero_celular', 15)->nullable();
            $table->smallInteger('dial_code_tel_emergencia')->default(1)->index('fk_tb_colaborador_tb_dial_code3');
            $table->string('numero_tel_emergencia', 15)->nullable();
            $table->string('email_pessoal', 30)->nullable();
            $table->smallInteger('id_departamento')->index('fk_tb_colaborador_tb_departamento');
            $table->smallInteger('id_cargo')->index('fk_tb_colaborador_tb_cargo');
            $table->smallInteger('id_tipo_contrato')->index('fk_tb_colaborador_tb_tipo_contrato');
            $table->string('turno_trabalho', 35)->nullable();
            $table->decimal('salario', 11)->nullable();
            $table->date('data_demissao')->nullable();
            $table->smallInteger('periodo_experiencia')->nullable();
            $table->string('matricula', 15)->nullable();
            $table->smallInteger('id_grau_hierarquico')->index('fk_tb_colaborador_tb_grau_hierarquico');
            $table->date('data_contrato')->nullable();
            $table->string('duracao_contrato', 25)->nullable();
            $table->date('vencimento_contrato')->nullable();
            $table->string('cpf_colaborador', 15);
            $table->string('cnpj_colaborador', 15)->nullable();
            $table->string('rg_colaborador', 15)->nullable();
            $table->date('data_expedicao_rg_colaborador')->nullable();
            $table->string('orgao_expedidor_rg_colaborador', 4)->nullable();
            $table->string('cnh_colaborador', 30)->nullable();
            $table->string('doc_reservista_colaborador', 30)->nullable();
            $table->string('titulo_eleitor_colaborador', 30)->nullable();
            $table->string('zona_eleitoral_colaborador', 30)->nullable();
            $table->string('secao_eleitoral_colaborador', 30)->nullable();
            $table->string('pis_colaborador', 15)->nullable();
            $table->string('num_ctps_colaborador', 15)->nullable();
            $table->string('serie_ctps_colaborador', 15)->nullable();
            $table->string('banco_colaborador', 30)->nullable();
            $table->string('agencia_conta_colaborador', 10)->nullable();
            $table->string('conta_corrente_colaborador', 20)->nullable();
            $table->integer('superior_direto_colaborador')->nullable();
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->integer('id_usuario')->index('fk_tb_colaborador_tb_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_colaborador');
    }
}
