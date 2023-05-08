<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbCandidatoProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_candidato_prova', function (Blueprint $table) {
            $table->foreign('id_prova', 'tb_candidato_prova_FK')->references('id_prova')->on('tb_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_candidato', 'tb_candidato_prova_FK_1')->references('id_candidato')->on('tb_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_candidato_prova', function (Blueprint $table) {
            $table->dropForeign('tb_candidato_prova_FK');
            $table->dropForeign('tb_candidato_prova_FK_1');
        });
    }
}
