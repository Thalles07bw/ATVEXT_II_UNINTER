<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInstrutorTreinamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_instrutor_treinamento', function (Blueprint $table) {
            $table->integer('id_instrutor_treinamento', true);
            $table->integer('id_treinamento');
            $table->integer('id_instrutor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_instrutor_treinamento');
    }
}
