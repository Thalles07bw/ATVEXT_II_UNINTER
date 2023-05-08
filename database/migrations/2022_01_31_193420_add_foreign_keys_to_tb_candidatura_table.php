<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbCandidaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_candidatura', function (Blueprint $table) {
            $table->foreign('id_candidato', 'fk_tb_candidatura_tb_candidato')->references('id_candidato')->on('tb_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_vaga', 'fk_tb_candidatura_tb_vaga')->references('id_vaga')->on('tb_vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_candidatura', function (Blueprint $table) {
            $table->dropForeign('fk_tb_candidatura_tb_candidato');
            $table->dropForeign('fk_tb_candidatura_tb_vaga');
        });
    }
}
