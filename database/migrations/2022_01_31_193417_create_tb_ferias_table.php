<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ferias', function (Blueprint $table) {
            $table->smallInteger('id_ferias', true);
            $table->integer('id_colaborador')->index('fk_tb_ferias_tb_colaborador');
            $table->date('data_inicio_ferias');
            $table->date('data_fim_ferias');
            $table->smallInteger('num_dias_ferias');
            $table->date('data_vencimento_ferias');
            $table->smallInteger('num_dia_abono')->nullable();
            $table->decimal('valor_abono_ferias', 11)->nullable();
            $table->smallInteger('ferias_usufruidas');
            $table->string('observacao_ferias', 150)->nullable();
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_ferias');
    }
}
