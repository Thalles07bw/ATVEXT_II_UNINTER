<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDemissaoColaboradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_demissao_colaborador', function (Blueprint $table) {
            $table->smallInteger('id_demissao_colaborador', true);
            $table->integer('id_colaborador')->index('tb_demisao_colaborador_FK');
            $table->smallInteger('id_motivo_demissao')->index('tb_demisao_colaborador_FK_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_demissao_colaborador');
    }
}
