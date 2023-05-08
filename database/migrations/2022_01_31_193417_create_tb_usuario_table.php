<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->integer('id_usuario', true);
            $table->string('nome_usuario', 60);
            $table->string('email_usuario', 50);
            $table->string('senha_usuario', 120)->nullable();
            $table->smallInteger('dial_code_tel_usuario')->index('fk_tb_usuario_tb_dial_code');
            $table->string('numero_tel_usuario', 15)->nullable();
            $table->smallInteger('id_perfil_usuario')->index('fk_tb_usuario_tb_perfil_usuario');
            $table->smallInteger('id_empresa_contratante')->index('fk_tb_usuario_tb_empresa_contratante');
            $table->smallInteger('usuario_ativo');
            $table->smallInteger('usuario_validado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_usuario');
    }
}
