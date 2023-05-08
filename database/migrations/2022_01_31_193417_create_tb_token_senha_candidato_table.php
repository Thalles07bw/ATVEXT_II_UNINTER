<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTokenSenhaCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_token_senha_candidato', function (Blueprint $table) {
            $table->integer('id_token_candidato', true);
            $table->char('token_candidato', 18);
            $table->integer('usuario_candidato_token')->index('fk_tb_token_senha_candidato_tb_usuario_candidato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_token_senha_candidato');
    }
}
