<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_curso', function (Blueprint $table) {
            $table->integer('id_curso', true);
            $table->string('nome_curso', 60);
            $table->text('descricao_curso')->nullable();
            $table->time('carga_horaria_pratica');
            $table->time('carga_horaria_teorica');
            $table->text('conteudo_pratico')->nullable();
            $table->text('conteudo_teorico')->nullable();
            $table->smallInteger('prazo_validade')->nullable();
            $table->smallInteger('unidade_prazo_validade')->nullable();
            $table->smallInteger('id_empresa')->index('tb_curso_FK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_curso');
    }
}
