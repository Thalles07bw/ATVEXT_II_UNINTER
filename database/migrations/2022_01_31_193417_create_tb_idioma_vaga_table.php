<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbIdiomaVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_idioma_vaga', function (Blueprint $table) {
            $table->smallInteger('id_idioma_vaga', true);
            $table->smallInteger('id_idioma')->index('fk_tb_idioma_vaga_tb_idioma');
            $table->smallInteger('nivel_idioma_vaga');
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->dateTime('data_criacao')->useCurrent();
            $table->integer('id_vaga')->index('fk_tb_idioma_vaga_tb_vaga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_idioma_vaga');
    }
}
