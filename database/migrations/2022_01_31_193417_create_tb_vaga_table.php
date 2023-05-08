<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vaga', function (Blueprint $table) {
            $table->integer('id_vaga', true);
            $table->string('titulo_vaga', 50);
            $table->string('descricao_vaga', 4000);
            $table->smallInteger('id_cargo')->index('fk_tb_vaga_tb_cargo');
            $table->string('video_vaga', 200)->nullable();
            $table->smallInteger('qtd_posicao');
            $table->date('prazo_processo_seletivo');
            $table->smallInteger('id_status_vaga')->index('fk_tb_vaga_tb_status_vaga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_vaga');
    }
}
