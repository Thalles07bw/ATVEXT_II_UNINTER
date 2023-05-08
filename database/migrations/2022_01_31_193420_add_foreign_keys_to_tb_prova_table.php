<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_prova', function (Blueprint $table) {
            $table->foreign('id_categoria_prova', 'fk_tb_prova_tb_categoria_prova')->references('id_categoria_prova')->on('tb_categoria_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_nivel_prova', 'fk_tb_prova_tb_nivel_prova')->references('id_nivel_prova')->on('tb_nivel_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_tempo_prova', 'fk_tb_prova_tb_tipo_tempo_prova')->references('id_tipo_tempo_prova')->on('tb_tipo_tempo_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_prova', function (Blueprint $table) {
            $table->dropForeign('fk_tb_prova_tb_categoria_prova');
            $table->dropForeign('fk_tb_prova_tb_nivel_prova');
            $table->dropForeign('fk_tb_prova_tb_tipo_tempo_prova');
        });
    }
}
