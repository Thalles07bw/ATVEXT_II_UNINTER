<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbTokenProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_token_prova', function (Blueprint $table) {
            $table->foreign('id_prova', 'tb_token_prova_FK')->references('id_prova')->on('tb_prova')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_vaga', 'tb_token_prova_FK_1')->references('id_vaga')->on('tb_vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_token_prova', function (Blueprint $table) {
            $table->dropForeign('tb_token_prova_FK');
            $table->dropForeign('tb_token_prova_FK_1');
        });
    }
}
