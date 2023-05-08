<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbTokenSenhaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_token_senha', function (Blueprint $table) {
            $table->foreign('usuario_token', 'fk_token_usuario')->references('id_usuario')->on('tb_usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_token_senha', function (Blueprint $table) {
            $table->dropForeign('fk_token_usuario');
        });
    }
}
