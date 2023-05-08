<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCandidaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_candidatura', function (Blueprint $table) {
            $table->integer('id_candidatura', true);
            $table->integer('id_candidato')->index('fk_tb_candidatura_tb_candidato');
            $table->integer('id_vaga')->index('fk_tb_candidatura_tb_vaga');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->smallInteger('posicao_candidato')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_candidatura');
    }
}
