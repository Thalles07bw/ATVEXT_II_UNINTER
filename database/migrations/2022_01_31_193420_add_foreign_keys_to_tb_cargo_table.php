<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_cargo', function (Blueprint $table) {
            $table->foreign('id_cbo', 'fk_tb_cargo_tb_cbo')->references('id_cbo')->on('tb_cbo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_escolaridade_min', 'fk_tb_cargo_tb_escolaridade')->references('id_escolaridade')->on('tb_escolaridade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_escolaridade_max', 'fk_tb_cargo_tb_escolaridade2')->references('id_escolaridade')->on('tb_escolaridade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_senioridade', 'fk_tb_cargo_tb_senioridade')->references('id_senioridade')->on('tb_senioridade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_cargo', function (Blueprint $table) {
            $table->dropForeign('fk_tb_cargo_tb_cbo');
            $table->dropForeign('fk_tb_cargo_tb_escolaridade');
            $table->dropForeign('fk_tb_cargo_tb_escolaridade2');
            $table->dropForeign('fk_tb_cargo_tb_senioridade');
        });
    }
}
