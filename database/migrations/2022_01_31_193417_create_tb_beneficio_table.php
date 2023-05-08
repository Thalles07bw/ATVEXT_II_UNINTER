<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBeneficioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_beneficio', function (Blueprint $table) {
            $table->smallInteger('id_beneficio', true);
            $table->string('nome_beneficio', 45);
            $table->smallInteger('id_tipo_beneficio')->index('fk_tb_beneficio_tb_tipo_beneficio');
            $table->decimal('valor_beneficio', 11);
            $table->smallInteger('beneficio_aplicado_como')->index('fk_tb_beneficio_tb_tipo_aplicacao_valor');
            $table->smallInteger('id_periodicidade')->index('fk_tb_beneficio_tb_periodicidade');
            $table->decimal('valor_descontado', 11)->nullable();
            $table->smallInteger('beneficio_descontado_como')->index('fk_tb_beneficio_tb_tipo_aplicacao_valor2');
            $table->dateTime('data_criacao')->useCurrent();
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
        Schema::dropIfExists('tb_beneficio');
    }
}
