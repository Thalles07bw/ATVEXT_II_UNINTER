<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioAlunoExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario_aluno_externo', function (Blueprint $table) {
            $table->integer('id_usuario_aluno', true);
            $table->string('nome_usuario_aluno', 60);
            $table->string('email_usuario_aluno', 30);
            $table->string('cpf_usuario_aluno', 15);
            $table->string('senha_usuario_aluno', 120);
            $table->smallInteger('dial_code_tel_usuario_aluno');
            $table->string('numero_tel_usuario_aluno', 15)->nullable();
            $table->smallInteger('id_perfil_usuario_aluno');
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
        Schema::dropIfExists('tb_usuario_aluno_externo');
    }
}
