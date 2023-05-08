<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cargo', function (Blueprint $table) {
            $table->smallInteger('id_cargo', true);
            $table->smallInteger('id_cbo')->index('fk_tb_cargo_tb_cbo');
            $table->decimal('piso_salarial_cargo', 11);
            $table->string('atividades_cargo', 500)->nullable();
            $table->string('descricao_sumaria_cargo', 300)->nullable();
            $table->string('nome_cargo', 30);
            $table->smallInteger('id_senioridade')->index('fk_tb_cargo_tb_senioridade');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->smallInteger('id_empresa');
            $table->smallInteger('id_escolaridade_min')->index('fk_tb_cargo_tb_escolaridade');
            $table->smallInteger('id_escolaridade_max')->index('fk_tb_cargo_tb_escolaridade2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cargo');
    }
}
