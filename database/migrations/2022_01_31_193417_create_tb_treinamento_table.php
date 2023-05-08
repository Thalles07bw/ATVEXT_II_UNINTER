<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_treinamento', function (Blueprint $table) {
            $table->integer('id_treinamento', true);
            $table->integer('id_curso');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->smallInteger('vagas_treinamento');
            $table->string('descricao_treinamento', 300)->nullable();
            $table->smallInteger('status_treinamento');
            $table->integer('diretor_treinamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_treinamento');
    }
}
