<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbTokenSenhaCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_token_senha_candidato', function (Blueprint $table) {
            $table->foreign('usuario_candidato_token', 'fk_tb_token_senha_candidato_tb_usuario_candidato')->references('id_usuario_candidato')->on('tb_usuario_candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_token_senha_candidato', function (Blueprint $table) {
            $table->dropForeign('fk_tb_token_senha_candidato_tb_usuario_candidato');
        });
    }
}
