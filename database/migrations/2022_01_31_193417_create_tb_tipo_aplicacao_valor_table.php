<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTipoAplicacaoValorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tipo_aplicacao_valor', function (Blueprint $table) {
            $table->smallInteger('id_tipo_aplicacao_valor', true);
            $table->string('tipo_aplicacao_valor', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tipo_aplicacao_valor');
    }
}
