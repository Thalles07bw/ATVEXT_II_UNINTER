<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_vaga', function (Blueprint $table) {
            $table->foreign('id_cargo', 'fk_tb_vaga_tb_cargo')->references('id_cargo')->on('tb_cargo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_status_vaga', 'fk_tb_vaga_tb_status_vaga')->references('id_status_vaga')->on('tb_status_vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_vaga', function (Blueprint $table) {
            $table->dropForeign('fk_tb_vaga_tb_cargo');
            $table->dropForeign('fk_tb_vaga_tb_status_vaga');
        });
    }
}
