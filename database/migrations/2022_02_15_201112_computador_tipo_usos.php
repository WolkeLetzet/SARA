<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('computador_tipo_usos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_uso_id');
            $table->unsignedBigInteger('computador_id');
            $table->timestamps();

            $table->foreign('tipo_uso_id')->references('id')->on('tipo_usos');
            $table->foreign('computador_id')->references('id')->on('computadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('computador_tipo_usos');
    }
};
