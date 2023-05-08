<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_candidato', function (Blueprint $table) {
            $table->integer('id_candidato', true);
            $table->smallInteger('dial_code_telefone')->index('fk_tb_candidato_tb_dial_code');
            $table->string('numero_telefone', 15);
            $table->smallInteger('dial_code_whatsapp')->index('fk_tb_candidato_tb_dial_code2');
            $table->string('numero_whatsapp', 15);
            $table->string('email_candidato', 30);
            $table->string('foto_candidato', 120)->nullable()->default('/storage/app/images/users/default.png');
            $table->string('nacionalidade_candidato', 25)->nullable();
            $table->string('naturalidade_colaborador', 25)->nullable();
            $table->smallInteger('id_genero')->index('fk_tb_candidato_tb_genero');
            $table->date('dn_candidato');
            $table->smallInteger('id_estado_civil')->index('fk_tb_candidato_tb_estado_civil');
            $table->smallInteger('id_senioridade')->index('fk_tb_candidato_tb_senioridade');
            $table->decimal('pretensao_salarial', 11)->nullable();
            $table->string('resumo_candidato', 2000)->nullable();
            $table->string('video_apresentacao_candidato', 200)->nullable();
            $table->smallInteger('possui_deficiencia');
            $table->string('tipo_necessidade_especial', 30)->nullable();
            $table->string('linkedin', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->smallInteger('id_pais')->index('fk_tb_candidato_tb_pais');
            $table->char('cep_candidato', 9);
            $table->string('logradouro_candidato', 30);
            $table->string('numero_endereco_candidato', 5);
            $table->string('complemento_endereco_candidato', 10)->nullable();
            $table->string('bairro_candidato', 20);
            $table->smallInteger('id_estado')->index('fk_tb_candidato_tb_estado');
            $table->smallInteger('id_cidade')->index('fk_tb_candidato_tb_cidade');
            $table->string('rg_candidato', 15)->nullable();
            $table->date('data_expedicao_rg_candidato')->nullable();
            $table->string('orgao_expedidor_rg_candidato', 4)->nullable();
            $table->string('cnh_candidato', 30)->nullable();
            $table->date('data_emissao_cnh')->nullable();
            $table->date('data_primeira_cnh')->nullable();
            $table->smallInteger('id_estado_emissao_cnh')->nullable()->index('fk_tb_candidato_tb_cidade2');
            $table->string('titulo_eleitor_candidato', 30)->nullable();
            $table->string('zona_eleitoral_candidato', 30)->nullable();
            $table->string('secao_eleitoral_candidato', 30)->nullable();
            $table->string('pis_candidato', 15)->nullable();
            $table->string('num_ctps_candidato', 15)->nullable();
            $table->string('serie_ctps_candidato', 15)->nullable();
            $table->string('doc_reservista_candidato', 30)->nullable();
            $table->integer('id_usuario_candidato')->index('fk_tb_candidato_tb_usuario_candidato');
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
        Schema::dropIfExists('tb_candidato');
    }
}
