<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEtapaVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_etapa_vaga', function (Blueprint $table) {
            $table->integer('id_etapa_vaga', true);
            $table->integer('id_vaga')->index('fk_tb_etapa_vaga_tb_vaga');
            $table->smallInteger('id_etapa')->index('fk_tb_etapa_vaga_tb_etapa');
            $table->smallInteger('ordem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_etapa_vaga');
    }
}
