<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbLocalAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_local_aula', function (Blueprint $table) {
            $table->smallInteger('id_local', true);
            $table->smallInteger('id_empresa')->index('tb_empresa_local_FK');
            $table->string('cep_local', 9);
            $table->string('rua_local', 100);
            $table->string('bairro_local', 100);
            $table->smallInteger('id_cidade')->index('tb_cidade_local_FK');
            $table->smallInteger('id_estado')->index('tb_estado_local_FK');
            $table->string('numero_local', 5);
            $table->string('nome_local', 100);
            $table->string('nome_sala', 100)->nullable();
            $table->smallInteger('id_pais')->nullable()->index('tb_local_aula_FK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_local_aula');
    }
}
