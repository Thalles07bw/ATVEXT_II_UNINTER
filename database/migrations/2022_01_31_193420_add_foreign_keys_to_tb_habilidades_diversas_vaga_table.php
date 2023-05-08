<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbHabilidadesDiversasVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_habilidades_diversas_vaga', function (Blueprint $table) {
            $table->foreign('id_habilidades_diversas', 'fk_tb_habilidades_diversas_vaga_tb_habilidades_diversas')->references('id_habilidades_diversas')->on('tb_habilidades_diversas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_vaga', 'fk_tb_habilidades_diversas_vaga_tb_vaga')->references('id_vaga')->on('tb_vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_habilidades_diversas_vaga', function (Blueprint $table) {
            $table->dropForeign('fk_tb_habilidades_diversas_vaga_tb_habilidades_diversas');
            $table->dropForeign('fk_tb_habilidades_diversas_vaga_tb_vaga');
        });
    }
}
