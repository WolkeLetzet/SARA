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
        Schema::create('computadores', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->date('fecha');
            $table->string('ram')->nullable();
            $table->string('almacenamiento')->nullable();
            $table->string('so')->nullable();
            $table->string('encargado')->nullable();
            $table->string('so_key')->nullable();
            $table->string('office_key')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('codigo_inventario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computadores');
    }
};
