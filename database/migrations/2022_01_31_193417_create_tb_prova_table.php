<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_prova', function (Blueprint $table) {
            $table->smallInteger('id_prova', true);
            $table->string('nome_prova', 130);
            $table->smallInteger('id_nivel_prova')->index('fk_tb_prova_tb_nivel_prova');
            $table->smallInteger('id_categoria_prova')->index('fk_tb_prova_tb_categoria_prova');
            $table->smallInteger('id_tipo_tempo_prova')->index('fk_tb_prova_tb_tipo_tempo_prova');
            $table->decimal('tempo_total_prova', 4)->nullable();
            $table->dateTime('data_criacao')->useCurrent();
            $table->boolean('ativo')->default(1);
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->smallInteger('id_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_prova');
    }
}
