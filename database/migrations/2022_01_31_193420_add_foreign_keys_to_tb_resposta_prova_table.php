<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbRespostaProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_resposta_prova', function (Blueprint $table) {
            $table->foreign('id_pergunta_prova', 'fk_tb_resposta_prova_tb_pergunta_prova')->references('id_pergunta_prova')->on('tb_pergunta_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_resposta_prova', function (Blueprint $table) {
            $table->dropForeign('fk_tb_resposta_prova_tb_pergunta_prova');
        });
    }
}
