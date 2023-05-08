<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_aula', function (Blueprint $table) {
            $table->foreign('id_instrutor', 'tb_aula_instrutor_FK')->references('id_instrutor')->on('tb_instrutor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_local', 'tb_aula_local_FK')->references('id_local')->on('tb_local_aula')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('id_treinamento', 'tb_aula_treinamento_FK')->references('id_treinamento')->on('tb_treinamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_aula', function (Blueprint $table) {
            $table->dropForeign('tb_aula_instrutor_FK');
            $table->dropForeign('tb_aula_local_FK');
            $table->dropForeign('tb_aula_treinamento_FK');
        });
    }
}
