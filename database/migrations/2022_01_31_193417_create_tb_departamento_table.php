<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_departamento', function (Blueprint $table) {
            $table->smallInteger('id_departamento', true);
            $table->string('nome_departamento', 50);
            $table->text('descricao_departamento')->nullable();
            $table->decimal('orcamento_mensal', 11)->nullable();
            $table->string('email_departamento', 50)->nullable();
            $table->string('ramal_departamento', 15)->nullable();
            $table->string('cod_interno', 20)->nullable();
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
            $table->smallInteger('id_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_departamento');
    }
}
