<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbDialCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_dial_code', function (Blueprint $table) {
            $table->foreign('id_pais', 'fk_tb_dial_code_tb_pais')->references('id_pais')->on('tb_pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_dial_code', function (Blueprint $table) {
            $table->dropForeign('fk_tb_dial_code_tb_pais');
        });
    }
}
