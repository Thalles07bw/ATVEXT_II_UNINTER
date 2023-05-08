<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aula', function (Blueprint $table) {
            $table->smallInteger('id_aula', true);
            $table->integer('id_treinamento')->index('tb_aula_treinamento_FK');
            $table->smallInteger('id_local')->index('tb_aula_local_FK');
            $table->integer('id_instrutor')->index('tb_aula_instrutor_FK');
            $table->text('descricao_aula');
            $table->timestamp('dia_hora_inicio');
            $table->timestamp('dia_hora_fim');
            $table->string('nome_aula', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aula');
    }
}
