<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEtapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_etapa', function (Blueprint $table) {
            $table->smallInteger('id_etapa', true);
            $table->string('etapa', 30);
            $table->smallInteger('obrigatorio');
            $table->smallInteger('ordem')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_etapa');
    }
}
