<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTokenProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_token_prova', function (Blueprint $table) {
            $table->integer('id_token_prova', true);
            $table->smallInteger('id_prova')->index('tb_token_prova_FK');
            $table->char('token', 19)->unique('tb_token_prova_UN');
            $table->integer('id_vaga')->index('tb_token_prova_FK_1');
            $table->date('data_limite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_token_prova');
    }
}
