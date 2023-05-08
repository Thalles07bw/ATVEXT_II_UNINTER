<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbColaboradorTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_colaborador_treinamento', function (Blueprint $table) {
            $table->smallInteger('id_instrutor_treinamento', true);
            $table->integer('id_treinamento');
            $table->integer('id_colaborador')->index('tb_colaborador_treinamento_FK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_colaborador_treinamento');
    }
}
