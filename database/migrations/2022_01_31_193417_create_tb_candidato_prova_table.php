<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCandidatoProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_candidato_prova', function (Blueprint $table) {
            $table->smallInteger('id_candidato_prova', true);
            $table->integer('id_candidato')->index('tb_candidato_prova_FK_1');
            $table->smallInteger('id_prova')->index('tb_candidato_prova_FK');
            $table->smallInteger('id_vaga');
            $table->boolean('prova_feita')->default(0);
            $table->char('percentual_acerto', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_candidato_prova');
    }
}
