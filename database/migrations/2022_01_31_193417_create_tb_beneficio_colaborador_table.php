<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBeneficioColaboradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_beneficio_colaborador', function (Blueprint $table) {
            $table->smallInteger('id_beneficio_colaborador', true);
            $table->integer('id_colaborador')->index('fk_tb_beneficio_colaborador_tb_colaborador');
            $table->smallInteger('id_beneficio')->index('fk_tb_beneficio_colaborador_tb_beneficio');
            $table->date('data_inicio_beneficio');
            $table->date('data_fim_beneficio')->nullable();
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
        Schema::dropIfExists('tb_beneficio_colaborador');
    }
}
