<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbOcorrenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_ocorrencia', function (Blueprint $table) {
            $table->foreign('id_colaborador', 'fk_tb_ocorrencia_tb_colaborador')->references('id_colaborador')->on('tb_colaborador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_ocorrencia', 'fk_tb_ocorrencia_tb_tipo_ocorrencia')->references('id_tipo_ocorrencia')->on('tb_tipo_ocorrencia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_ocorrencia', function (Blueprint $table) {
            $table->dropForeign('fk_tb_ocorrencia_tb_colaborador');
            $table->dropForeign('fk_tb_ocorrencia_tb_tipo_ocorrencia');
        });
    }
}
