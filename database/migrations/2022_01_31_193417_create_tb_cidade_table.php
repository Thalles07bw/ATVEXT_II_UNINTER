<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cidade', function (Blueprint $table) {
            $table->smallInteger('id_cidade', true);
            $table->string('nome_cidade', 35);
            $table->smallInteger('id_estado')->index('fk_tb_cidade_tb_estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cidade');
    }
}
