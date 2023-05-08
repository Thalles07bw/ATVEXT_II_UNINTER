<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbResultadoQuestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_resultado_questao', function (Blueprint $table) {
            $table->integer('id_resultado_questao', true);
            $table->char('token_avaliacao', 19)->index('tb_resultado_questao_FK_2');
            $table->integer('alternativa_escolhida')->nullable()->index('tb_resultado_questao_FK_1');
            $table->integer('id_questao')->index('tb_resultado_questao_FK');
            $table->integer('id_candidato')->index('tb_resultado_questao_FK_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_resultado_questao');
    }
}
