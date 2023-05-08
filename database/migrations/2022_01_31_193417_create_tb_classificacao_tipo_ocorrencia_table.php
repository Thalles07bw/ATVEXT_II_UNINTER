<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbClassificacaoTipoOcorrenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_classificacao_tipo_ocorrencia', function (Blueprint $table) {
            $table->smallInteger('id_classificacao_tipo_ocorrencia', true);
            $table->string('classificacao_tipo_ocorrencia', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_classificacao_tipo_ocorrencia');
    }
}
