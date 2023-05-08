<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_curso', function (Blueprint $table) {
            $table->foreign('id_empresa', 'tb_curso_FK')->references('id_empresa_contratante')->on('tb_empresa_contratante')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_curso', function (Blueprint $table) {
            $table->dropForeign('tb_curso_FK');
        });
    }
}
