<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario_candidato', function (Blueprint $table) {
            $table->integer('id_usuario_candidato', true);
            $table->string('nome_usuario_candidato', 60);
            $table->string('email_usuario_candidato', 50);
            $table->string('senha_usuario_candidato', 120)->nullable();
            $table->string('cpf_usuario_candidato', 15);
            $table->smallInteger('id_perfil_usuario')->index('fk_tb_usuario_candidato_tb_perfil_usuario');
            $table->smallInteger('usuario_candidato_ativo');
            $table->smallInteger('usuario_candidato_validado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_usuario_candidato');
    }
}
