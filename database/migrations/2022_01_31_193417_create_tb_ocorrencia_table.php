<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbOcorrenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ocorrencia', function (Blueprint $table) {
            $table->smallInteger('id_ocorrencia', true);
            $table->integer('id_colaborador')->index('fk_tb_ocorrencia_tb_colaborador');
            $table->smallInteger('id_tipo_ocorrencia')->index('fk_tb_ocorrencia_tb_tipo_ocorrencia');
            $table->date('data_ocorrencia');
            $table->decimal('valor_qtd_hora', 11)->nullable();
            $table->string('observacao_ocorrencia', 150)->nullable();
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
        Schema::dropIfExists('tb_ocorrencia');
    }
}
