<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDependenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dependente', function (Blueprint $table) {
            $table->integer('id_dependente', true);
            $table->string('nome_dependente', 60);
            $table->string('cpf_dependente', 15)->nullable();
            $table->string('rg_dependente', 15)->nullable();
            $table->date('dn_dependente');
            $table->smallInteger('id_parentesco')->index('fk_tb_dependente_tb_parentesco');
            $table->integer('id_colaborador')->index('fk_tb_dependente_tb_colaborador');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dependente');
    }
}
