<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInstrutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_instrutor', function (Blueprint $table) {
            $table->integer('id_instrutor', true);
            $table->string('nome_instrutor', 60);
            $table->string('email_instrutor', 30);
            $table->smallInteger('id_saudacao');
            $table->date('dn_instrutor');
            $table->smallInteger('id_genero');
            $table->string('foto_instrutor', 60)->nullable()->default('default.png');
            $table->smallInteger('id_estado_civil');
            $table->smallInteger('id_escolaridade');
            $table->smallInteger('possui_deficiencia');
            $table->string('tipo_necessidade_especial', 30)->nullable();
            $table->smallInteger('dial_code_telefone')->default(1);
            $table->string('numero_telefone', 15)->nullable();
            $table->string('cpf_instrutor', 15);
            $table->string('cnpj_instrutor', 18)->nullable();
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->integer('id_usuario');
            $table->string('cod_registro_instrutor', 15)->nullable();
            $table->smallInteger('id_empresa')->index('tb_instrutor_FK');
            $table->boolean('instrutor_ativo');
            $table->smallInteger('id_tipo_contrato')->index('tb_instrutor_FK_1');
            $table->string('area_especialidade_instrutor', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_instrutor');
    }
}
