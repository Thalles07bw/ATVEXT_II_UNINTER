<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbInstrutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_instrutor', function (Blueprint $table) {
            $table->foreign('id_empresa', 'tb_instrutor_FK')->references('id_empresa_contratante')->on('tb_empresa_contratante')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_tipo_contrato', 'tb_instrutor_FK_1')->references('id_tipo_contrato')->on('tb_tipo_contrato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_instrutor', function (Blueprint $table) {
            $table->dropForeign('tb_instrutor_FK');
            $table->dropForeign('tb_instrutor_FK_1');
        });
    }
}
