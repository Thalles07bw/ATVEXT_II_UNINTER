<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbIdiomaVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_idioma_vaga', function (Blueprint $table) {
            $table->foreign('id_idioma', 'fk_tb_idioma_vaga_tb_idioma')->references('id_idioma')->on('tb_idioma')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_vaga', 'fk_tb_idioma_vaga_tb_vaga')->references('id_vaga')->on('tb_vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_idioma_vaga', function (Blueprint $table) {
            $table->dropForeign('fk_tb_idioma_vaga_tb_idioma');
            $table->dropForeign('fk_tb_idioma_vaga_tb_vaga');
        });
    }
}
