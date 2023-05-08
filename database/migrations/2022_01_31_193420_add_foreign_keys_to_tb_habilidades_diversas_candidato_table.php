<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbHabilidadesDiversasCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_habilidades_diversas_candidato', function (Blueprint $table) {
            $table->foreign('id_candidato', 'fk_tb_habilidades_diversas_candidato_tb_candidato')->references('id_candidato')->on('tb_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_habilidades_diversas', 'fk_tb_habilidades_diversas_candidato_tb_habilidades_diversas')->references('id_habilidades_diversas')->on('tb_habilidades_diversas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_habilidades_diversas_candidato', function (Blueprint $table) {
            $table->dropForeign('fk_tb_habilidades_diversas_candidato_tb_candidato');
            $table->dropForeign('fk_tb_habilidades_diversas_candidato_tb_habilidades_diversas');
        });
    }
}
