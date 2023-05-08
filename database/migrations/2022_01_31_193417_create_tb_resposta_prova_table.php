<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRespostaProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_resposta_prova', function (Blueprint $table) {
            $table->integer('id_resposta_prova', true);
            $table->integer('id_pergunta_prova')->index('fk_tb_resposta_prova_tb_pergunta_prova');
            $table->string('resposta_prova', 450);
            $table->smallInteger('resposta_correta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_resposta_prova');
    }
}
