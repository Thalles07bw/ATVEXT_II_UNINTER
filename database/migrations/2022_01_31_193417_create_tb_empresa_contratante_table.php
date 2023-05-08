<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEmpresaContratanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_empresa_contratante', function (Blueprint $table) {
            $table->smallInteger('id_empresa_contratante', true);
            $table->string('cnpj_empresa_contratante', 15)->nullable();
            $table->string('razao_social_empresa_contratante', 45);
            $table->smallInteger('dial_code_telefone')->index('fk_tb_empresa_contratante_tb_dial_code');
            $table->string('numero_telefone', 15)->nullable();
            $table->smallInteger('dial_code_celular')->index('fk_tb_empresa_contratante_tb_dial_code2');
            $table->string('numero_celular', 15)->nullable();
            $table->smallInteger('id_pais')->index('fk_tb_empresa_contratante_tb_pais');
            $table->char('cep_empresa_contratante', 9)->nullable();
            $table->string('logradouro_empresa_contratante', 30)->nullable();
            $table->string('numero_endereco_empresa_contratante', 5)->nullable();
            $table->string('complemento_endereco_empresa_contratante', 10)->nullable();
            $table->string('bairro_empresa_contratante', 20)->nullable();
            $table->smallInteger('id_estado')->index('fk_tb_empresa_contratante_tb_estado');
            $table->smallInteger('id_cidade')->index('fk_tb_empresa_contratante_tb_cidade');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->smallInteger('id_tamanho_empresa')->index('fk_tb_empresa_contratante_tb_tamanho_empresa');
            $table->string('principal_desafio_empresa', 100)->nullable();
            $table->smallInteger('id_tipo_cliente')->nullable()->index('fk_tb_empresa_contratante_tb_tipo_cliente');
            $table->smallInteger('empresa_gerente')->nullable()->index('tb_empresa_contratante_FK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_empresa_contratante');
    }
}
