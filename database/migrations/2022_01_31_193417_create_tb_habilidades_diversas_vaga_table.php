<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHabilidadesDiversasVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_habilidades_diversas_vaga', function (Blueprint $table) {
            $table->smallInteger('id_habilidades_diversas_vaga', true);
            $table->integer('id_vaga')->index('fk_tb_habilidades_diversas_vaga_tb_vaga');
            $table->smallInteger('id_habilidades_diversas')->index('fk_tb_habilidades_diversas_vaga_tb_habilidades_diversas');
            $table->smallInteger('nivel_habilidade');
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->dateTime('data_criacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_habilidades_diversas_vaga');
    }
}
