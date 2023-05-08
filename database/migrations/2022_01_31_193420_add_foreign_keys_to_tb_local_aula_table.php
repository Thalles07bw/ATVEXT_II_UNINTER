<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbLocalAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_local_aula', function (Blueprint $table) {
            $table->foreign('id_cidade', 'tb_cidade_local_FK')->references('id_cidade')->on('tb_cidade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_empresa', 'tb_empresa_local_FK')->references('id_empresa_contratante')->on('tb_empresa_contratante')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_estado', 'tb_estado_local_FK')->references('id_estado')->on('tb_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_pais', 'tb_local_aula_FK')->references('id_pais')->on('tb_pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_local_aula', function (Blueprint $table) {
            $table->dropForeign('tb_cidade_local_FK');
            $table->dropForeign('tb_empresa_local_FK');
            $table->dropForeign('tb_estado_local_FK');
            $table->dropForeign('tb_local_aula_FK');
        });
    }
}
