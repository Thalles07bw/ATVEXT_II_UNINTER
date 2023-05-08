<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTipoArquivoTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tipo_arquivo_treinamento', function (Blueprint $table) {
            $table->smallInteger('id_tipo_arquivo', true);
            $table->string('tipo_arquivo', 30);
            $table->string('descricao_tipo_arquivo', 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tipo_arquivo_treinamento');
    }
}
