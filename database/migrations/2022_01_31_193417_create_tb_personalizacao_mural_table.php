<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPersonalizacaoMuralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_personalizacao_mural', function (Blueprint $table) {
            $table->smallInteger('id_personalizacao', true);
            $table->char('cor', 7)->default('#FFFFFF');
            $table->string('logo', 100)->nullable();
            $table->string('linkedin', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('youtube', 100)->nullable();
            $table->smallInteger('id_empresa')->index('fk_personalizacao_empresa');
            $table->char('cor_icone', 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_personalizacao_mural');
    }
}
