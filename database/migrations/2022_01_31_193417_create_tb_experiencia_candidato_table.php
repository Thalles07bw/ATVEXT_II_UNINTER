<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbExperienciaCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_experiencia_candidato', function (Blueprint $table) {
            $table->integer('id_experiencia_candidato', true);
            $table->string('cargo_experiencia_candidato', 45);
            $table->string('empresa_experiencia_candidato', 35);
            $table->date('data_inicio_experiencia');
            $table->date('data_fim_experiencia')->nullable();
            $table->string('descricao_experiencia_candidato', 500)->nullable();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->dateTime('data_criacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_experiencia_candidato');
    }
}
