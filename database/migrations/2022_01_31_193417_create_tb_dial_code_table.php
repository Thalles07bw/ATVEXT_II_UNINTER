<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDialCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dial_code', function (Blueprint $table) {
            $table->smallInteger('id_dial_code', true);
            $table->string('bandeira_pais', 100);
            $table->smallInteger('id_pais')->index('fk_tb_dial_code_tb_pais');
            $table->string('dial_code', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dial_code');
    }
}
