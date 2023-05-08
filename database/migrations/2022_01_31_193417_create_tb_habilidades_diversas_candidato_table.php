<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHabilidadesDiversasCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_habilidades_diversas_candidato', function (Blueprint $table) {
            $table->integer('id_habilidades_diversas_candidato', true);
            $table->smallInteger('id_habilidades_diversas')->index('fk_tb_habilidades_diversas_candidato_tb_habilidades_diversas');
            $table->smallInteger('nivel_habilidade');
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->dateTime('data_criacao')->useCurrent();
            $table->integer('id_candidato')->index('fk_tb_habilidades_diversas_candidato_tb_candidato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_habilidades_diversas_candidato');
    }
}
