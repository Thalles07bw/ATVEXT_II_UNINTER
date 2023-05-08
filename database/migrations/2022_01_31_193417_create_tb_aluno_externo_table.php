<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAlunoExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aluno_externo', function (Blueprint $table) {
            $table->integer('id_aluno', true);
            $table->string('nome_aluno', 60);
            $table->string('email_aluno', 30);
            $table->smallInteger('id_saudacao');
            $table->date('dn_aluno');
            $table->smallInteger('id_genero');
            $table->string('foto_aluno', 60)->nullable();
            $table->smallInteger('id_estado_civil');
            $table->smallInteger('id_escolaridade');
            $table->smallInteger('possui_deficiencia');
            $table->string('tipo_necessidade_especial', 30)->nullable();
            $table->string('nacionalidade_aluno', 25)->nullable();
            $table->string('naturalidade_aluno', 25)->nullable();
            $table->string('nome_pai_aluno', 50)->nullable();
            $table->string('nome_mae_aluno', 50)->nullable();
            $table->smallInteger('id_pais');
            $table->char('cep_aluno', 9)->nullable();
            $table->string('logradouro_aluno', 30)->nullable();
            $table->string('numero_endereco_aluno', 5)->nullable();
            $table->string('complemento_endereco_aluno', 10)->nullable();
            $table->string('bairro_aluno', 20)->nullable();
            $table->smallInteger('id_estado');
            $table->smallInteger('id_cidade');
            $table->smallInteger('dial_code_telefone');
            $table->string('numero_telefone', 15)->nullable();
            $table->smallInteger('dial_code_celular');
            $table->string('numero_celular', 15)->nullable();
            $table->smallInteger('dial_code_tel_emergencia');
            $table->string('numero_tel_emergencia', 15)->nullable();
            $table->string('cpf_aluno', 15);
            $table->string('cnpj_colaborador', 15)->nullable();
            $table->string('rg_colaborador', 15)->nullable();
            $table->date('data_expedicao_rg_aluno')->nullable();
            $table->string('orgao_expedidor_rg_aluno', 4)->nullable();
            $table->string('cnh_aluno', 30)->nullable();
            $table->string('doc_reservista_aluno', 30)->nullable();
            $table->string('titulo_eleitor_aluno', 30)->nullable();
            $table->string('zona_eleitoral_aluno', 30)->nullable();
            $table->string('secao_eleitoral_aluno', 30)->nullable();
            $table->dateTime('data_criacao');
            $table->dateTime('data_ultima_modificacao');
            $table->integer('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aluno_externo');
    }
}
