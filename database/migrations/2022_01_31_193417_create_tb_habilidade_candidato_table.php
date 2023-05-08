<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHabilidadeCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_habilidade_candidato', function (Blueprint $table) {
            $table->integer('id_habilidade_candidato', true);
            $table->string('habilidade_candidato', 35);
            $table->smallInteger('nivel_habilidade_candidato');
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->dateTime('data_criacao')->useCurrent();
            $table->integer('id_candidato')->index('fk_tb_habilidade_candadato_tb_candidato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_habilidade_candidato');
    }
}
