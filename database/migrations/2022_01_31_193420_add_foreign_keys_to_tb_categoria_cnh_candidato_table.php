<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbCategoriaCnhCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_categoria_cnh_candidato', function (Blueprint $table) {
            $table->foreign('id_candidato', 'fk_tb_candidato_categoria_cnh_tb_candidato')->references('id_candidato')->on('tb_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_categoria_cnh', 'fk_tb_candidato_categoria_cnh_tb_categoria_cnh')->references('id_categoria_cnh')->on('tb_categoria_cnh')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_categoria_cnh_candidato', function (Blueprint $table) {
            $table->dropForeign('fk_tb_candidato_categoria_cnh_tb_candidato');
            $table->dropForeign('fk_tb_candidato_categoria_cnh_tb_categoria_cnh');
        });
    }
}
