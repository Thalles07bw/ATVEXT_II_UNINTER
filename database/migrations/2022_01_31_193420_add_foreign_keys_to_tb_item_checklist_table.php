<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbItemChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_item_checklist', function (Blueprint $table) {
            $table->foreign('id_tipo_checklist', 'fk_tb_item_checklist_tb_tipo_checklist')->references('id_tipo_checklist')->on('tb_tipo_checklist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_item_checklist', function (Blueprint $table) {
            $table->dropForeign('fk_tb_item_checklist_tb_tipo_checklist');
        });
    }
}
