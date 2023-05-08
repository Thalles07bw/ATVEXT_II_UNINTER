<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTipoOcorrenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tipo_ocorrencia', function (Blueprint $table) {
            $table->smallInteger('id_tipo_ocorrencia', true);
            $table->string('nome_tipo_ocorrencia', 25);
            $table->smallInteger('id_classificacao_tipo_ocorrencia')->index('fk_tb_tipo_ocorrencia_tb_classificacao_tipo_ocorrencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tipo_ocorrencia');
    }
}
