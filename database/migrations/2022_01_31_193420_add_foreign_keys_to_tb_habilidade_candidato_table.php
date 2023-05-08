<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbHabilidadeCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_habilidade_candidato', function (Blueprint $table) {
            $table->foreign('id_candidato', 'fk_tb_habilidade_candadato_tb_candidato')->references('id_candidato')->on('tb_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_habilidade_candidato', function (Blueprint $table) {
            $table->dropForeign('fk_tb_habilidade_candadato_tb_candidato');
        });
    }
}
