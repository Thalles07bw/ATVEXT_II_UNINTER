<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbBeneficioCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_beneficio_cargo', function (Blueprint $table) {
            $table->foreign('id_beneficio', 'fk_tb_beneficio_cargo_tb_beneficio')->references('id_beneficio')->on('tb_beneficio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_cargo', 'fk_tb_beneficio_cargo_tb_cargo')->references('id_cargo')->on('tb_cargo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_beneficio_cargo', function (Blueprint $table) {
            $table->dropForeign('fk_tb_beneficio_cargo_tb_beneficio');
            $table->dropForeign('fk_tb_beneficio_cargo_tb_cargo');
        });
    }
}
