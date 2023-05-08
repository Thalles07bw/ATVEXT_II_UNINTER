<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUnidadeValidadeTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_unidade_validade_treinamento', function (Blueprint $table) {
            $table->smallInteger('id_unidade_validade', true);
            $table->string('unidade_validade', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_unidade_validade_treinamento');
    }
}
