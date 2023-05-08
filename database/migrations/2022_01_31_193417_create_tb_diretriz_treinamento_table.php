<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDiretrizTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diretriz_treinamento', function (Blueprint $table) {
            $table->integer('id_diretriz_treinamento', true);
            $table->integer('id_treinamento');
            $table->smallInteger('id_diretriz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_diretriz_treinamento');
    }
}
