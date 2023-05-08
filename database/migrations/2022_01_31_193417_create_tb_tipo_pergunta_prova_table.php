<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTipoPerguntaProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tipo_pergunta_prova', function (Blueprint $table) {
            $table->smallInteger('id_tipo_pergunta_prova', true);
            $table->string('tipo_pergunta_prova', 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tipo_pergunta_prova');
    }
}
