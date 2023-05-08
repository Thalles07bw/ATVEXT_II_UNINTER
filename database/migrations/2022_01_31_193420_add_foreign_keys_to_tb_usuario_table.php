<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_usuario', function (Blueprint $table) {
            $table->foreign('dial_code_tel_usuario', 'fk_tb_usuario_tb_dial_code')->references('id_dial_code')->on('tb_dial_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_empresa_contratante', 'fk_tb_usuario_tb_empresa_contratante')->references('id_empresa_contratante')->on('tb_empresa_contratante')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_perfil_usuario', 'fk_tb_usuario_tb_perfil_usuario')->references('id_perfil_usuario')->on('tb_perfil_usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_usuario', function (Blueprint $table) {
            $table->dropForeign('fk_tb_usuario_tb_dial_code');
            $table->dropForeign('fk_tb_usuario_tb_empresa_contratante');
            $table->dropForeign('fk_tb_usuario_tb_perfil_usuario');
        });
    }
}
