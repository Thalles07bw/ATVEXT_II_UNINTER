<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCategoriaCnhCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_categoria_cnh_candidato', function (Blueprint $table) {
            $table->smallInteger('id_candidato_categoria_cnh', true);
            $table->integer('id_candidato')->index('fk_tb_candidato_categoria_cnh_tb_candidato');
            $table->smallInteger('id_categoria_cnh')->index('fk_tb_candidato_categoria_cnh_tb_categoria_cnh');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->date('data_primeira_habilitacao');
            $table->char('num_registro', 11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_categoria_cnh_candidato');
    }
}
