<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPerguntaProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pergunta_prova', function (Blueprint $table) {
            $table->integer('id_pergunta_prova', true);
            $table->smallInteger('id_prova')->index('fk_tb_pergunta_prova_tb_prova');
            $table->smallInteger('id_tipo_pergunta_prova')->index('fk_tb_pergunta_prova_tb_tipo_pergunta_prova');
            $table->text('pergunta_prova');
            $table->decimal('tempo_pergunta_prova', 3)->nullable();
            $table->boolean('ativo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pergunta_prova');
    }
}
