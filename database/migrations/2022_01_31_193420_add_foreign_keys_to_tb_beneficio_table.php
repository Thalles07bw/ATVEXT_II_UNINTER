<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbBeneficioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_beneficio', function (Blueprint $table) {
            $table->foreign('id_periodicidade', 'fk_tb_beneficio_tb_periodicidade')->references('id_periodicidade')->on('tb_periodicidade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('beneficio_aplicado_como', 'fk_tb_beneficio_tb_tipo_aplicacao_valor')->references('id_tipo_aplicacao_valor')->on('tb_tipo_aplicacao_valor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('beneficio_descontado_como', 'fk_tb_beneficio_tb_tipo_aplicacao_valor2')->references('id_tipo_aplicacao_valor')->on('tb_tipo_aplicacao_valor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_beneficio', 'fk_tb_beneficio_tb_tipo_beneficio')->references('id_tipo_beneficio')->on('tb_tipo_beneficio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_beneficio', function (Blueprint $table) {
            $table->dropForeign('fk_tb_beneficio_tb_periodicidade');
            $table->dropForeign('fk_tb_beneficio_tb_tipo_aplicacao_valor');
            $table->dropForeign('fk_tb_beneficio_tb_tipo_aplicacao_valor2');
            $table->dropForeign('fk_tb_beneficio_tb_tipo_beneficio');
        });
    }
}
