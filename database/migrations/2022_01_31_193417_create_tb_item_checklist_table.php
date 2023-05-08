<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbItemChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_item_checklist', function (Blueprint $table) {
            $table->smallInteger('id_item_checklist', true);
            $table->string('item_checklist', 30);
            $table->smallInteger('id_tipo_checklist')->index('fk_tb_item_checklist_tb_tipo_checklist');
            $table->dateTime('data_criacao')->useCurrent();
            $table->dateTime('data_ultima_modificacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_item_checklist');
    }
}
