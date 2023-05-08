<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBeneficioCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_beneficio_cargo', function (Blueprint $table) {
            $table->smallInteger('id_beneficio_cargo', true);
            $table->smallInteger('id_cargo')->index('fk_tb_beneficio_cargo_tb_cargo');
            $table->smallInteger('id_beneficio')->index('fk_tb_beneficio_cargo_tb_beneficio');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->smallInteger('beneficio_cargo_ativo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_beneficio_cargo');
    }
}
