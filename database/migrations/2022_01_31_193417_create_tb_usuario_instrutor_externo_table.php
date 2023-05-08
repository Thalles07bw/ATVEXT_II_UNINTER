<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioInstrutorExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario_instrutor_externo', function (Blueprint $table) {
            $table->integer('id_usuario_instrutor', true);
            $table->string('nome_usuario_instrutor', 60);
            $table->string('email_usuario_instrutor', 30);
            $table->string('cpf_usuario_instrutor', 15);
            $table->string('senha_usuario_instrutor', 120);
            $table->smallInteger('dial_code_tel_usuario_instrutor');
            $table->string('numero_tel_usuario_instrutor', 15)->nullable();
            $table->smallInteger('id_perfil_usuario_instrutor');
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
        Schema::dropIfExists('tb_usuario_instrutor_externo');
    }
}
