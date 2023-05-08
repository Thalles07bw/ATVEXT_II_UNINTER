<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_estado', function (Blueprint $table) {
            $table->smallInteger('id_estado')->primary();
            $table->string('nome_estado', 30);
            $table->smallInteger('id_pais')->index('fk_tb_estado_tb_pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_estado');
    }
}
