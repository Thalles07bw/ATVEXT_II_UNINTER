<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbUsuarioCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_usuario_candidato', function (Blueprint $table) {
            $table->foreign('id_perfil_usuario', 'fk_tb_usuario_candidato_tb_perfil_usuario')->references('id_perfil_usuario')->on('tb_perfil_usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_usuario_candidato', function (Blueprint $table) {
            $table->dropForeign('fk_tb_usuario_candidato_tb_perfil_usuario');
        });
    }
}
