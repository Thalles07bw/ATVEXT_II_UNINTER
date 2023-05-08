<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbIdiomaCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_idioma_candidato', function (Blueprint $table) {
            $table->integer('id_idioma_candidato', true);
            $table->smallInteger('id_idioma')->index('fk_tb_idioma_candidato_tb_idioma');
            $table->smallInteger('nivel_idioma_candidato');
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->dateTime('data_criacao')->useCurrent();
            $table->integer('id_candidato')->index('fk_tb_idioma_candidato_tb_candidato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_idioma_candidato');
    }
}
