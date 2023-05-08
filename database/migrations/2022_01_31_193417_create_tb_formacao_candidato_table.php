<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFormacaoCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_formacao_candidato', function (Blueprint $table) {
            $table->integer('id_formacao_candidato', true);
            $table->string('curso_formacao_candidato', 45);
            $table->string('instituicao_formacao_candidato', 35);
            $table->smallInteger('id_escolaridade')->index('fk_tb_formacao_candidato_tb_escoladirade');
            $table->date('data_inicio_formacao');
            $table->date('data_fim_formacao')->nullable();
            $table->string('descricao_formacao_candidato', 500)->nullable();
            $table->integer('id_candidato')->index('fk_tb_formacao_candidato_tb_candidato');
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
        Schema::dropIfExists('tb_formacao_candidato');
    }
}
