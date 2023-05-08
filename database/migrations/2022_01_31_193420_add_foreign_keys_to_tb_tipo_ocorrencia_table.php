<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbTipoOcorrenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_tipo_ocorrencia', function (Blueprint $table) {
            $table->foreign('id_classificacao_tipo_ocorrencia', 'fk_tb_tipo_ocorrencia_tb_classificacao_tipo_ocorrencia')->references('id_classificacao_tipo_ocorrencia')->on('tb_classificacao_tipo_ocorrencia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_tipo_ocorrencia', function (Blueprint $table) {
            $table->dropForeign('fk_tb_tipo_ocorrencia_tb_classificacao_tipo_ocorrencia');
        });
    }
}
