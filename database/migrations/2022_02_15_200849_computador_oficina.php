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
        Schema::create('computador_oficina', function (Blueprint $table) {
            $table->unsignedBigInteger('computador_id')->index();
            $table->unsignedBigInteger('oficina_id')->index();
            $table->timestamps();
            $table->foreign('computador_id')->references('id')->on('computadores')->ondelete('cascade');
            $table->foreign('oficina_id')->references('id')->on('oficinas')->ondelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computador_oficina');
    }
};
