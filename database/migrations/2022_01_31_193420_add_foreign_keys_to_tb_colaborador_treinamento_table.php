<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbColaboradorTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_colaborador_treinamento', function (Blueprint $table) {
            $table->foreign('id_colaborador', 'tb_colaborador_treinamento_FK')->references('id_colaborador')->on('tb_colaborador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_colaborador', 'tb_instrutor_treinamento_FK')->references('id_instrutor')->on('tb_instrutor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_colaborador_treinamento', function (Blueprint $table) {
            $table->dropForeign('tb_colaborador_treinamento_FK');
            $table->dropForeign('tb_instrutor_treinamento_FK');
        });
    }
}
